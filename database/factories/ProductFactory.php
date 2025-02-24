<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {

        $tags = implode(',', $this->faker->words(5));
        $jsonTags = json_encode(explode(',', $tags));

        $price = $this->faker->randomFloat(2, 0, 9999);

        $sellingPrice = $price - 1000;

        return [
            'name' => $this->faker->name(),
            'sku' => $this->faker->unique()->text(5),
            // 'search_tags' => $jsonTags,
            'slug' => $this->faker->slug(),
            'price' => $price,
            'qty' => $this->faker->numberBetween(1, 15),
            'selling_price' => $sellingPrice,
            'status' => $this->faker->boolean(),
            'crafted_date' => Carbon::now(),
            'short_description' => $this->faker->text(),
            'additional_description' => $this->faker->text(),
            'description' => $this->faker->text(),
            'meta_title' => $this->faker->word(),
            'meta_keyword' => $this->faker->word(),
            'meta_description' => $this->faker->text(),
            'featured' => $this->faker->boolean(),
            'discounted' => $this->faker->boolean(),
            'new_arrival' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'category_id' => rand(1, 10),
            'sub_category_id' => rand(1, 10),


        ];
    }
}
