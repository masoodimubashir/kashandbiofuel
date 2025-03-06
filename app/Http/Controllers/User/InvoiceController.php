<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function downloadInvoice($id)
    {

        $order = Order::findOrFail($id);

        $order->load(['orderedItems' => function ($item) {
            $item->with(['product', 'productAttribute']);
        }, 'user', 'address', 'transaction']);

        return view('frontend.Invoice.invoice', compact('order'));
    }
}
