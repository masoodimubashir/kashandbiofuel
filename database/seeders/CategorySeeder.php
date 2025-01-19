<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Furniture',
                'description' => 'High-quality wooden furniture for your home',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Home Decor',
                'description' => 'Wooden decorative items for your living space',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Kitchen & Dining',
                'description' => 'Wooden kitchenware and dining furniture',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Office Furniture',
                'description' => 'Professional wooden furniture for workspace',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Outdoor & Garden',
                'description' => 'Wooden furniture for outdoor spaces',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Storage Solutions',
                'description' => 'Wooden storage and organization products',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Kids Furniture',
                'description' => 'Wooden furniture designed for children',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Bedroom Sets',
                'description' => 'Complete wooden bedroom furniture sets',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Custom Pieces',
                'description' => 'Custom-made wooden furniture and items',
                'status' => true,
                'show_on_navbar' => false,
            ],
            [
                'name' => 'Antique Collection',
                'description' => 'Classic and antique wooden furniture',
                'status' => true,
                'show_on_navbar' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'status' => $category['status'],
                'show_on_navbar' => $category['show_on_navbar'],
            ]);
        }
    }
}
