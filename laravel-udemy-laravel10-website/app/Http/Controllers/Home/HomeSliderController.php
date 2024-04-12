<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use Illuminate\Support\Facades\File;

class HomeSliderController extends Controller
{
    //
    public function HomeSlider(){
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeslide'));
    } // end method

    public function UpdateSlider(Request $request, $id) {
        $homeSlide = HomeSlide::find($id);
        $oldImage = $homeSlide->home_slide;
        
        $homeSlide->title = $request->title;
        $homeSlide->short_title = $request->short_title;
        $homeSlide->video_url = $request->video_url;

        if ($request->file('home_slide')) {

            // create save_url (image path as string)
            $save_url = $this->saveRezisedImage(
                $request->file('home_slide'),
                'upload/home_slide/',
                636,
                825
            );
            $homeSlide->home_slide = $save_url;
            $this->moveFile($oldImage, 'recycle bin');

            // -------- Mass Assignment --------
            // HomeSlide::findOrFail($slide_id)->update([
            //     'title' => $request->title,
            //     'short_title' => $request->short_title,
            //     'video_url' => $request->video_url,
            //     'home_slide' => $save_url,
            // ]); -------- end of Mass Assignment --------

            $notification = array(
                'message' => 'Home slide Updated with Image Successfully',
                'alert-type' => 'success'
            );

            
        } else {
            // -------- Mass Assignment --------
            // HomeSlide::findOrFail($slide_id)->update([
            //     'title' => $request->title,
            //     'short_title' => $request->short_title,
            //     'video_url' => $request->video_url,
            // ]); -------- end of Mass Assignment --------

            $notification = array(
                'message' => 'Home slide Updated without Image Successfully',
                'alert-type' => 'success'
            );
        } // end else

        $homeSlide->save();
        return to_route('home.slide')->with($notification);
    } // end of UpdateSlider

    // Save $file to $path and Resize to $width and $height
    protected function saveRezisedImage($file, $path, $width=300, $height=300) {
        
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
