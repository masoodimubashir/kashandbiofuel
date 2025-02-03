<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        try {
            if ($request->ajax()) {

                $contacts = ContactUs::query();

                return DataTables::eloquent($contacts)
                    ->addColumn('name', function ($contact_us) {
                        // Concatenate the user's first name and last name
                        return $contact_us->firstname . ' ' . $contact_us->lastname;
                    })
                    ->addColumn('email', function ($contact_us) {
                        // Email column
                        return $contact_us->email;
                    })
                    ->addColumn('phone', function ($contact_us) {
                        // Phone column
                        return $contact_us->phone ?? '-'; // Handle if phone is null
                    })
                    ->addColumn('message', function ($contact_us) {
                        // Message column
                        return $contact_us->message ?? '-'; // Handle if message is null
                    })
                    ->addColumn('created_at', function ($contact_us) {
                        // Format the created_at column
                        return $contact_us->created_at ? $contact_us->created_at->format('Y-m-d H:i:s') : '-';
                    })
                    ->make(true);

            }


            return view('layouts.dashboard.User.users');

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch users',
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
