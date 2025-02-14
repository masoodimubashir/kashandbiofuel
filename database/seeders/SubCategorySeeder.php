<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategories = [
            [
                'category_id' => 1, // Furniture
                'name' => 'Sofas & Couches',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 1, // Furniture
                'name' => 'Coffee Tables',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 2, // Home Decor
                'name' => 'Wall Shelves',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 3, // Kitchen & Dining
                'name' => 'Dining Tables',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 4, // Office Furniture
                'name' => 'Desks',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 5, // Outdoor & Garden
                'name' => 'Garden Benches',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 6, // Storage Solutions
                'name' => 'Cabinets',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 7, // Kids Furniture
                'name' => 'Study Tables',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 8, // Bedroom Sets
                'name' => 'Bed Frames',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 10, // Antique Collection
                'name' => 'Vintage Chairs',
                'status' => true,
                'show_on_navbar' => true,
            ],
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::create([
                'category_id' => $subCategory['category_id'],
                'name' => $subCategory['name'],
                'slug' => Str::slug($subCategory['name']),
                'status' => $subCategory['status'],
                'show_on_navbar' => $subCategory['show_on_navbar'],
            ]);
        }
    }
}
