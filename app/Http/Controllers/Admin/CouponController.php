<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {

                $coupons = Coupon::query();

                return DataTables::eloquent($coupons)
                    ->addColumn('coupon_type', function ($coupon) {
                        return $coupon->coupon_type === 1 ? 'Percentage' : 'Fixed Amount';
                    })
                    ->addColumn('status', function ($coupon) {
                        $status = $coupon->status === 1 ? 'on' : 'off';
                        $checkboxId = 'cb_' . $coupon->id;

                        return '
                                <input class="tgl tgl-skewed changeStatus" id="' . $checkboxId . '" type="checkbox" ' . ($status === 'on' ? 'checked' : '') . '>
                                <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="' . $checkboxId . '"></label>
                            ';
                    })
                    ->addColumn('action', function ($coupon) {
                        $editButton = '
                                <i class="fa-regular fa-pen-to-square fs-5 text-success me-3 editBtn" style="cursor:pointer" data-id="' . $coupon->id . '" title="Edit"></i>
                            ';
                        $deleteButton = '
                                <i class="fa-solid fa-trash deleteBtn fs-5 text-danger" style="cursor:pointer" title="Delete" data-id="' . $coupon->id . '" id="deleteBtn_' . $coupon->id . '"></i>
                            ';
                        return $editButton . ' ' . $deleteButton;
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }

            return view('layouts.dashboard.Coupon.coupons');

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch coupons',
            ], 500);
        }
    }

    public function store(Request $request)
    {


        try {
            $validator = Validator::make($request->all(), [
                'coupon_code' => 'required|string|unique:coupons,coupon_code',
                'coupon_type' => 'required|in:1,2',
                'discount_value' => 'required|string',
                'end_date' => 'required|date|after:start_date',
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $coupon = DB::table('coupons')->insert([
                'coupon_code' => strtoupper($request->coupon_code),
                'coupon_type' => $request->coupon_type,
                'discount_value' => $request->discount_value,
                'end_date' => $request->end_date,
                'status' => 1,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Coupon created successfully',
                'data' => $coupon
            ], 201);
        } catch (Exception $e) {
            Log::error('exception', $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create coupon',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Coupon $coupon)
    {
        try {
            return response()->json([
                'status' => 'success',
                'coupon' => $coupon
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch coupon. ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Coupon $coupon)
    {
        try {

            $validator = Validator::make($request->all(), [
                'coupon_code' => ['required', 'string', Rule::unique('coupons')->ignore($coupon->id)],
                'coupon_type' => 'required|in:1,2',
                'discount_value' => 'required|string',
                'end_date' => 'required|date|after:start_date',
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $coupon->update([
                'coupon_code' => strtoupper($request->coupon_code),
                'coupon_type' => $request->coupon_type,
                'discount_value' => $request->discount_value,
                'end_date' => $request->end_date,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Coupon updated successfully',
                'data' => $coupon
            ]);

        } catch (Exception $e) {
            Log::debug('Update', $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update coupon',
            ], 500);
        }
    }

    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Coupon deleted successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete coupon',
            ], 500);
        }
    }
}
