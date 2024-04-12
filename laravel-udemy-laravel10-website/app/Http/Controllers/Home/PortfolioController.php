<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function AllPortfolio() {
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    } // end method

    public function AddPortfolio() {
        return view('admin.portfolio.portfolio_add');
    } // end method

    public function StorePortfolio(Request $request) {

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name.required' => 'Portfolio Name is Required',
            'portfolio_title.required' => 'Portfolio Title is Required',
            'portfolio_image.required' => 'Portfolio Image is Required',
            'portfolio_image.image' => 'Portfolio Image must be an image',
            'portfolio_image.mimes' => 'Portfolio Image must be a file of type: jpeg, png, jpg, gif',
            'portfolio_image.max' => 'Portfolio Image must not exceed 2MB',
        ]);

        // this->saveRezisedImage($file, $path, $width, $height)
        $save_url = $this->saveRezisedImage(
            $request->file('portfolio_image'),
            'upload/portfolio/',
            1020, 519
        );

        $portfolio = new Portfolio;

        $portfolio->portfolio_name = $request->portfolio_name;
        $portfolio->portfolio_title = $request->portfolio_title;
        $portfolio->portfolio_description = $request->portfolio_description;
        $portfolio->portfolio_image = $save_url;
        $portfolio->save();

        // -------- Mass Asignment --------
        // Portfolio::create([
        //     'portfolio_name' => $request->portfolio_name,
        //     'portfolio_title' => $request->portfolio_title,
        //     'portfolio_description' => $request->portfolio_description,
        //     'portfolio_image' => $save_url,
        // ]);

        $notification = array(
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success'
        );

        return to_route('all.portfolio')->with($notification);
    } // end method

    public function EditPortfolio($id) {
        $portfolio = Portfolio::find($id);
        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    } // end method

    public function UpdatePortfolio(Request $request, $id) {
        
        $portfolio = Portfolio::find($id);

        if ($request->file('portfolio_image')) {

            // save old $portfolio->image before it changed
            $oldImage = $portfolio->portfolio_image;

            
            // This function declared at bottom of Portfolio Controller
            // resize image to $width and $height then return the $path/$file as string
            $save_url = $this->saveRezisedImage(
                    $request->file('portfolio_image'),
                    'upload/portfolio/',
                    1020, 519
                );

            $portfolio->portfolio_name = $request->portfolio_name;
            $portfolio->portfolio_title = $request->portfolio_title;
            $portfolio->portfolio_description = $request->portfolio_description;
            $portfolio->portfolio_image = $save_url;
            $portfolio->save();

            // This function declared at bottom of Portfolio Controller
            // move File to current path/$newSubFolder (Default=bin)
            $this->moveFile($oldImage, 'recycle bin');

            // -------- Mass Asignment --------
            // Portfolio::findOrFail($id)->update([
            //     'portfolio_name' => $request->portfolio_name,
            //     'portfolio_title' => $request->portfolio_title,
            //     'portfolio_description' => $request->portfolio_description,
            //     'portfolio_image' => $save_url,
            //     'updated_at' => now(),
            // ]);
            // -------- End of Mass Asignment --------

            $notification = array(
                'message' => 'Portfolio Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return to_route('all.portfolio')->with($notification);
        } else {
            $portfolio->portfolio_name = $request->portfolio_name;
            $portfolio->portfolio_title = $request->portfolio_title;
            $portfolio->portfolio_description = $request->portfolio_description;
            $portfolio->save();

            // Portfolio::findOrFail($id)->update([
            //     'portfolio_name' => $request->portfolio_name,
            //     'portfolio_title' => $request->portfolio_title,
            //     'portfolio_description' => $request->portfolio_description,
            //     'updated_at' => now(),
            // ]);

            $notification = array(
                'message' => 'Portfolio Updated without Image Successfully',
                'alert-type' => 'success'
            );
            
            return to_route('all.portfolio')->with($notification);
        } // end else
    }  // end method
    
    public function DeletePortfolio($id) {
        $portfolio = Portfolio::findOrFail($id);

        $img = $portfolio->portfolio_image;
        unlink($img);
        $portfolio->delete();
        
        $notification = array(
            'message' => 'Portfolio Deleted Successfully',
            'alert-type' => 'success'
        );

        return to_route('all.portfolio')->with($notification);
    }  // end method

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
    }

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
    }
}
