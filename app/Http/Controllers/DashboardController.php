<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();

        return view('dashboard', compact('totalUsers','totalProducts'));
    }
}