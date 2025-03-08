<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;


class InvoiceController extends Controller
{

    // public function downloadInvoice($id)
    // {

        // $order = Order::findOrFail($id);

        // $order->load(['orderedItems' => function ($item) {
        //     $item->with(['product', 'productAttribute']);
        // }, 'user', 'address', 'transaction']);
    // }


    public function downloadInvoice($id)
    {

        $order = Order::findOrFail($id);

        $order->load(['orderedItems' => function ($item) {
            $item->with(['product', 'productAttribute']);
        }, 'user', 'address', 'transaction']);

        $pdf = PDF::loadView('frontend.Invoice.pdf', [
            'order' => $order
        ]);

      

        return $pdf->download('invoice-' . $order->custom_order_id . '.pdf');
    }
}
