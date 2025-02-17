<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductAttributeFactory extends Factory
{
    protected $model = ProductAttribute::class;

    public function definition(): array
    {


        return [
            'product_id' => Product::all()->random(),
            'hex_code' => $this->faker->hexColor,  // Random valid hex color
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];


    }
}
