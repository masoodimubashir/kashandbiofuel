<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
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
use Number;
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
                    ->with('productAttribute');

                return DataTables::eloquent($products)
                    ->addColumn('product_name', function ($product) {
                        return '
                            <div class="d-flex align-items-center gap-2 border-0">
                                <div class=" text-center">
                                    <h6 class=" mb-0 text-truncate">' . $product->name . '</h6>
                                </div>
                            </div>
                        ';
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
                        return Number::currency($product->price, 'INR'); // Format price
                    })
                    ->editColumn('selling_price', function ($product) {
                        return Number::currency($product->selling_price, 'INR'); // Format selling price
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
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'sku' => 'required|string|unique:products,sku,' . $id,
                'price' => ['required', 'numeric', 'decimal:0,2', 'min:0', 'max:99999999.99'],
                'selling_price' => ['required', 'numeric', 'decimal:0,2', 'min:0', 'max:99999999.99'],
                'short_description' => 'required|string',
                'additional_description' => 'required|string',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'product_attributes' => 'required|array|min:1',
                'product_attributes.*.hex_code' => 'required|string|max:7',
                'product_attributes.*.qty' => 'required|integer|min:0',
                'product_attributes.*.images.*' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:2048',
                'crafted_date' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $totalQty = collect($request->product_attributes)->sum('qty');
            $product = Product::findOrFail($id);
            $productFolder = 'products/' . Str::slug($request->name);

            $product->update([
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'name' => $request->name,
                'sku' => $request->sku,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'selling_price' => $request->selling_price,
                'qty' => $totalQty,
                'status' => 1,
                'crafted_date' => $request->crafted_date,
                'short_description' => $request->short_description,
                'additional_description' => $request->additional_description,
                'description' => $request->description,
                'featured' => $request->boolean('featured'),
                'discounted' => $request->boolean('discounted'),
                'new_arrival' => $request->boolean('new_arrival'),
            ]);

            foreach ($request->product_attributes as $attributeData) {
                if (isset($attributeData['id'])) {
                    // Update existing attribute
                    $attribute = ProductAttribute::find($attributeData['id']);
                    if ($attribute) {
                        $imagePaths = json_decode($attribute->images) ?? [];

                        // Handle new images
                        if (isset($attributeData['images'])) {
                            foreach ($attributeData['images'] as $image) {
                                $imagePaths[] = $image->store($productFolder, 'public');
                            }
                        }

                        $attribute->update([
                            'hex_code' => $attributeData['hex_code'],
                            'qty' => $attributeData['qty'],
                            'images' => json_encode($imagePaths)
                        ]);
                    }
                } else {
                    // Create new attribute
                    $imagePaths = [];
                    if (isset($attributeData['images'])) {
                        foreach ($attributeData['images'] as $image) {
                            $imagePaths[] = $image->store($productFolder, 'public');
                        }
                    }

                    ProductAttribute::create([
                        'product_id' => $product->id,
                        'images' => json_encode($imagePaths),
                        'qty' => $attributeData['qty'],
                        'hex_code' => $attributeData['hex_code'],
                    ]);
                }
            }

            // Handle removed attributes
            if ($request->filled('removed_attributes')) {
                $removedIds = explode(',', $request->removed_attributes);
                $removedAttributes = ProductAttribute::whereIn('id', $removedIds)->get();

                foreach ($removedAttributes as $attribute) {
                    // Delete all images from storage
                    $imagePaths = json_decode($attribute->images) ?? [];
                    foreach ($imagePaths as $imagePath) {
                        Storage::disk('public')->delete($imagePath);
                    }
                    $attribute->delete();
                }
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        try {

        

            $totalQty = collect($request->validated('attributes'))->sum('qty');

            $product = Product::create([
                'name' => $request->name,
                'sku' => $request->sku,
                'price' => $request->price,
                'selling_price' => $request->final_price,
                'short_description' => $request->short_description,
                'additional_description' => $request->additional_description,
                'description' => $request->description,
                'crafted_date' => $request->crafted_date,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'slug' => Str::slug($request->name),
                'status' => 1,
                'qty' => $totalQty,
                'gst_amount' => $request->gst_percentage,
                'featured' => $request->boolean('featured'),
                'discounted' => $request->boolean('discounted'),
                'new_arrival' => $request->boolean('new_arrival'),
            ]);


            $productFolder = 'products/' . $product->slug;
            Storage::makeDirectory('public/' . $productFolder);

            foreach ($request->validated('attributes') as $attribute) {

                $imagePaths = [];

                foreach ($attribute['images'] as $image) {
                    $imagePaths[] = $image->store($productFolder, 'public');
                }

                ProductAttribute::create([
                    'product_id' => $product->id,
                    'qty' => $attribute['qty'],
                    'hex_code' => $attribute['hex_code'],
                    'images' => json_encode($imagePaths)
                ]);

                DB::commit();
            }


            return response()->json([
                'success' => true,
                'message' => 'Product created successfully'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create Product: ' . $e->getMessage()
            ], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {

            $productFolder = 'products/' . $product->slug;

            foreach ($product->productAttributes as $attribute) {
                $images = json_decode($attribute->images) ?? [];

                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }

                $attribute->delete();
            }

            if (Storage::exists('public/' . $productFolder)) {

                Storage::deleteDirectory('public/' . $productFolder);
            }

            $product->forceDelete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete product'
            ], 500);
        }
    }
}
