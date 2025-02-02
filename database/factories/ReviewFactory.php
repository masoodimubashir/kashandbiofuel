<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReviewFactory extends Factory
{
    protected $model = Reviews::class;

    public function definition(): array
    {
        return [
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'comment' => $this->faker->text(20), // Generate a comment with up to 20 characters
            'rating' => $this->faker->numberBetween(1, 5), // Random rating between 1 and 5
            'product_id' => Product::all()->random()->id, // Fetch a random product ID
            'user_id' => User::all()->random()->id, // Fetch a random user ID
        ];
    }
}
