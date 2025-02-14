<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {

                $subCategories = SubCategory::with('category'); // Eager load category for better performance

                return DataTables::eloquent($subCategories)
                    ->addColumn('status', function ($subCategory) {

                        $status = $subCategory->status === 1 ? 'on' : 'off';

                        $checkboxId = 'cb_' . $subCategory->id;

                        return '
                            <input class="tgl tgl-skewed changeStatus" id="' . $checkboxId . '" type="checkbox" ' . ($status === 'on' ? 'checked' : '') . '>
                            <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="' . $checkboxId . '"></label>
                        ';
                    })
                    ->addColumn('show_on_navbar', function ($subCategories) {
                        // Determine if show_on_navbar is enabled or disabled
                        $isShown = $subCategories->show_on_navbar === 1 ? 'checked' : '';
                        $checkboxId = 'navbar_' . $subCategories->id;

                        return '
                            <input class="tgl tgl-flip showOnNavbar" id="' . $checkboxId . '" type="checkbox" ' . $isShown . '>
                            <label class="tgl-btn" data-tg-off="No" data-tg-on="Yes!" for="' . $checkboxId . '"></label>
                        ';
                    })
                    ->addColumn('action', function ($subCategory) {
                        $editButton = '
                            <i class="fa-regular fa-pen-to-square editBtn fs-5 text-success me-3" data-id="' . $subCategory->id . '"  title="Edit"></i>
                        ';

                        $deleteButton = '
                            <i class="fa-solid fa-trash deleteBtn fs-5 text-danger"  title="Delete" data-id="' . $subCategory->id . '" id="deleteBtn_' . $subCategory->id . '"></i>
                        ';

                        return $editButton . ' ' . $deleteButton;
                    })
                    ->rawColumns(['action', 'status', 'show_on_navbar'])
                    ->make(true);
            }

            $categories = Category::where('status', 1)->latest()->get();

            return view('layouts.dashboard.SubCategory.subCategories', compact('categories'));
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch sub-categories',
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

                'name' => 'required|string|unique:sub_categories,name',
                'category_id' => 'required|exists:categories,id',
                'show_on_navbar' => 'nullable|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $subCategory = SubCategory::create([
                'name' => $request->name,
                'status' => 1,
                'slug' => Str::of($request->name)->slug('-'),
                'category_id' => $request->category_id,
                'show_on_navbar' => $request->show_on_navbar,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'SubCategory created successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create SubCategory',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {


        try {
            if (!$subCategory) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'SubCategory not found',
                ], 404);  // 404 status code
            }

            return response()->json([
                'status' => 'success',
                'subCategory' => $subCategory,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        // Return the subcategory data along with categories for the dropdown
        $categories = Category::all();
        return response()->json([
            'subCategory' => $subCategory,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {

        try {

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', Rule::unique('sub_categories')->ignore($subCategory->id)],
                'category_id' => 'required|exists:categories,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $subCategory->update([
                'name' => $request->name,
                'category_id' => $request->category_id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'SubCategory updated successfully',
                'data' => $subCategory
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update SubCategory',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        try {
            $subCategory->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'SubCategory deleted successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete SubCategory',
            ], 500);
        }
    }
}
