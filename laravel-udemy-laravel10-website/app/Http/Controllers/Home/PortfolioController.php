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

    public function StorePOrtfolio(Request $request) {

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name.required' => 'Portfolio Name is Required',
            'portfolio_title.required' => 'Portfolio Title is Required',
            'portfolio_image.required' => 'Portfolio Image is Required',
        ]);

        $image = $request->file('portfolio_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);
        $img = $img->resize(1020, 519)->save('upload/portfolio/' . $name_gen);

        $save_url = 'upload/portfolio/'.$name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => now(),
        ]);

        $notification = array(
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);
    } // end method
}
