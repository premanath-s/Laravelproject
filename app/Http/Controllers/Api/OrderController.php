<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class OrderController extends Controller
{
    // Place Order with shipping address
    public function placeOrder(Request $request)
    {
        $user = $request->user();

        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Cart is empty'
            ], 400);
        }

        // Validate shipping address
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        // Calculate total
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // Clear cart
        Cart::where('user_id', $user->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Order placed successfully',
            'order_id' => $order->id
        ], 200);
    }

    // My Orders with shipping address
    public function myOrders(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->with('items.product')
            ->get()
            ->map(function($order) {
                return [
                    'id' => $order->id,
                    'total' => $order->total,
                    'status' => $order->status,
                    'created_at' => $order->created_at,
                    'address' => $order->address,
                    'city' => $order->city,
                    'state' => $order->state,
                    'zip' => $order->zip,
                    'country' => $order->country,
                    'items' => $order->items->map(function($item) {
                        return [
                            'product_id' => $item->product_id,
                            'name' => $item->product?->name ?? 'Product',
                            'quantity' => $item->quantity,
                            'price' => $item->price,
                        ];
                    }),
                ];
            });

        return response()->json([
            'status' => true,
            'orders' => $orders
        ], 200);
    }

    // Single order details for logged-in user
    public function show(Request $request, Order $order)
    {
        if ((int) $order->user_id !== (int) $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found',
            ], 404);
        }

        $order->load('items.product');

        return response()->json([
            'status' => true,
            'order' => $order,
        ], 200);
    }
}