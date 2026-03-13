@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <p class="text-gray-700">Welcome {{ auth()->user()->name }} 👋</p>

    <div class="grid grid-cols-3 gap-4 mt-6">

        <div class="bg-blue-500 text-white p-4 rounded">
            <h2 class="text-lg">Orders</h2>
            <p>{{ $orderCount }}</p>
        </div>

        <div class="bg-green-500 text-white p-4 rounded">
            <h2 class="text-lg">Cart Items</h2>
            <p>{{ $cartCount }}</p>
        </div>

        <div class="bg-purple-500 text-white p-4 rounded">
            <h2 class="text-lg">Profile</h2>
            <p>{{ auth()->user()->email }}</p>
        </div>

    </div>

</div>

@endsection