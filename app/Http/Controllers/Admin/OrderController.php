<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                // Query for fetching orders
                $orders = Order::query();

                return DataTables::eloquent($orders)
                    ->with(['user', 'address']) // Load relationships
                    ->addColumn('status', function ($order) {
                        // Generate a select dropdown with options for statuses
                        $statusDropdown = '
                                <select
                                    class="form-control changeStatus"
                                    data-id="' . $order->id . '">
                                    <option value="is_cancelled" ' . ($order->is_cancelled ? 'selected' : '') . '>Cancelled</option>
                                    <option value="is_delivered" ' . ($order->is_delivered ? 'selected' : '') . '>Delivered</option>
                                    <option value="is_confirmed" ' . ($order->is_confirmed ? 'selected' : '') . '>Confirmed</option>
                                </select>
                            ';

                        // Return the dropdown in the column
                        return '
                                <div class="d-flex align-items-center justify-content-center">
                                    ' . $statusDropdown . '
                                </div>
                            ';
                    })
                    ->addColumn('user_name', function ($order) {
                        // Return user name associated with the order
                        return $order->user ? $order->user->name : 'N/A';
                    })
                    ->addColumn('address', function ($order) {
                        // Return address associated with the order
                        return $order->address ? $order->address->address : 'N/A';
                    })
                    ->addColumn('date', function ($order) {
                        // Format the purchase date
                        return $order->created_at->format('Y-m-d');
                    })
                    ->rawColumns(['status'])
                    ->make(true);


            } catch (Exception $e) {
                // Return error response if any exception occurs
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch orders',
                ], 500);
            }
        }

        return view('layouts.dashboard.Order.orders');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'field' => 'required|string|in:is_cancelled,is_delivered,is_confirmed',
            'value' => 'required|boolean',
        ]);

        try {

            $order = Order::find($id);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found.',
                ]);
            }

            if ($validatedData['value'] == 1) {
                $fieldsToReset = ['is_cancelled', 'is_delivered', 'is_confirmed'];

                $fieldsToReset = array_filter($fieldsToReset, function ($field) use ($validatedData) {
                    return $field !== $validatedData['field'];
                });

                foreach ($fieldsToReset as $field) {
                    $order->{$field} = 0;
                }
            }

            $order->{$validatedData['field']} = $validatedData['value'];
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Field updated successfully.',
            ]);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to update status. ',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
