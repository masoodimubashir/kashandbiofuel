<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\User;
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

                $users = User::query()
                    ->with(['address', 'roles'])
                    ->whereHas('roles', function ($q) {
                        $q->where('name', 'user');
                    });
                
                return DataTables::eloquent($users)
//                    ->addColumn('user_name_image', function ($user) {
//
//                        $imageUrl = asset('storage/' . $user->image_path);
//
//                        return '
//                            <div class="card shadow-sm border-0" style="width: 12rem;">
//                                <img src="' . $imageUrl . '" class="card-img-top rounded" alt="Product Image" style="height: 150px; object-fit: cover;">
//                                <div class="card-body text-center">
//                                    <h6 class="card-title mb-0 text-truncate">' . $user->name . '</h6>
//                                </div>
//                            </div>
//                        ';
//                    })
                    ->addColumn('phone', function ($user) {
                        return $user->address->phone ?? '-';
                    })
                    ->addColumn('address', function ($user) {
                        return
                            ($user->address->city ?? '') . ' ' .
                            ($user->address->state ?? '') . ' ' .
                            ($user->address->pin_code ?? '-');
                    })
                    ->rawColumns(['user_name_image'])
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
