<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{


    protected $fillable = ['name', 'slug', 'status', 'show_on_navbar', 'image_path'];

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class);
    }
}
