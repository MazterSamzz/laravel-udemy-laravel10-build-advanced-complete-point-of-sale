<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;

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

        // This function declared at Portfolio Controller
        $save_url = $this->image_intervention($request->file('portfolio_image'));

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
            
            // This function declared at Portfolio Controller
            $save_url = $this->image_intervention($request->file('portfolio_image'));

            $portfolio->portfolio_name = $request->portfolio_name;
            $portfolio->portfolio_title = $request->portfolio_title;
            $portfolio->portfolio_description = $request->portfolio_description;
            $portfolio->portfolio_image = $save_url;
            $portfolio->save();

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

    // Image Intervention Function
    protected function image_intervention($file) {
        // create save_url
        $image = $file;
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $save_url = 'upload/portfolio/'.$name_gen;

        // Image Intervention and upload image
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);
        $img = $img->resize(1020, 519)->save($save_url);

        return $save_url;
    }
}
