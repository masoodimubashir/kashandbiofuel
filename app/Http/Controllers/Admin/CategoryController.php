<?php

namespace App\Http\Controllers\Admin;


use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Storage;

use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {

            if ($request->ajax()) {

                $categories = Category::query();

                return DataTables::eloquent($categories)
                    ->addColumn('category_image', function ($category) {

                        $imageUrl = isset($category->image_path) ? 'storage/' . $category->image_path : 'default_images/product_image.png';


                        return '
                        <div class="d-flex align-items-center gap-2 border-0">
                            <img src="' . asset($imageUrl) . '" class="card-img-top rounded" alt="Product Image" style="height: 50px; width:50px; object-fit: cover;">
                            <div class=" text-center">
                                <h6 class=" mb-0 text-truncate">' . $category->name . '</h6>
                            </div>
                        </div>
                    ';
                    })
                    ->addColumn('status', function ($category) {
                        // Determine if the status is on or off
                        $status = $category->status === 1 ? 'on' : 'off';

                        $checkboxId = 'cb_' . $category->id;

                        return '
                        <input class="tgl tgl-skewed changeStatus" id="' . $checkboxId . '" type="checkbox" ' . ($status === 'on' ? 'checked' : '') . '>
                        <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="' . $checkboxId . '"></label>
                    ';
                    })
                    ->addColumn('show_on_navbar', function ($category) {
                        // Determine if show_on_navbar is enabled or disabled
                        $isShown = $category->show_on_navbar === 1 ? 'checked' : '';
                        $checkboxId = 'navbar_' . $category->id;

                        return '
                            <input class="tgl tgl-flip showOnNavbar" id="' . $checkboxId . '" type="checkbox" ' . $isShown . '>
                            <label class="tgl-btn" data-tg-off="No" data-tg-on="Yes!" for="' . $checkboxId . '"></label>
                        ';
                    })
                    ->addColumn('action', function ($category) {
                        // Edit button with Font Awesome icon
                        $editButton = '
                        <i class="fa-regular fa-pen-to-square fs-5 text-success me-3 editBtn" data-id="' . $category->id . '" title="Edit"></i>
                    ';

                        // Delete button with Font Awesome icon and a confirmation prompt
                        $deleteButton = '
                        <i class="fa-solid fa-trash deleteBtn fs-5 text-danger" title="Delete" data-id="' . $category->id . '" id="deleteBtn_' . $category->id . '"></i>
                    ';

                        // Return both buttons together
                        return $editButton . ' ' . $deleteButton;
                    })
                    ->rawColumns(['action', 'status', 'show_on_navbar', 'category_image'])
                    ->make(true);
            }

            return view('layouts.dashboard.Category.categories');
        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch categories',
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:categories,name',
                'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
                'show_on_navbar' => 'nullable|boolean'
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $path = null;

            if ($request->hasFile('image')) {

                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = uniqid('img_') . '.' . $extension;
                $path = $request->file('image')->storeAs('Category_Images', $filename, 'public');
            }



            $category = Category::create([
                'name' => $request->name,
                'status' => 1,
                'image_path' => $path,
                'slug' => Str::of($request->name)->slug('-'),
                'show_on_navbar' => $request->input('show_on_navbar', 0)
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {


            return response()->json([
                'status' => 'success',
                'category' => $category->with('subCategories')->find($category->id)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch category. ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Category $category)
    {

        if ($request->ajax()) {

            return response()->json([
                'status' => 'success',
                'categories' => $category->where('status', 1)->get(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {


        try {



            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', Rule::unique('categories')->ignore($category->id)],
                'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
                'show_on_navbar' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $category = Category::findOrFail($category->id);

            $path = null;

            if ($request->hasFile('image')) {

                if (!is_null($category->image_path) && Storage::disk('public')->exists($category->image_path)) {
                    
                    Storage::disk('public')->delete($category->image_path);
                }


                $extension = $request->file('image')->getClientOriginalExtension();
                $filename = uniqid('img_') . '.' . $extension;
                $path = $request->file('image')->storeAs('Category_Images', $filename, 'public');

            }

            $category->update([
                'name' => $request->name,
                'image_path' => $path,
                'show_on_navbar' => $request->show_on_navbar
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'category updated successfully',
                'data' => $category
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update category',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category = Category::findOrFail($category->id);
            
            if ($category->subCategories()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'This item contains some records in subcategory. Please delete the subcategories first.'
                ], 422); 
            }
            
            if (!is_null($category->image_path) && Storage::disk('public')->exists($category->image_path)) {
                Storage::disk('public')->delete($category->image_path);
            }
            
            $category->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete category: ' . $e->getMessage() 
            ], 422);
        }
    }
}
