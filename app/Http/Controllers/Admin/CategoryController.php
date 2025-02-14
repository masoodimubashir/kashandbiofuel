<?php

namespace App\Http\Controllers\Admin;


use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

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
                    ->rawColumns(['action', 'status', 'show_on_navbar'])
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
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:categories,name',
//                'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
                'show_on_navbar' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }


            $category = Category::create([
                'name' => $request->name,
                'status' => 1,
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

            $category = Category::findOrFail($category->id);

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', Rule::unique('categories')->ignore($category->id)],
                'show_on_navbar' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $category->update([
                'name' => $request->name,
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

            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'category deleted successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete category',
            ], 500);
        }
    }
}
