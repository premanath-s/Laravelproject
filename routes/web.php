<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home route
Route::get('/', function () {
    return view('welcome');
});


// Dashboard (login required)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Protected routes (login required)
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Profile routes
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*
    |--------------------------------------------------------------------------
    | Product routes (User)
    |--------------------------------------------------------------------------
    */
    Route::get('/products', [ProductController::class,'index'])->name('products.index');

    Route::get('/products/create', [ProductController::class,'create'])->name('products.create');

    Route::post('/products/store', [ProductController::class,'store'])->name('products.store');


    /*
    |--------------------------------------------------------------------------
    | Cart routes
    |--------------------------------------------------------------------------
    */
    Route::get('/cart', [CartController::class,'index'])->name('cart.index');

    Route::post('/cart/add/{id}', [CartController::class,'add'])->name('cart.add');

    Route::patch('/cart/{id}', [CartController::class,'update'])->name('cart.update');

    Route::delete('/cart/{id}', [CartController::class,'remove'])->name('cart.remove');


    /*
    |--------------------------------------------------------------------------
    | Order routes
    |--------------------------------------------------------------------------
    */
    Route::get('/checkout', [OrderController::class,'checkout'])->name('checkout');

    Route::get('/orders', [OrderController::class,'history'])->name('orders.history');


    /*
    |--------------------------------------------------------------------------
    | Admin routes
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/products', [ProductController::class,'index'])->name('admin.products');

    Route::get('/admin/products/create', [ProductController::class,'create'])->name('admin.products.create');

    Route::post('/admin/products/store', [ProductController::class,'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [ProductController::class,'edit'])->name('admin.products.edit');
    Route::patch('/admin/products/{id}', [ProductController::class,'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [ProductController::class,'destroy'])->name('admin.products.destroy');

    // Admin activity
    Route::get('/admin/activity', [AdminController::class,'activity'])->name('admin.activity');
    Route::get('/admin/users/{id}/orders', [AdminController::class,'userOrders'])->name('admin.users.orders');

});


// Authentication routes
require __DIR__.'/auth.php';
