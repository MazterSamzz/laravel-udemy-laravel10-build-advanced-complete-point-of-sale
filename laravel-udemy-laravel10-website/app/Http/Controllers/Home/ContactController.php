<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create()
    {
        return view('frontend.contact');
    } // end of create

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request)
    {

        $contacts = new Contact;

        $contacts->name = $request->name;
        $contacts->email = $request->email;
        $contacts->subject = $request->subject;
        $contacts->phone = $request->phone;
        $contacts->message = $request->message;

        if($contacts->save()) {
            $notification = array(
                'message' => 'Your message submitted Successfully',
                'alert-type' => 'success',
            );
        }else {
            $notification = array(
                'message' => 'Your message didn\'t sent',
                'alert-type' => 'error',
            );
        }

        return to_route(url('/'))->with($notification);

    }

}
