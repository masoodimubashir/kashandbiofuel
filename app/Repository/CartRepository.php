<?php

namespace App\Repository;

use App\Interface\ItemInterface;
use App\Models\Cart;
use Illuminate\Support\Collection;

class CartRepository extends BaseRepository
{

    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

   
}
