<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {



        $category = Category::firstOrCreate(
            ['name' => $row[0]],
            [
                'slug' => Str::slug($row[0]),
                'status' => 1,
                'show_on_navbar' => 1,
                'description' => '..'
            ]
        );

        $subCategory = SubCategory::firstOrCreate(
            ['name' => $row[1], 'category_id' => $category->id],
            [
                'slug' => Str::slug($row[1]),
                'status' => 1,
                'show_on_navbar' => 1,
                'description' => '.'
            ]
        );

        return new Product([
            'category_id' => $category->id,  // Use the category id instead of row[0]
            'sub_category_id' => $subCategory->id,  // Use the subcategory id instead of row[1]
            'name' => $row[2],
            'sku' => $row[3],
            'search_tags' => json_encode($row[4]),
            'slug' => Str::slug($row[5]),
            'price' => $row[6],
            'qty' => $row[7],
            'selling_price' => $row[8],
            'status' => $row[9],
            'crafted_date' => Carbon::createFromFormat('d/m/Y', $row[10])->format('Y-m-d'),
            'short_description' => $row[11],
            'additional_description' => $row[12],
            'description' => $row[13]
        ]);
    }
}
