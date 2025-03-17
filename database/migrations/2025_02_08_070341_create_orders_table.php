<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('address_id')->constrained('addresses');
            $table->string('custom_order_id')->unique();
            $table->string('transaction_id')->unique();
            $table->unsignedBigInteger('total_amount');
            $table->date('date_of_purchase');
            $table->boolean('is_cancelled')->default(0);
            $table->boolean('is_delivered')->default(0);
            $table->boolean('is_confirmed')->default(0);
            $table->boolean('is_shipped')->default(0);
            $table->boolean('is_pending')->default(0);
            $table->string('order_message');
            $table->string('tracking_id')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
