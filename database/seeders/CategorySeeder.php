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
              
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Home Decor',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Kitchen & Dining',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Office Furniture',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Outdoor & Garden',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Storage Solutions',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Kids Furniture',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Bedroom Sets',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'name' => 'Custom Pieces',
                'status' => true,
                'show_on_navbar' => false,
            ],
            [
                'name' => 'Antique Collection',
                'status' => true,
                'show_on_navbar' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'status' => $category['status'],
                'show_on_navbar' => $category['show_on_navbar'],
            ]);
        }
    }
}
