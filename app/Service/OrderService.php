<?php

namespace App\Service;

use App\Models\OrderedItem;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}


    public function cancelOrder($order)
    {
        DB::beginTransaction();


        try {

            $totalQty = 0;

            foreach ($order->orderedItems as $item) {

                ProductAttribute::where('id', $item->product_attribute_id)
                    ->increment('qty', $item->quantity);


                $totalQty += $item->quantity;

                $item->delete();
            }


            if ($totalQty > 0) {
                Product::where('id', $item->product_id)
                    ->update([
                        'qty' => $totalQty
                    ]);
            }

            $order->delete();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e; // Re-throw the exception or return false
        }
    }
}
