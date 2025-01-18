<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = ['image_path', 'product_id', 'hex_code'];
    
}
