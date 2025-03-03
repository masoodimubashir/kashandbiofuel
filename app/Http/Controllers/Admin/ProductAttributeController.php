<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductAttributeController extends Controller
{
    public function index($productId)
    {

        $images = ProductAttribute::where('product_id', $productId)
            ->get()
            ->map(function ($attribute) {
                return [
                    'id' => $attribute->id,
                    'url' => asset('storage/' . $attribute->image_path),
                    'hex_code' => $attribute->hex_code
                ];
            });

        return response()->json(['images' => $images]);
    }

    public function store(Request $request, $productId)
    {

        try {
            $request->validate([
                'filepond' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'hex_code' => 'required|string'
            ]);

            if ($request->hasFile('filepond')) {

                $path = $request->file('filepond')->store('products', 'public');

                $attribute = ProductAttribute::updateOrCreate(
                    [
                        'product_id' => $productId,
                        'hex_code' => $request->hex_code
                    ],
                    ['image_path' => $path]
                );

                return response()->json([
                    'id' => $attribute->id,
                    'success' => true
                ]);

            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Invalid file format. Only JPEG, PNG, JPG, and GIF images are allowed.',
            ], 400);
        }
    }

    public function destroy($productId, $attributeId)
    {

        dd($productId, $attributeId);
        $attribute = ProductAttribute::where('product_id', $productId)
            ->where('id', $attributeId)
            ->firstOrFail();

        Storage::disk('public')->delete($attribute->image_path);
        $attribute->delete();

        return response()->json(['success' => true]);
    }
}
