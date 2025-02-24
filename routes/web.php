<?php

use App\Events\OrderPlacedEvent;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChangeFlagsController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\ExcelController;
use App\Http\Controllers\Admin\ExcelProductImportsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSeoController;
use App\Http\Controllers\Admin\ShipRocketController;
use App\Http\Controllers\Admin\StatusUpdateController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\DashboardContactUsController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CategoryShoppingController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductReviewController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\SubCategoryShoppingController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\User\ApplyCouponController;
use App\Http\Controllers\User\FrontendAddressController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserProfileController;
use App\Mail\OrderShipped;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// Checking Session User For Testing
Route::get('/s', function () {
    dd(request()->cookie('guest_id'));
});

Route::get('/', [HomeController::class, 'index'])->name('home');


// Route For Searching The Product
Route::get('/live-search', SearchController::class)->name('live.search');


// Routes For Contact
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact-us.store');

// Route For Category Shopping
Route::get('/shop-by-category', [CategoryShoppingController::class, 'index'])->name('category.index');

// Route For SubCategory Shopping
Route::get('/shop-by-subcategory/{slug}', [SubCategoryShoppingController::class, 'index'])->name('sub-category-shopping.index');

// Routes For Product
Route::get('/product/{slug}', [FrontendProductController::class, 'show'])->name('product.show');
Route::get('/check-product-quantity/{slug}', [FrontendProductController::class, 'checkProductQuantity'])->name('product.review.store');


// Routes For Logging In Via Gmail
Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback'])->name('auth.callback');

Route::resource('/frontend-address', FrontendAddressController::class);


Route::middleware('checkUserGuest')->group(function () {

    //Routes For Cart
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view-cart');
    Route::post('/cart/store', [CartController::class, 'addToCart'])->name('cart.add-to-cart');
    Route::patch('/cart/update-quantity/{id}', [CartController::class, 'updateQty'])->name('cart.update-qty');
    Route::delete('/cart/delete/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove-from-cart');
    Route::put('/return-to-wishlist/{id}', [CartController::class, 'returnToWishlist'])->name('return-to-wishlist');

    // Routes For Wishlist
    Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view-wishlist');
    Route::post('/wishlist/store', [WishlistController::class, 'addToWishlist'])->name('wishlist.add-to-wishlist');
    Route::delete('/wishlist/delete/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove-from-wishlist');
    Route::put('/return-to-cart/{id}', [WishlistController::class, 'returnToCart'])->name('return-to-cart');

    Route::put('apply-coupon', [ApplyCouponController::class, 'viewCart'])->name('apply-coupon');
});


Route::post('products/import', [ExcelController::class, 'import'])->name('products.import');
Route::get('products/export', [ExcelController::class, 'export'])->name('products.export');


// Authenticated Routes For User And Admin
Route::middleware(['auth', 'verified'])->group(function () {

    // Protected Routes For Admin Only
    Route::middleware('role:admin')->prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('/customers', CustomersController::class);

        Route::resource('/categories', CategoryController::class);

        Route::resource('/sub-categories', SubCategoryController::class);

        Route::resource('/products', ProductController::class);

        Route::resource('/coupons', CouponController::class);

        Route::resource('/users', UserController::class);

        Route::resource('/order', OrderController::class);

        Route::post('/order/push-to-shiprocket/{order}', ShipRocketController::class)->name('order.push-to-shiprocket');

        Route::get('/contact-us', [DashboardContactUsController::class, 'index'])->name('dashboard.contact-us.index');
        Route::get('banners', [BannerController::class, 'index']);
        Route::post('banners', [BannerController::class, 'store']);
        Route::post('banners/update/{id}', [BannerController::class, 'update']);

        Route::get('/products/{Product}/attributes', [ProductAttributeController::class, 'index']);
        Route::post('/products/{Product}/attributes', [ProductAttributeController::class, 'store']);
        Route::delete('/products/{Product}/attributes/{attribute}', [ProductAttributeController::class, 'destroy']);

        Route::put('update-status/{id}', [StatusUpdateController::class, 'updateStatus'])->name('status.update');
        Route::put('/update-show-on-navbar/{id}', [StatusUpdateController::class, 'updateShowOnNavabr'])->name('status.showOnNavbar');



        Route::put('Product/seo', [ProductSeoController::class, 'index'])->name('Product.seo');
        Route::put('Product/flags/{id}', [ChangeFlagsController::class, 'index'])->name('Product.flags');

        Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications');

        Route::post('/notifications/mark-as-read/{id}', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.markAsRead');
    });


    //  Protected Routes For User
    Route::middleware('role:user')->prefix('user')->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

        Route::post('/product/review/store', [ProductReviewController::class, 'store'])->name('product.review.store');

        Route::put('/update/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
        Route::put('/update/password', [UserProfileController::class, 'updatePassword'])->name('user.password.update');
        Route::post('/update/photo', [UserProfileController::class, 'updateImage'])->name('user.update.photo');

        Route::resource('/address', FrontendAddressController::class);

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::get('/order-placed/{transaction_id}', [CheckoutController::class, 'orderPlaced'])->name('checkout.order-placed');
        Route::post('/checkout/phonepe', [CheckoutController::class, 'checkout'])->name('checkout.phonepe.store');
        Route::post('/cash-on-delivery', [CheckoutController::class, 'cashOnDelivery'])->name('checkout.cash-on-delivery');

        Route::post('/phonepe/callback', [CheckoutController::class, 'callback'])->name('payment.callback');
        Route::get('/phonepe/redirect', [CheckoutController::class, 'redirect'])->name('payment.redirect');
    });
});


require __DIR__ . '/auth.php';
