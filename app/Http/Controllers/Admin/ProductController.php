<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $products = Product::with('category', 'subCategory', 'productAttributes')->get();

            $categories = Category::where('status', 1)->latest()->get();

            $subcategories = SubCategory::where('status', 1)->latest()->get();

            if ($request->ajax()) {

                $products = Product::query()
                    ->with('productAttributes'); // Load only the images relationship

                return DataTables::eloquent($products)
                    ->addColumn('product_name', function ($product) {

                        $image = $product->productAttributes->first();
                        $imageUrl = $image ? asset('storage/' . $image->image_path) : asset('dashboard/assets/images/Product/product_default.png');


                        return
                            '
                            <div class="Product-names d-flex align-items-center gap-2" >
                              <img class="img-fluid rounded" style="height:70px; width:70px" src="' . $imageUrl . '" alt="Product Image">
                                <p>' . $product->name . '</p>
                            </div>';
                    })
                    ->addColumn('status', function ($product) {

                        $status = $product->status === 1 ? 'on' : 'off';
                        $checkboxId = 'cb_' . $product->id;

                        return '
                        <input class="tgl tgl-skewed changeStatus" id="' . $checkboxId . '" type="checkbox" ' . ($status === 'on' ? 'checked' : '') . '>
                        <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="' . $checkboxId . '"></label>
                    ';
                    })
                    ->addColumn('action', function ($product) {

                        // Edit button
                        $editButton = '
                            <a href="' . route('products.edit', $product->id) . '" >
                                <i style="cursor:pointer;" class="fa-solid fa-pen-to-square fs-5 text-success me-3 editBtn"
                                   title="Edit"></i>
                            </a>';

                        // Show button
                        $showButton = '
                            <a href="' . route('products.show', $product->id) . '" >
                                <i style="cursor:pointer;" class="fa-regular fa-eye fs-5 text-success me-3 showBtn"
                                   title="Show"></i>
                            </a>';

                        // Delete button
                        $deleteButton = '
                            <i style="cursor:pointer;" class="fa-solid fa-trash deleteBtn fs-5 text-danger me-3"
                               data-id="' . $product->id . '"
                               id="deleteBtn_' . $product->id . '"
                               title="Delete"></i>';

                        $seoButton = '
                               <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#seoModal"
                                   data-id="' . $product->id . '" aria-label="Edit SEO for Product ' . htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8') . '">
                                   SEO
                               </button>';


                        return '<div class="d-flex justify-content-start gap-2 align-items-center">' . $editButton . $showButton . $deleteButton . $seoButton . '</div>';

                    })
                    ->editColumn('price', function ($product) {
                        return $product->price; // Format price
                    })
                    ->editColumn('selling_price', function ($product) {
                        return $product->selling_price; // Format selling price
                    })
                    ->rawColumns(['product_name', 'status', 'action']) // Allow rendering of HTML for these columns

                    ->make(true);
            }

            return view('layouts.dashboard.Product.products', compact('categories', 'products'));
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch products',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {


        $product = $product->with(['category', 'subCategory', 'productAttributes'])->find($product->id);
        $uniqueHexCodes = $product->productAttributes->unique('hex_code')->pluck('hex_code');


        return view('layouts.dashboard.Product.view-product', compact('product', 'uniqueHexCodes'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {

        if ($request->ajax()) {

            return response()->json([
                'status' => 'success',
                'product' => Product::with('productAttributes')->find($id),
                'categories' => Category::where('status', 1)->get()
            ]);
        }

        $product = Product::with('productAttributes', 'category')->find($id);

        $categories = DB::table('categories')->where('status', 1)->get();


        return view('layouts.dashboard.Product.edit-product', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {


            DB::beginTransaction();


            $product = Product::findOrFail($id);
            $productFolder = 'products/' . $product->slug;

            $tags = explode(',', $request->search_tags);
            $request->merge(['search_tags' => json_encode($tags)]);

            $product->update([
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'name' => $request->name,
                'sku' => $request->sku,
                'search_tags' => $request->search_tags,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'selling_price' => $request->selling_price,
                'qty' => $request->qty,
                'status' => 1,
                'crafted_date' => $request->crafted_date,
                'short_description' => $request->short_description,
                'additional_description' => $request->additional_description,
                'description' => $request->description,
                'featured' => $request->filled('featured') ? 1 : 0,
                'discounted' => $request->filled('discounted') ? 1 : 0,
                'new_arrival' => $request->filled('new_arrival') ? 1 : 0,
            ]);


            if ($request->filled('product_attributes')) {

                foreach ($request->product_attributes as $attributeData) {


                    if (!isset($attributeData['images'])) {

                        $attribute = ProductAttribute::find($attributeData['id']);


                        if ($attribute) {
                            $attribute->update(['hex_code' => $attributeData['hex_code']]);
                        }
                    } else if (isset($attributeData['images'])) {

                        foreach ($attributeData['images'] as $image) {

                            $imagePath = $image->store($productFolder, 'public');

                            ProductAttribute::create([
                                'product_id' => $product->id,
                                'image_path' => $imagePath,
                                'hex_code' => $attributeData['hex_code']
                            ]);
                        }
                    }
                }
            }


            // Remove deleted attributes
            if ($request->filled('removed_attributes')) {
                // dd($request->removed_attributes);
                $removedIds = explode(',', $request->removed_attributes);
                $removedAttributes = ProductAttribute::whereIn('id', $removedIds)->get();

                foreach ($removedAttributes as $attribute) {
                    Storage::disk('public')->delete($attribute->image_path);
                    $attribute->delete();
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully',
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'sku' => 'required|string|unique:products,sku',
                'price' => ['required', 'numeric', 'decimal:0,2', 'min:0', 'max:99999999.99'],
                'selling_price' => ['required', 'numeric', 'decimal:0,2', 'min:0', 'max:99999999.99'],
                'short_description' => 'required|string',
                'additional_description' => 'required|string',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'product_attributes' => 'required|array|min:1',
                'product_attributes.*.hex_code' => 'required|string|max:7',
                'product_attributes.*.images' => 'required|array|min:1',
                'product_attributes.*.images.*' => 'required|file|mimes:jpeg,png,jpg,webp|max:2048',
                'search_tags' => 'required',
                'crafted_date' => 'required|date',
                'qty' => 'required|string|min:1'
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }


            $tags = explode(',', $request->search_tags);
            $request->merge(['search_tags' => json_encode($tags)]);

            $product = Product::create([

                'name' => $request->name,
                'sku' => $request->sku,
                'price' => $request->price,
                'selling_price' => $request->selling_price,
                'short_description' => $request->short_description,
                'additional_description' => $request->additional_description,
                'description' => $request->description,
                'crafted_date' => $request->crafted_date,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'search_tags' => $request->search_tags,
                'slug' => Str::slug($request->name),
                'status' => 1,
                'qty' => $request->qty,
                'featured' => $request->filled('featured') ? 1 : 0,
                'discounted' => $request->filled('discounted') ? 1 : 0,
                'new_arrival' => $request->filled('new_arrival') ? 1 : 0,

            ]);


            $productFolder = 'products/' . $product->slug;
            Storage::makeDirectory('public/' . $productFolder);


            $productAttributes = [];
            foreach ($request->product_attributes as $attribute) {
                foreach ($attribute['images'] as $image) {
                    $imagePath = $image->store($productFolder, 'public');

                    $productAttributes[] = [
                        'product_id' => $product->id,
                        'image_path' => $imagePath,
                        'hex_code' => $attribute['hex_code'],
                        'created_at' => now()
                    ];
                }
            }

            DB::table('product_attributes')->insert($productAttributes);
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create Product: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction(); // Start the transaction

        try {
            // 1. Delete associated Product attribute images from the storage
            $productAttributes = ProductAttribute::where('product_id', $product->id)
                ->get();

            // Delete the image files from storage, if they exist
            foreach ($productAttributes as $attribute) {

                $imagePath = 'public/' . $attribute->image_path;


                if (Storage::disk('public')->exists($attribute->image_path)) {

                    Storage::disk('public')->delete($attribute->image_path); // Delete each image file
                }
            }


            // 2. Delete the associated Product attributes from the database
            ProductAttribute::where('product_id', $product->id)
                ->delete();

            // 3. Delete the Product folder from storage (including subdirectories)
            $productFolder = 'products/' . $product->slug; // Get the folder path using the Product's slug
            if (Storage::exists('public/' . $productFolder)) {
                Storage::deleteDirectory('public/' . $productFolder); // Delete the entire Product folder
            }

            // 4. Delete the Product itself from the database (forceDelete for permanent removal if using soft deletes)
            $product->forceDelete(); // or $Product->delete(); if soft delete is used

            DB::commit(); // Commit the transaction

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully',
            ]);
        } catch (Exception $e) {
            DB::rollBack(); // Rollback the transaction on failure
            Log::error('Failed to delete Product: ' . $e->getMessage()); // Log the error for debugging
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete Product: ' . $e->getMessage(),
            ], 500);
        }
    }
}
