<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {

        try {

            $query = request('query');

            $products = Product::query()
                ->with('productAttribute')
                ->whereHas('productAttribute')
                ->where('name', 'like', "%{$query}%")
                ->orWhere('slug', 'like', "%{$query}%")
                ->select('id', 'name', 'description', 'slug')
                ->limit(10)
                ->get();

            if (is_null($products) || $products) {
                return response()->json([
                    'success' => false,
                    'message' => 'No Product Found',
                ]);
            }

            return response()->json($products);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
