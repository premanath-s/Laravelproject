<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    public function __construct()
    {
        if(!auth()->check() || !auth()->user()->is_admin){
            abort(403);
        }
    }
    public function activity()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(25);
        return view('admin.activity', compact('logs'));
    }

    public function userOrders($id)
    {
        $user = User::findOrFail($id);// Eloquent ORM method to find a user by their ID or fail with a 404 error if not found
        $orders = Order::where('user_id', $user->id)->with('items.product')->get();// Eloquent ORM method to query the Order model for orders that belong to the specified user, eager load the related items and products, and get the results as a collection
        return view('admin.user-orders', compact('user','orders'));
    }
}
