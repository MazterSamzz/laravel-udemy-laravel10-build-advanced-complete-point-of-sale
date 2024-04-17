<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;

class FooterController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create(): never
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        $footer = Footer::find(1);
        return view('admin.footer.edit', compact('footer'));
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'number' => 'required|starts_with:+62,0|numeric|min:10',
            'short_description' => 'required',
            'address' => 'required|min:5|max:100',
            'email' => 'required|email',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'copyright' => 'required|string',
        ],[
            'number.required' => 'Phone number is required.',
            'number.starts_with' => 'Phone number must start with +62 or 0.',
            'number.numeric' => 'Phone number must be numeric.',
            'number.min' => 'Phone number must be at least :min digits.',
            'short_description.required' => 'Short description is required.',
            'address.required' => 'Address is required.',
            'address.min' => 'Address must be at least :min characters long.',
            'address.max' => 'Address cannot exceed :max characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Email address must be in a valid format.',
            'facebook.url' => 'Invalid Facebook link format.',
            'twitter.url' => 'Invalid Twitter link format.',
            'copyright.required' => 'Copyright information is required.',
            'copyright.string' => 'Copyright information must be text.',
        ]);

        $footer = Footer::find(1);

        $footer->number = $request->number;
        $footer->short_description = $request->short_description;
        $footer->address = $request->address;
        $footer->email = $request->email;
        $footer->facebook = $request->facebook;
        $footer->twitter = $request->twitter;
        $footer->copyright = $request->copyright;

        if($footer->save()) {
            $notification = array(
                'message' => 'Footer updated Successfully',
                'alert-type' => 'success',
            );
        }
        
        return to_route('footer.edit', compact('footer'))->with($notification);
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
        abort(404);
    }
}
