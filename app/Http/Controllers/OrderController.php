<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show checkout form
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        $total = 0;
        foreach($cartItems as $item){
            $total += $item->product->price * $item->quantity;
        }

        return view('cart.checkout', compact('cartItems', 'total'));
    }

    // Store order after form submission
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'status' => 'pending',
        ]);

        foreach($cartItems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('payment.show', $order->id);
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.history', compact('orders'));
    }
}