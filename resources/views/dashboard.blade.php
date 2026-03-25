@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <p class="text-gray-700">Welcome {{ auth()->user()->name }} 👋</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center space-x-4 hover:shadow-md transition">
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 italic">Total Orders</p>
                <h2 class="text-2xl font-bold text-slate-900">{{ $orderCount }}</h2>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center space-x-4 hover:shadow-md transition">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 italic">Cart Items</p>
                <h2 class="text-2xl font-bold text-slate-900">{{ $cartCount }}</h2>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center space-x-4 hover:shadow-md transition">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 italic">Account Status</p>
                <h2 class="text-base font-bold text-slate-900 truncate max-w-[120px]">{{ auth()->user()->email }}</h2>
            </div>
        </div>

    </div>

    <div class="mt-12">
        <h2 class="text-xl font-bold mb-6">Latest Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                    <div class="aspect-video bg-gray-100 flex items-center justify-center overflow-hidden">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        @else
                            <div class="text-gray-400">
                                No Image
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-gray-600 mt-1">${{ number_format($product->price, 2) }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('products.detail_view', $product->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">View Details</a>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700 transition-colors">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8 text-center">
            <a href="{{ url('/products') }}" class="inline-block bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition-colors">
                View All Products
            </a>
        </div>
    </div>

</div>

@endsection