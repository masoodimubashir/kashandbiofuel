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
                'description' => 'Wooden frame sofas and couches',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 1, // Furniture
                'name' => 'Coffee Tables',
                'description' => 'Wooden coffee and side tables',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 2, // Home Decor
                'name' => 'Wall Shelves',
                'description' => 'Decorative wooden wall shelving',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 3, // Kitchen & Dining
                'name' => 'Dining Tables',
                'description' => 'Wooden dining tables and sets',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 4, // Office Furniture
                'name' => 'Desks',
                'description' => 'Wooden office desks and workstations',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 5, // Outdoor & Garden
                'name' => 'Garden Benches',
                'description' => 'Wooden outdoor seating solutions',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 6, // Storage Solutions
                'name' => 'Cabinets',
                'description' => 'Wooden storage cabinets and wardrobes',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 7, // Kids Furniture
                'name' => 'Study Tables',
                'description' => "Children's wooden study tables and chairs",
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 8, // Bedroom Sets
                'name' => 'Bed Frames',
                'description' => 'Wooden bed frames and headboards',
                'status' => true,
                'show_on_navbar' => true,
            ],
            [
                'category_id' => 10, // Antique Collection
                'name' => 'Vintage Chairs',
                'description' => 'Classic wooden chair designs',
                'status' => true,
                'show_on_navbar' => true,
            ],
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::create([
                'category_id' => $subCategory['category_id'],
                'name' => $subCategory['name'],
                'slug' => Str::slug($subCategory['name']),
                'description' => $subCategory['description'],
                'status' => $subCategory['status'],
                'show_on_navbar' => $subCategory['show_on_navbar'],
            ]);
        }
    }
}
