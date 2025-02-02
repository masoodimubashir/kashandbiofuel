<?php

namespace App\Providers;

use App\Interface\ItemInterface;
use App\Repository\BaseRepository;
use App\Repository\CartRepository;
use App\Repository\WishlistRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(ItemInterface::class, BaseRepository::class);

//        // Dynamically resolve Cart or Wishlist based on the route
//        $this->app->bind(ItemInterface::class, function ($app) {
//            if (request()->is('cart/*')) {
//                return $app->make(CartRepository::class);
//            }
//
//            if (request()->is('wishlist/*')) {
//                return $app->make(WishlistRepository::class);
//            }
//
//            throw new \Exception('Invalid repository context');
//        });


    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
