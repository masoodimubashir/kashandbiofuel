<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique();
            $table->tinyInteger('coupon_type')->default(0)->comment('1 = Percentage, 2 = Fixed Amount');
            $table->string('discount_value');
            $table->string('start_date');
            $table->string('end_date');
            $table->unsignedInteger('usage_limit');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
