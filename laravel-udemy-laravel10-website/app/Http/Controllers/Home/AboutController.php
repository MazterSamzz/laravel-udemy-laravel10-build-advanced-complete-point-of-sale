<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    public function AboutPage() {
        $aboutpage= About::find(1);

        return view('admin.about_page.about_page_all', compact('aboutpage'));
    } // end of AboutPage

    public function UpdateAbout(Request $request) {
        $request->validate([
            'title' => 'required',
            'short_title' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'about_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB limit
        ],[
            'title.required' => 'Title is Required',
            'short_title.required' => 'Short Title is Required',
            'short_description.required' => 'Short Description is Required',
            'long_description.required' => 'Long Description is Required',
            'about_image.image' => 'About Image must be an image',
            'about_image.mimes' => 'About Image must be a file of type: jpeg, png, jpg, gif',
            'about_image.max' => 'About Image must not exceed 2MB',
        ]);

        $about = About::find($request->id);        

        $about->title = $request->title;
        $about->short_title = $request->short_title;
        $about->short_description = $request->short_description;
        $about->long_description = $request->long_description;

        if ($request->file('about_image')) {
            
            // Save old Image Path before it changed
            $oldImage = $about->about_image;

            // resize image to $width and $height then return the $path/$file as string
            $save_url = $this->saveRezisedImage(
                    $request->file('about_image'),
                    'upload/home_about/',
                    220,
                    220
            );
            $about->about_image = $save_url;

            // move File to current path/$newSubFolder (Default=bin)
            $this->moveFile($oldImage, 'recycle bin');

            $notification = array(
                'message' => 'About Page Updated with Image Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'About Page Updated without Image Successfully',
                'alert-type' => 'success'
            );
        } // end else
        
        $about->save();
        return to_route('about.page')->with($notification);
    } // end of UpdateAbout

    public function HomeAbout() {

        $aboutpage= About::find(1);

        return view('frontend.about_page', compact('aboutpage'));
    } // end of HomeAbout

    public function AboutMultiImage() {
        return view('admin.about_page.multi_image');
    } // end of AboutMultiImage

    public function StoreMultiImage(Request $request) {
        $validator = Validator::make($request->all(), [
            'multi_image' => 'required',
            'multi_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:1024', // 1MB limit
            
        ],
        [
            'multi_image.required' => 'Multi image is Required',
            'multi_image.*.image' => 'All Images must be images',
            'multi_image.*.mimes' => 'All Images must be a files of type: jpeg, png, jpg, gif',
            'multi_image.*.max' => 'All images must not exceed 1MB',
        ]);

        if ($validator->fails()) {
            return to_route('about.multi.image')
                ->withErrors($validator)
                ->withInput();
        }

        $multi_images = $request->file('multi_image');

        foreach ($multi_images as $image) {
            $multiImage = new MultiImage;

            // resize image to $width and $height then return the $path/$file as string
            $multiImage->multi_image = $this->saveRezisedImage(
                $image,
                'upload/multi/',
                220,
                220
            );
            $multiImage->save();
        } // end of foreach

        $notification = array(
            'message' => 'Multi Image Inserted Successfully',
            'alert-type' => 'success'
        );

        return to_route('all.multi.image')->with($notification);
    } // end of StoreMultiImage

    public function AllMultiImage() {
        $allMultiImage = MultiImage::all();
        return view('admin.about_page.all_multi_image', compact('allMultiImage'));
    } // end of AllMultiImage

    public function EditMultiImage($id) {
        $multiImage = MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image', compact('multiImage'));
    } // end of EditMultiImage

    public function UpdateMultiImage(Request $request) {
        // $multi_image_id = $request->id;
        $multiImage = MultiImage::find($request->id);

        if ($request->file('multi_image')) {

            // Save old path
            $oldImage = $multiImage->multi_image;

            $multiImage->multi_image = $this->saveRezisedImage(
                                            $request->file('multi_image'),
                                            'upload/multi/',
                                            220,
                                            220
            );

            // move File to current path/$newSubFolder (Default=bin)
            $this->moveFile($oldImage, 'recycle bin');

            $multiImage->save();

            $notification = array(
                'message' => 'Multi Image Updated Successfully',
                'alert-type' => 'success'
            );

        } else {
            $notification = array(
                'message' => 'No Multi Image uploaded',
                'alert-type' => 'warning'
            );
        } // end else

        return to_route('all.multi.image')->with($notification);
    } // end of UpdateMultiImage

    public function DeleteMultiImage($id) {
        $multi = MultiImage::findOrFail($id);

        unlink($multi->multi_image);
        $multi->delete();

        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return to_route('all.multi.image')->with($notification);
    }

    // Save $file to $path and Resize to $width and $height
    protected function saveRezisedImage($file, $path, $width=300, $height=300) {
        // create save_url (image path as string)
        $image = $file;
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_url = $path.$name_gen;

        // Image Intervention Resize to $width and $height then upload image
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);
        $img = $img->resize($width, $height)->save($save_url);

        // return image path as string
        return $save_url;
    } // end of saveResizedImage

    // move $filePath = 'upload/portfolio/nama_file.jpg'
    // to 'upload/portfolio/$newSubFolder/namafile.jpg'
    public function moveFile($filePath, $newSubFolder='bin')
    {
        $imgDir = dirname($filePath); // dirname($filePath) // Output: upload/portfolio
        $imgName = basename($filePath); // basename($filePath) // Output: nama_file.jpg

        $sourcePath = $filePath;
        $destinationPath = $imgDir. '/' . $newSubFolder . '/' . $imgName;

        

        // If file exist, Move the file to the new folder
        if (File::exists($sourcePath)) {

            // Create Folder if the folder not exist
            if (!File::exists($imgDir.'/'.$newSubFolder)) {
                File::makeDirectory($imgDir.'/'.$newSubFolder, 0777, true, true);
            }

            // move file from $sourcePath to $destinationPath
            File::move($sourcePath, $destinationPath);
            // dd("File moved successfully from " . $sourcePath . " to: " . $destinationPath);

        } else {
            return($sourcePath." file not found.");
        }
    } // end of moveFile
}
