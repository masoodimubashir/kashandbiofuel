<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;

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
    public function create() {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        try {
            $address = Address::find($id);

            if (!$address) {
                return response()->json([
                    'status' => false,
                    'message' => 'Address not found'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'status' => true,
                'data' => new AddressResource($address)
            ]);
        } catch (Exception $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {

            $validatedData = Validator::make($request->only([
                'address',
                'phone',
                'city',
                'state',
                'pin_code'
            ]), [
                'address' => ['required', 'string', 'max:100'],
                'phone' => ['required', 'digits:10'],
                'state' => ['required', 'string', 'max:100'],
                'city' => ['required', 'string', 'max:100'],
                'pin_code' => ['required', 'string', 'max:10', 'min:1'],
            ]);
        
            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validatedData->errors()
                ], 422);
            }

            $address = Address::find($id);

            if (!$address) {
                
                return response()->json([
                    'status' => false,
                    'error' => 'Address For The User Cannot Be Found!'
                ]);

            }

            $address->update([
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pin_code' => $request->pin_code,
                'phone' => $request->phone
                
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Address updated successfully'
            ]);
        
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
