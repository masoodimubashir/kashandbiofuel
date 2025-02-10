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
            $table->enum('payment_method', ['cod', 'online']);
            $table->date('date_of_purchase');
            $table->boolean('is_cancelled')->nullable();
            $table->boolean('is_delivered')->nullable();
            $table->boolean('is_confirmed')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
