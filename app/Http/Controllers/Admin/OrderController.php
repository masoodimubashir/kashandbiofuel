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
                ->when($request->status, function ($query) use ($request) {
                    list($status, $value) = explode('-', $request->status);

                    return match ($status) {
                        'shipped' => $query->where('is_shipped', true)
                            ->where('is_confirmed', true),
                        'confirmed' => $query->where('is_confirmed', true)
                            ->where('is_shipped', false),
                        'pending' => $query->where('is_confirmed', false)
                            ->where('is_cancelled', false),
                        'cancelled' => $query->where('is_cancelled', true),
                        default => $query
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

                    ->rawColumns(['status'])
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
            'transaction',
            'refund'
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
            $order = Order::find($id);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found.',
                ]);
            }

            if ($validatedData['value'] == 1) {
                $fieldsToReset = ['is_cancelled', 'is_delivered', 'is_confirmed',];
                $fieldsToReset = array_filter($fieldsToReset, function ($field) use ($validatedData) {
                    return $field !== $validatedData['field'];
                });
                foreach ($fieldsToReset as $field) {
                    $order->{$field} = 0;
                }
            }


            if (($validatedData['field'] === 'is_delivered')) {

                $order->is_delivered = $validatedData['value'];

                $order->order_message = 'Delivered';

                $order->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Order marked as delivered successfully'
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
