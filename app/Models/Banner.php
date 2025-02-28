<?php

namespace App\Models;

use App\Enum\BannerPosition;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{


    protected $fillable = ['image_path', 'position', 'link'];

    protected $casts = [
        'position' => BannerPosition::class
    ];


}
