<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Helpers\ImageIntervention;

class PortfolioController extends Controller
{
    public function AllPortfolio() {
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    } // end of AllPortfolio

    public function AddPortfolio() {
        return view('admin.portfolio.portfolio_add');
    } // end of AddPortfolio

    public function StorePortfolio(Request $request) {

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'portfolio_name.required' => 'Portfolio Name is Required',
            'portfolio_title.required' => 'Portfolio Title is Required',
            'portfolio_image.required' => 'Portfolio Image is Required',
            'portfolio_image.image' => 'Portfolio Image must be an image',
            'portfolio_image.mimes' => 'Portfolio Image must be a file of type: jpeg, png, jpg, gif',
            'portfolio_image.max' => 'Portfolio Image must not exceed 2MB',
        ]);

        // this->saveRezisedImage($file, $path, $width, $height)
        $save_url = ImageIntervention::saveRezisedImage(
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
    } // end of Store Portfolio

    public function EditPortfolio($id) {
        $portfolio = Portfolio::find($id);
        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    } // end of EditPortfolio

    public function UpdatePortfolio(Request $request, $id) {
        
        $portfolio = Portfolio::find($id);

        if ($request->file('portfolio_image')) {

            // save old $portfolio->image before it changed
            $oldImage = $portfolio->portfolio_image;

            // This function declared at bottom of Portfolio Controller
            // resize image to $width and $height then return the $path/$file as string
            $save_url = ImageIntervention::saveRezisedImage(
                    $request->file('portfolio_image'),
                    'upload/portfolio/',
                    1020, 519
                );

            $portfolio->portfolio_name = $request->portfolio_name;
            $portfolio->portfolio_title = $request->portfolio_title;
            $portfolio->portfolio_description = $request->portfolio_description;
            $portfolio->portfolio_image = $save_url;
            $portfolio->save();

            // move File to current path/$newSubFolder (Default=bin)
            ImageIntervention::moveFile($oldImage, 'recycle bin');

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
    }  // end of UpdatePortfolio
    
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
    }  // end of DeletePortfolio

    public function PortfolioDetails($id) {

        $portfolio = Portfolio::find($id);
        return view('frontend.portfolio_details', compact('portfolio'));
    }

    public function HomePortfolio() {
        $portfolios = Portfolio::latest()->get();
        return view('frontend.portfolio', compact('portfolios'));
    }
}
