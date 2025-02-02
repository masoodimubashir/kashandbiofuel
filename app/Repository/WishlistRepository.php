<?php

namespace App\Repository;

use App\Interface\ItemInterface;
use App\Models\Wishlist;

class WishlistRepository extends BaseRepository
{

    public function __construct(Wishlist $wishlist)
    {
        parent::__construct($wishlist);
    }


}
