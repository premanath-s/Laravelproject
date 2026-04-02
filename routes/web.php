<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard (login required)
Route::get('/dashboard', function () {
    try {
        $orderCount = \App\Models\Order::where('user_id', auth()->id())->limit(1000)->count();
        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->limit(1000)->count();
        $products = \App\Models\Product::latest()->take(6)->get();
    } catch (\Exception $e) {
        $orderCount = 0;
        $cartCount = 0;
        $products = [];
    }

    return view('dashboard', compact('orderCount','cartCount', 'products'));

})->middleware(['auth'])->name('dashboard');

// Protected routes (login required)
Route::middleware('auth')->group(function () {

    // Payment routes
    Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{order}/pay', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::post('/payment/verify', [PaymentController::class, 'verify'])->name('payment.verify');

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
    Route::get('/products/{id}', [ProductController::class,'show'])->name('products.detail_view');
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
    // Checkout page (show form)
    Route::get('/checkout', [OrderController::class,'checkout'])->name('checkout');

    // Store order (save after checkout)
    Route::post('/orders/store', [OrderController::class,'store'])->name('orders.store');

    // Order history
    Route::get('/orders', [OrderController::class,'history'])->name('orders.history');

    // Ship order (for admin or fulfillment)
    Route::post('/orders/{order}/ship', [OrderController::class,'shipOrder'])->name('orders.ship');

    /*
    |--------------------------------------------------------------------------
    | Admin routes (Replaced by Filament)
    |--------------------------------------------------------------------------
    */
    // Filament handles routes at /admin
    
    // GET logout route
    Route::get('/logout', function () {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    });

});

// Authentication routes
require __DIR__.'/auth.php';