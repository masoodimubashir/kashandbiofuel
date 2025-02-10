<?php

namespace App\Repository;

use App\Interface\ItemInterface;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;


class BaseRepository implements ItemInterface
{


    /**
     * Constructor to bind model to repository.
     */
    public function __construct(private Model $model)
    {
    }

    public function getItems($values)
    {


        return $this->model->query()
            ->with(['product' => fn($query) => $query->with('productAttribute')])
            ->where(function ($query) use ($values) {
                if (isset($values['guest_id'])) {
                    $query->where('guest_id', $values['guest_id']);
                }
            })
            ->orWhere(function ($query) use ($values) {
                if (isset($values['user_id'])) {
                    $query->where('user_id', $values['user_id']);
                }
            })
            ->latest()
            ->get();

    }

    /**
     * Update or create an item.
     */
    public function updateOrCreateItem(array $data)
    {

        return $this->model->updateOrCreate(
            [
                'user_id' => $data['user_id'],
                'guest_id' => $data['guest_id'],
                'product_id' => $data['product_id'],
                'product_attribute_id' => $data['product_attribute_id'],
            ],
            [
                'qty' => $data['qty'],
            ]
        );

    }

    /**
     * Find  an item by id.
     */
    public function findItem(int $id)
    {

        return $this->model->find($id);

    }

    /**
     * Delete an item by ID.
     */
    public function deleteItem(?int $id)
    {
        return $this->model->find($id)->delete();
    }


    /**
     * Update the quantity of a specific item by its ID.
     *
     * @param int $qty The new quantity for the item.
     *
     */
    // In App\Repository\BaseRepository.php

    public function updateItemQty(int $id, int $qty)
    {

        $item = $this->findItem($id);

        if (!$item) {

            return $item;

        }

        return $item->update(['qty' => $qty]);

    }


    public function mergeItems(?string $guest_id, ?int $user_id): void
    {


        $this->model->query()
            ->where('guest_id', $guest_id)
            ->update([
                'user_id' => $user_id,
                'guest_id' => null
            ]);
    }


}
