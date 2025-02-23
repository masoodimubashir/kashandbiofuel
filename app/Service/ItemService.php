<?php

namespace App\Service;

use App\Class\HelperClass;
use App\Repository\CartRepository;
use App\Repository\UserRepository;
use App\Repository\WishlistRepository;
use Illuminate\Http\Request;
use InvalidArgumentException;

class ItemService
{

    use HelperClass;

    private CartRepository $cartRepository;

    private WishlistRepository $wishlistRepository;

    private UserRepository $userRepository;

    public function __construct(CartRepository $cartRepository, WishlistRepository $wishlistRepository, UserRepository $userRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->wishlistRepository = $wishlistRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Dynamically resolve the proper repository based on type.
     *
     * @param string $type
     * @return mixed
     * @throws InvalidArgumentException
     */
    private function resolveRepository(string $type)
    {
        return match ($type) {
            'cart' => $this->cartRepository,
            'wishlist' => $this->wishlistRepository,
            default => throw new InvalidArgumentException('Invalid repository type specified.'),
        };
    }

    /**
     * Get all items for a user or guest based on type (cart or wishlist).
     *
     * @param Request $request
     * @param string $type
     * @return array
     */
    public function getItems(Request $request, string $type): array
    {

        $values = $request->only(['user_id', 'guest_id', 'coupon_code']);

        $repository = $this->resolveRepository($type);

        return $this->calculateItemTotalsAndGrandTotal($values, $repository);
    }

    /**
     * Add or update an item in cart or wishlist.
     *
     * @param array $data
     * @param string $type
     * @return void
     */
    public function addOrUpdateItem(array $request, string $type): void
    {

        $repository = $this->resolveRepository($type);

        $repository->updateOrCreateItem($request);

    }

    /**
     * Update an existing item's quantity in cart or wishlist.
     *
     * @param string $id
     * @param int $qty
     * @param string $type
     */
    public function updateItemQty(string $id, int $qty, string $type)
    {

        $repository = $this->resolveRepository($type);

        return $repository->updateItemQty($id, $qty);
    }

    /**
     * Remove an item from the cart or wishlist.
     *
     * @param int|null $id
     * @param string $type
     * @return mixed
     */
    public function removeItem(?int $id, string $type)
    {
        $repository = $this->resolveRepository($type);
        return $repository->deleteItem($id);
    }

    /**
     * Find a specific item in cart or wishlist.
     *
     * @param int $id
     * @param string $type
     * @return mixed
     */
    public function findItem(int $id, string $type): mixed
    {

        $repository = $this->resolveRepository($type);

        $item = $repository->findItem($id);

        if (!$item) {
            throw new \Exception('Item not found');
        }

        return $item;
    }


    public function returnToCart(object $request, int $id, string $type)
    {


        $repository = $this->resolveRepository($type);

        $item = $repository->deleteItem($id);

        if (!$item) {
            throw new \Exception('Item Not Deleted...');
        }

        $data = $this->processObjectToArray($request);

        $type = $type === 'cart' ? 'wishlist' : 'cart';

        $repository = $this->resolveRepository($type);

        $repository->updateOrCreateItem($data);

    }

    public function mergeItems(?string $guest_id, ?int $user_id): void
    {

        $repositories = ['cart', 'wishlist'];

        foreach ($repositories as $type) {
            $repository = $this->resolveRepository($type);

            $repository->mergeItems($guest_id, $user_id);
        }


    }


}
