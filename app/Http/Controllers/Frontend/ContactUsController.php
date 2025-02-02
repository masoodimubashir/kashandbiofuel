<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function index(Request $request)
    {
        return view('frontend.contact-us');
    }

    public function store(ContactUsRequest $request)
    {


        try {

            ContactUs::create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Thank you for contacting us. We will get back to you soon.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.',
            ]);
        }


    }
}
