<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChangeFlagsController extends Controller
{
    public function index(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        dd($product);

        // Update the flag for the Product
        $product->flag = $request->flag;
        $product->save();

        // Return a JSON response indicating success
        return response()->json(['status' => 'success', 'message' => 'Product flag updated successfully']);
    }
}
