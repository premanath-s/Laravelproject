@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Our Products</h1>
    <p class="mt-2 text-gray-600">Discover our exclusive collection of clothing</p>
  </div>

  @if(session('success'))
    <div class="mb-4 p-3 rounded-md bg-green-50 border border-green-100 text-green-800">{{ session('success') }}</div>
  @endif

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($products as $product)
      <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
        <div class="relative h-48 bg-gray-100 overflow-hidden group">
          @if($product->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition">
          @else
            <div class="flex items-center justify-center h-full text-gray-400">No image</div>
          @endif
        </div>

        <div class="p-4">
          <h3 class="text-lg font-medium text-gray-900 h-12 overflow-hidden">{{ $product->name }}</h3>
          <p class="mt-1 text-gray-600 text-sm h-10 overflow-hidden">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</p>

          <div class="mt-4 flex items-center justify-between">
            <div class="text-2xl font-bold text-indigo-600">₹{{ number_format($product->price, 2) }}</div>
          </div>

          <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Add to Cart
            </button>
          </form>
        </div>
      </div>
    @empty
      <div class="col-span-full text-center py-12">
        <p class="text-gray-500">No products available</p>
      </div>
    @endforelse
  </div>

  @if($products->hasPages())
    <div class="mt-8">{{ $products->links() }}</div>
  @endif
</div>

@endsection
