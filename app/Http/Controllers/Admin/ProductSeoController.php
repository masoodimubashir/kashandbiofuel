<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductSeoController extends Controller
{

    public function index(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [

                'meta_title' => 'required|string',
                'meta_description' => 'required|string',
                'meta_keyword' => 'required|string',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $product = Product::find($request->product_id);

            $product->meta_title = $request->meta_title;
            $product->meta_description = $request->meta_description;
            $product->meta_keyword = $request->meta_keyword;
            $product->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Product SEO Updated Successfully'
            ]);
        } catch (\Throwable $th) {
            //throw $th;

            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
