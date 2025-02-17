<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = ['image_path', 'product_id', 'hex_code'];

    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn($value) => is_null($value) ? 'default_images/default_image.webp' : $value,
        );
    }
}
