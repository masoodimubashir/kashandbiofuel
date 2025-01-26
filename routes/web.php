<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChangeFlagsController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\ExcelProductImportsController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSeoController;
use App\Http\Controllers\Admin\StatusUpdateController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryShoppingController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductReviewController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes For Contact
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact-us.store');


// Route For Category Shopping
Route::get('/shop-by-category', [CategoryShoppingController::class, 'index'])->name('category.index');


// Routes For Product
Route::get('/Product/{slug}', [FrontendProductController::class, 'show'])->name('Product.show');


//Routes For Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');


// Routes For Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/store', [WishlistController::class, 'store'])->name('wishlist.store');


//Route For Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Routes For Logging In Via Gmail
Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [SocialiteController::class, 'callback'])->name('auth.callback');


// Authenticated Routes For User And Admin

Route::middleware(['auth', 'verified'])->group(function () {

    // Protected Routes For Admin Only
    Route::middleware('role:admin')->prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');


        Route::resource('/customers', CustomersController::class);

        Route::resource('/categories', CategoryController::class);

        Route::resource('/sub-categories', SubCategoryController::class);

        Route::resource('/products', ProductController::class);

        Route::resource('/coupons', CouponController::class);

        Route::get('banners', [BannerController::class, 'index']);
        Route::post('banners', [BannerController::class, 'store']);
        Route::post('banners/update/{id}', [BannerController::class, 'update']);

        Route::get('/products/{Product}/attributes', [ProductAttributeController::class, 'index']);
        Route::post('/products/{Product}/attributes', [ProductAttributeController::class, 'store']);
        Route::delete('/products/{Product}/attributes/{attribute}', [ProductAttributeController::class, 'destroy']);

        Route::put('update-status/{id}', [StatusUpdateController::class, 'updateStatus'])->name('status.update');
        Route::put('/update-show-on-navbar/{id}', [StatusUpdateController::class, 'updateShowOnNavabr'])->name('status.showOnNavbar');

        Route::post('products/import', ExcelProductImportsController::class)->name('products.import');

        Route::put('Product/seo', [ProductSeoController::class, 'index'])->name('Product.seo');
        Route::put('Product/flags/{id}', [ChangeFlagsController::class, 'index'])->name('Product.flags');

    });


    //  Protected Routes For User
    Route::middleware('role:user')->prefix('user')->group(function () {

//        Route For User Dashboard
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

        //  Route For Reviewing The Product
        Route::post('/Product/review/store', [ProductReviewController::class, 'store'])->name('Product.review.store');


    });


    // Routes For Both Users And Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


require __DIR__ . '/auth.php';
