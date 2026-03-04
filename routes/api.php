<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JwtAuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\OrderController;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;

/*
|--------------------------------------------------------------------------
| JWT Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [JwtAuthController::class, 'register']);
Route::post('/login', [JwtAuthController::class, 'login']);

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

    // Cart
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::delete('/cart/{id}', [CartController::class, 'remove']);

    // Products
    Route::apiResource('products', ProductController::class);

    // Check Token Payload
    Route::get('/check-token', function () {
        $payload = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->getPayload();
        return response()->json($payload);
    });

});