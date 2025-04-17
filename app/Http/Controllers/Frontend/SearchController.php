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
            $searchQuery = $request->input('query');

            $products = Product::query()
                ->with('productAttribute')
                ->where(function ($query) use ($searchQuery) {
                    $searchQuery = trim($searchQuery);
                    if (!empty($searchQuery)) {
                        $query->where('name', 'like', "{$searchQuery}%")
                            ->orWhere('slug', 'like', "{$searchQuery}%");
                    }
                })
                ->limit(10)
                ->get();

            if ($products->isEmpty()) {
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


    public function mobileSearchView()
    {

        return view('frontend.search.mobile-search');
    }

    public function searchProduct(Request $request)
    {

        try {


            $searchQuery = $request->input('query');

            $products = Product::query()
                ->with('productAttribute')
                ->where(function ($query) use ($searchQuery) {
                    $searchQuery = trim($searchQuery);
                    if (!empty($searchQuery)) {
                        $query->where('name', 'like', "{$searchQuery}%")
                            ->orWhere('slug', 'like', "{$searchQuery}%");
                    }
                })
                ->limit(10)
                ->get();

            if ($products->isEmpty()) {
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
