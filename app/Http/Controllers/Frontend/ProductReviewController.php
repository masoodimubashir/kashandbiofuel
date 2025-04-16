<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductReviewController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {

            try {

                $validator = Validator::make($request->only(['product_id', 'rating', 'comment', 'user_id']), [
                    'rating' => 'required|integer|min:1|max:5',
                    'comment' => 'required|string|max:255',
                    'product_id' => 'required|exists:products,id',
                ]);


                if ($validator->fails()) {
                    Log::error('Validation failed: ' . $validator->errors());
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Something went wrong. Data cannot be saved.'
                        
                    ], 422);
                }

                Reviews::create([
                    'product_id' => $request->product_id,
                    'user_id' => Auth::user()->id,
                    'rating' => $request->rating,
                    'comment' => $request->comment,
                ]);

                $data = Reviews::with('user')
                    ->where('product_id', $request->product_id)
                    ->get();


                return response()->json([
                    'status' => 'success',
                    'data' => $data,
                    'message' => 'Review saved successfully.'
                ]);

            } catch (Exception $e) {

                Log::error($e->getMessage());

                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong.'
                ]);

            }

        }
    }
}
