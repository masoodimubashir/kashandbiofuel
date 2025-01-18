<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{

    protected $fillable = ['product_id','color_name', 'hex_code'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define the relationship with ProductImage (polymorphic)
    public function images()
    {
        return $this->morphMany(ProductImage::class, 'imageable');
    }
}
