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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');;
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('restrict');;
            $table->string('name');
            $table->string('sku')->unique();
            $table->json('search_tags');
            $table->string('slug');
            $table->decimal('price', 10, 2);
            $table->string('qty');
            $table->decimal('selling_price', 10, 2);
            $table->boolean('status');
            $table->date('crafted_date');
            $table->text('short_description');
            $table->text('additional_description');
            $table->text('description');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
