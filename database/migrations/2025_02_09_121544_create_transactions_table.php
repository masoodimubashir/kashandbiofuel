<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('amount');
            $table->boolean('status');
            $table->string('transaction_id');
            $table->string('phonepe_transaction_id')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();

            
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
