<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductsImport implements
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {


        $category = Category::firstOrCreate(
            [
                'name' => $row['category']
            ],
            [
                'slug' => Str::slug($row['category']),
                'status' => 1,
                'show_on_navbar' => 0,
            ]
        );

        $subCategory = SubCategory::where('name', $row['sub_category'])->first();

        dd($subCategory);

        // $subCategory = SubCategory::firstOrCreate(
        //     [
        //         'name' => $row['sub_category'], 
        //         'category_id' => $category->id 
        //     ],
        //     [
        //         'slug' => Str::slug($row['sub_category']), 
        //         'status' => 1,
        //         'show_on_navbar' => 0,
        //     ]
        // );

        return new Product([
            'category_id' => $category->id,
            'sub_category_id' => $subCategory->id,
            'name' => $row['name'],
            'sku' => $row['sku'],
            'slug' => Str::slug($row['name']),
            'price' => $row['price'],
            'qty' => 1,
            'selling_price' => $row['selling_price'],
            'status' => 1,
            'crafted_date' => Carbon::parse($row['crafted_date'])->format('Y-m-d'),
            'short_description' => $row['short_description'],
            'additional_description' => $row['additional_description'],
            'description' => $row['description']
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
