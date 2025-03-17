<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Log;
use Yajra\DataTables\Facades\DataTables;


class AdminRefundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {
            $refunds = Refund::get();
            
            if ($request->ajax()) {
                $refunds = Refund::query();
                
                return DataTables::eloquent($refunds)
                    ->addColumn('refund_id', function ($refund) {
                        return '
                            <div class="d-flex align-items-center gap-2">
                                <h6 class="mb-0">' . $refund->refund_id . '</h6>
                            </div>
                        ';
                    })
                    ->addColumn('status', function ($refund) {
                        $badgeClass = $refund->status === 'completed' 
                            ? 'bg-success-subtle text-success-emphasis border-success-subtle' 
                            : 'bg-warning-subtle text-warning-emphasis border-warning-subtle';
                        
                        $statusText = $refund->status;
                        
                        return '<div class="badge ' . $badgeClass . ' rounded-pill">' . $statusText . '</div>';
                    })
                    ->editColumn('amount', function ($refund) {
                        return Number::currency($refund->amount, 'INR');
                    })
                    ->addColumn('phonepe_refund_id', function ($refund) {
                        return $refund->phonepe_refund_id ?? '-';
                    })
                    ->rawColumns(['refund_id', 'status'])
                    ->make(true);
            }
            
            return view('layouts.dashboard.Refund.refunds', compact('refunds'));
            
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch refunds',
            ], 500);
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
