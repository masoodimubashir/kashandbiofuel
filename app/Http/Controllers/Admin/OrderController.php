<?php

namespace App\Http\Controllers\Admin;

use App\Class\HelperClass;
use App\Events\OrderPlacedEvent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubCategory;
use App\Service\OrderService;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{


    use HelperClass;

    public function __construct(public OrderService $orderService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {


            $orders = Order::query()
                ->with(['user', 'address'])
                ->when($request->status, function ($q) use ($request) {
                    list($status, $value) = explode('-', $request->status);

                    $value = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

                    return match ($status) {
                        'cancelled' => $q->where('is_cancelled', $value),
                        'confirmed' => $q->where('is_confirmed', $value),
                        'delivered' => $q->where('is_delivered', $value),
                        default => $q,
                    };
                })
                ->when($request->price_range, function ($q) use ($request) {
                    list($min, $max) = explode('-', $request->price_range);
                    if ($max === 'above') {
                        return $q->where('total_amount', '>', $min);
                    }
                    return $q->whereBetween('total_amount', [$min, $max]);
                });


            try {

                return DataTables::eloquent($orders)
                    ->addColumn('status', function ($order) {

                        $badgeClass = match ($order->status) {
                            'Confirmed', 'Delivered' => 'bg-success-subtle text-success-emphasis border-success-subtle',
                            'Cancelled' => 'bg-danger-subtle text-danger-emphasis border-danger-subtle',
                            default => 'bg-warning-subtle text-warning-emphasis border-warning-subtle',
                        };

                        $statusDropdown = '<div class="badge ' . $badgeClass . ' rounded-pill">' . $order->status . '</div>';

                        $showButton = '<a href="' . route('order.show', $order->id) . '">
                             <i style="cursor:pointer;" class="fa-regular fa-eye fs-5 text-success me-3 showBtn" title="Show"></i>
                        </a>';

                        return '<div class="d-flex align-items-center justify-content-left gap-3">
                             ' . $statusDropdown . $showButton . '
                         </div>';
                    })
                    ->addColumn('user_name', function ($order) {
                        return $order->user ? $order->user->name : 'N/A';
                    })
                    ->addColumn('address', function ($order) {
                        return $order->address ? $order->address->address : 'N/A';
                    })
                    ->addColumn('action', function ($order) {
                        return '
                            <select class="form-select form-select-sm changeStatus" style="cursor:pointer" data-id="' . $order->id . '">
                                <option selected disabled>Choose Action</option>
                                <option value="is_confirmed" ' . ($order->is_confirmed ? 'selected' : '') . '>Confirmed</option>
                                <option value="is_delivered" ' . ($order->is_delivered ? 'selected' : '') . '>Delivered</option>
                                <option value="is_cancelled" ' . ($order->is_cancelled ? 'selected' : '') . '>Cancelled</option>
                            </select>
                        ';
                    })
                    ->rawColumns(['status', 'action'])
                    ->orderColumn('created_at', 'created_at $1')
                    ->make(true);
            } catch (Exception $e) {
                // Return error response if any exception occurs
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to fetch orders',
                ], 500);
            }
        }

        $products = Product::where('status', 1)
            ->orderBy('name')
            ->get();

        $categories = Category::where('status', 1)
            ->orderBy('name')
            ->get();

        $sub_categories = SubCategory::where('status', 1)
            ->orderBy('name')
            ->get();

        return view('layouts.dashboard.Order.orders', compact('products', 'categories', 'sub_categories'));
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

        $order = Order::with([
            'orderedItems' => function ($query) {
                $query->with('product', function ($query) {
                    $query->with('productAttributes');
                });
            },
            'address' => function ($query) {
                $query->with('user');
            },
            'transaction'
        ])->find($id);

        $order = $this->transformOrder($order);

        return view('layouts.dashboard.Order.view-order', compact('order'));
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

            $order = Order::query()
                ->with([
                    'user.address',
                    'orderedItems.product.productAttribute'
                ])
                ->find($id);
            //
            //            if (!$order) {
            //                return response()->json([
            //                    'success' => false,
            //                    'message' => 'Order not found.',
            //                ]);
            //            }
            //
            //            if ($validatedData['value'] == 1) {
            //                $fieldsToReset = ['is_cancelled', 'is_delivered', 'is_confirmed'];
            //
            //                $fieldsToReset = array_filter($fieldsToReset, function ($field) use ($validatedData) {
            //                    return $field !== $validatedData['field'];
            //                });
            //
            //                foreach ($fieldsToReset as $field) {
            //                    $order->{$field} = 0;
            //                }
            //            }
            //
            //            $order->{$validatedData['field']} = $validatedData['value'];
            //            $order->save();

            // if ($validatedData['field'] === 'is_confirmed' && $order->save()) {

            //     event(new OrderPlacedEvent($order));

            //     return response()->json([
            //         'status' => true,
            //         'message' => 'Order confirmed successfully'
            //     ]);
            // }

            if (($validatedData['field'] === 'is_cancelled') && $order->save()) {

                $this->orderService->cancelOrder($order);

                return response()->json([
                    'status' => true,
                    'message' => 'Order cancelled successfully',
                    'redirect_url' => route('order.index')
                ]);
            }


            return response()->json([
                'status' => true,
                'message' => 'Field updated successfully.',
            ]);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to update status. ',
                'error' => $e->getMessage(),
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
