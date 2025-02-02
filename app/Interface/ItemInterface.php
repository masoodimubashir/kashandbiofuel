<?php

namespace App\Interface;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface ItemInterface
{

    /**
     * Get all items for a user (logged-in) or guest (anonymous).
     */
    public function getItems($values);

    /**
     * Create or update an item (cart or wishlist).
     */
    public function updateOrCreateItem(array $data);


    /**
     * Find an item by Id(cart or wishlist).
     */
    public function findItem(int $id);


    /**
     * Delete an item by its ID.
     */
    public function deleteItem(int $id);


    /**
     * Update the quantity of an item by its ID.
     *
     * @param int $qty The new quantity of the item.
     * @param string $id The new quantity of the item.
     *
     * @return void
     */


    // In App\Interface\ItemInterface.php

    public function updateItemQty(int $id, int $qty);


}
