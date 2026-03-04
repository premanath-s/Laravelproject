@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="bg-pink-600 text-white py-24">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl font-bold mb-6">
            Elegant Women's Fashion
        </h1>
        <p class="text-lg mb-8 text-pink-100">
            Discover the latest trends in sarees, kurtis, dresses & more.
        </p>
        <a href="/products"
           class="bg-white text-pink-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
            Shop Women's Collection
        </a>
    </div>
</div>

<!-- Featured Categories -->
<div class="max-w-7xl mx-auto px-6 py-20">
    <h2 class="text-3xl font-bold mb-12 text-center">
        Shop By Category
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- Sarees -->
        <div class="bg-white shadow-lg rounded-2xl p-8 text-center hover:shadow-2xl transition">
            <h3 class="text-2xl font-semibold mb-4 text-pink-600">Sarees</h3>
            <p class="text-gray-600 mb-6">
                Traditional & designer sarees for every occasion.
            </p>
            <a href="/products"
               class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition">
                Explore
            </a>
        </div>

        <!-- Kurtis -->
        <div class="bg-white shadow-lg rounded-2xl p-8 text-center hover:shadow-2xl transition">
            <h3 class="text-2xl font-semibold mb-4 text-pink-600">Kurtis</h3>
            <p class="text-gray-600 mb-6">
                Comfortable & stylish daily wear kurtis.
            </p>
            <a href="/products"
               class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition">
                Explore
            </a>
        </div>

        <!-- Dresses -->
        <div class="bg-white shadow-lg rounded-2xl p-8 text-center hover:shadow-2xl transition">
            <h3 class="text-2xl font-semibold mb-4 text-pink-600">Dresses</h3>
            <p class="text-gray-600 mb-6">
                Modern western dresses for special moments.
            </p>
            <a href="/products"
               class="bg-pink-600 text-white px-6 py-2 rounded-lg hover:bg-pink-700 transition">
                Explore
            </a>
        </div>

    </div>
</div>

<!-- Offer Section -->
<div class="bg-pink-100 py-16">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-pink-700 mb-4">
            🌸 Festive Sale – Up to 40% OFF
        </h2>
        <a href="/products"
           class="bg-pink-600 text-white px-8 py-3 rounded-lg hover:bg-pink-700 transition">
            Grab the Deal
        </a>
    </div>
</div>

@endsection