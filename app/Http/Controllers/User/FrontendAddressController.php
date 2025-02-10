<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontendAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Address::latest()->get();


        return response()->json(AddressResource::collection($data));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {

        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        Address::create($data);

        return response()->json(['status' => true, 'message' => 'Address added successfully'], Response::HTTP_CREATED);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
