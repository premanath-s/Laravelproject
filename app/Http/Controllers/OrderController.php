<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        $total = 0;

        foreach($cartItems as $item){
            $total += $item->product->price * $item->quantity;
        }

        $order = Order::create([  // Eloquent ORM method to create a new order in the database with the current user's ID and the calculated total price
            'user_id' => Auth::id(),
            'total' => $total
        ]);

        foreach($cartItems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();  // Eloquent ORM method to delete all cart items for the current user from the database after the order has been placed

        return redirect('/orders')->with('success', 'Order placed successfully.');
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->get();  // Eloquent ORM method to query the Order model for all orders that belong to the current user and retrieve them as a collection
        return view('orders.history', compact('orders'));
    }
}
