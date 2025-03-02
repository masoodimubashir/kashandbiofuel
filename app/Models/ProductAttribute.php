<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = ['images', 'product_id', 'hex_code', 'qty'];


    public function getImageAttribute()
    {
        $images = json_decode($this->images);
        return $images[0] ?? null;
    }
}
