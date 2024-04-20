<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

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

        return to_route('contacts.create')->with($notification);

    } // end of store

    /**
     * Remove the resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        if($contact->delete()) {
            $notification = array(
                'message' => 'Message deleted Successfully',
                'alert-type' => 'success',
            );
        }else {
            $notification = array(
                'message' => 'Delete message failed',
                'alert-type' => 'error',
            );
        }

        return to_route('contacts.index')->with($notification);

    } // end of destroy

}
