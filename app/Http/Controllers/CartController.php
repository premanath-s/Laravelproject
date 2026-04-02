<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function add(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())  // Eloquent ORM method to query the Cart model for an existing cart item for the current user and the specified product ID
                    ->where('product_id', $id)
                    ->first();

        if($cart){
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([      // Eloquent ORM method to create a new cart item in the database with the current user's ID, the specified product ID, and a default quantity of 1
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => 1
            ]);
        }

        return redirect('/cart');
    }

    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id); // Eloquent ORM method to find a cart item by its ID
        $quantity = $request->input('quantity', $cart->quantity + 1);
        $cart->quantity = $quantity;
        $cart->save();

        return back();
    }

    public function remove(Request $request, $id)
    {
        Cart::find($id)->delete(); // Eloquent ORM method to find a cart item by its ID and delete it from the database
        return back();
    }
}
