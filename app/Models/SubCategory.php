<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{

    protected $fillable = ['name', 'slug', 'status', 'description', 'category_id', 'show_on_navbar'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
}
