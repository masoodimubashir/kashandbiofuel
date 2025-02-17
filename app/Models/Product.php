<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Scout\Searchable;

class Product extends Model
{


    /**
     * Bit flags for Product statuses
     * Each value must be a power of 2 for bitwise operations to work correctly
     */
    const FEATURED = 1;     // 0001 in binary

    const DISCOUNTED = 2;   // 0010 in binary

    const NEW_ARRIVAL = 4;   // 1000 in binary


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
        'qty',
        'meta_description',
        'meta_keyword',
        'meta_title',
        'featured',
        'discounted',
        'new_arrival',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */


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


    /**
     * Get the productAttribute associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productAttribute(): HasOne
    {
        return $this->hasOne(ProductAttribute::class);
    }


    public function reviews(): HasMany
    {
        return $this->hasMany(Reviews::class);
    }

    /**
     * Get the review associated with the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function review(): HasOne
    {
        return $this->hasOne(Reviews::class, 'product_id', 'id');
    }
}
