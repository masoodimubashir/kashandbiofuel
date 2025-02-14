<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class DashboardContactUsController extends Controller
{


    public function index(Request $request)
    {

        try {
            if ($request->ajax()) {

                $contact_us = ContactUs::query();

                return DataTables::eloquent($contact_us)
                    ->addColumn('name', function($contact_us) {
                        return $contact_us->name . ' ' . $contact_us->lastname;
                    })
                    ->make(true);
            
            }

            return view('layouts.dashboard.ContactUs.contact-us');

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch data',
            ], 500);
        }

    }
}
