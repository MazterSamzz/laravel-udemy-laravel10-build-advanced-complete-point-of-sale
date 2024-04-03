<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use Illuminate\support\Carbon;


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
            $img = $img->resize(220, 220)->save('upload/home_about/' . $name_gen);

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

    public function HomeAbout() {

        $aboutpage= About::find(1);

        return view('frontend.about_page', compact('aboutpage'));
    } // end method

    public function AboutMultiImage() {
        return view('admin.about_page.multi_image');
    }

    public function StoreMultiImage(Request $request) {

        $multi_images = $request->file('multi_image');

        foreach ($multi_images as $image) {
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img = $img->resize(220, 220)->save('upload/multi/' . $name_gen);

            $save_url = 'upload/multi/'.$name_gen;

            MultiImage::insert([
                'multi_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        } // end of foreach

        $notification = array(
            'message' => 'Multi Image Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AllMultiImage() {
        $allMultiImage = MultiImage::all();
        return view('admin.about_page.all_multi_image', compact('allMultiImage'));
    }
}
