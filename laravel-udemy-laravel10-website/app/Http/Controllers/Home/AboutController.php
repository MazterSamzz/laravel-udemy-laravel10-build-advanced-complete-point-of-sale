<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;


class AboutController extends Controller
{
    public function AboutPage() {
        $aboutpage= About::find(1);

        return view('admin.about_page.about_page_all', compact('aboutpage'));
    } // end method

    public function UpdateAbout(Request $request) {
        $slide_id = $request->id;

        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img = $img->resize(523, 605)->save('upload/home_about/' . $name_gen);

            $save_url = 'upload/home_about/'.$name_gen;

            About::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'About Page Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {
            About::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

            $notification = array(
                'message' => 'About Page Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } // end else
    } // end method
}
