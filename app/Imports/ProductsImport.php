<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {



        $tags = json_encode( $row['searchtags']);


        $category = Category::firstOrCreate(
            ['name' => $row['category']],
            [
                'slug' => Str::slug($row['category']),
                'status' => 1,
                'show_on_navbar' => 0,
                'description' => '..'
            ]
        );

        $subCategory = SubCategory::firstOrCreate(
            [
                'name' => $row['subcategory'],
                'category_id' => $category->id
            ],
            [
                'slug' => Str::slug($row['subcategory']),
                'status' => 1,
                'show_on_navbar' => 0,
                'description' => '.'
            ]
        );

        return new Product([
            'category_id' => $category->id,  // Use the category id instead of row[0]
            'sub_category_id' => $subCategory->id,  // Use the subcategory id instead of row[1]
            'name' => $row['name'],
            'sku' => $row['sku'],
            'search_tags' =>  $tags,
            'slug' => Str::slug($row['name']),
            'price' => $row['price'],
            'qty' => $row['quantity'],
            'selling_price' => $row['sellingprice'],
            'status' => 1,
            'crafted_date' => Carbon::parse($row['crafteddate'])->format('Y-m-d'),
            'short_description' => $row['shortdescription'],
            'additional_description' => $row['additionaldescription'],
            'description' => $row['description']
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
