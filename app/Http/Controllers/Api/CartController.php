<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $user = auth('api')->user();

        $cartItems = Cart::where('user_id', $user->id)
            ->with('product')
            ->get();

        return response()->json($cartItems, 200);
    }

    public function add(Request $request)
    {
        $user = auth('api')->user();

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'message' => 'Added to cart',
            'cart' => $cart
        ], 201);
    }

    public function remove($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', auth('api')->id())
            ->first();

        if (!$cart) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $cart->delete();

        return response()->json(['message' => 'Removed from cart'], 200);
    }
}