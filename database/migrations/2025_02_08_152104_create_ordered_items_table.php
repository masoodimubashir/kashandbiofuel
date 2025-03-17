<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ordered_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_attribute_id')->constrained('product_attributes');
            $table->string('quantity');
            $table->string('price');
            $table->dateTime('date_of_purchase');
            $table->string('custom_order_id');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('ordered_items');
    }
};
