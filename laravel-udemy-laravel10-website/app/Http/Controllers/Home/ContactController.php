<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create() {
        return view('frontend.contact');
    } // end of create
}
