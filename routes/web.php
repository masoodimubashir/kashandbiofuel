<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ExcelProductImportsController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StatusUpdateController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;






Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact-us.store');




// Authenticated Routes For User And Admin

Route::middleware(['auth', 'verified'])->group(function () {

    // Protected Routes For Admin Only
    Route::middleware('role:admin')->prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('/customers', CustomersController::class);

        Route::resource('/categories', CategoryController::class);

        Route::resource('/sub-categories', SubCategoryController::class);

        Route::resource('/products', ProductController::class);

        Route::resource('/coupons', CouponController::class);

        Route::get('banners', [BannerController::class, 'index']);
        Route::post('banners', [BannerController::class, 'store']);
        Route::post('banners/update/{id}', [BannerController::class, 'update']);


        Route::get('/products/{product}/attributes', [ProductAttributeController::class, 'index']);
        Route::post('/products/{product}/attributes', [ProductAttributeController::class, 'store']);
        Route::delete('/products/{product}/attributes/{attribute}',[ProductAttributeController::class, 'destroy']);



        Route::put('update-status/{id}', [StatusUpdateController::class, 'updateStatus'])->name('status.update');
        Route::put('/update-show-on-navbar/{id}', [StatusUpdateController::class, 'updateShowOnNavabr'])->name('status.showOnNavbar');

        
        Route::post('products/import', ExcelProductImportsController::class)->name('products.import');

    });



    //  Protected Routes For User
    Route::middleware('role:user')->prefix('user')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    });

    // These Routes Are Accessable for both Admin And User

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});



require __DIR__ . '/auth.php';
