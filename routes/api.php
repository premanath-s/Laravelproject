<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JwtAuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\PaymentController;

/*
|--------------------------------------------------------------------------
| JWT Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [JwtAuthController::class, 'register']);
Route::post('/login', [JwtAuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

/*
|--------------------------------------------------------------------------
| JWT Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->group(function () {

    Route::post('/logout', [JwtAuthController::class, 'logout']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::post('/profile/update', [ProfileController::class, 'updateProfile']);
    Route::delete('/profile/delete', [ProfileController::class, 'deleteAccount']);

    // Orders
    Route::post('/order/place', [OrderController::class, 'placeOrder']);
    Route::get('/orders', [OrderController::class, 'myOrders']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);

    // Cart
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::delete('/cart/{id}', [CartController::class, 'remove']);

    // Products (protected create/update/delete)
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Razorpay payment
    Route::post('/payment/{order}/pay', [PaymentController::class, 'pay']);
    Route::post('/payment/verify', [PaymentController::class, 'verify']);

    // Check Token Payload
    Route::get('/check-token', function () {
        $payload = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->getPayload();
        return response()->json($payload);
    });

});