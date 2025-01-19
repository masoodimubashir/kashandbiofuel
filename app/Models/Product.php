<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'sku',
        'search_tags',
        'slug',
        'price',
        'selling_price',
        'status',
        'crafted_date',
        'short_description',
        'additional_description',
        'description',
        'qty'
    ];

   

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function productAttributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
