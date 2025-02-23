<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductAttribute;
use Database\Factories\ProductAttributeFactory;
use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    public function run(): void
    {
        ProductAttributeFactory::times(2)->create();

    }
}
