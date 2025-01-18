<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function index(Request $request)
    {



        return view('frontend.contact-us');
    }

    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'message' => 'required',
        ]);

        
    }
}
