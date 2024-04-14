<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use App\Helpers\ImageIntervention;

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
            $save_url = ImageIntervention::saveRezisedImage(
                $request->file('home_slide'),
                'upload/home_slide/',
                636,
                825
            );
            $homeSlide->home_slide = $save_url;
            ImageIntervention::moveFile($oldImage, 'recycle bin');

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
}
