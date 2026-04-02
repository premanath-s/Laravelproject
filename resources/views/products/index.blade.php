@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-8 sm:py-12 lg:py-16 px-4 sm:px-6 lg:px-8">
  <div class="mb-6 sm:mb-8 lg:mb-12">
    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900">Our Products</h1>
    <p class="mt-2 text-sm sm:text-base text-gray-600">Discover our exclusive collection of clothing</p>
  </div>

  @if(session('success'))
    <div class="mb-4 p-3 sm:p-4 rounded-md bg-green-50 border border-green-100 text-xs sm:text-sm text-green-800">{{ session('success') }}</div>
  @endif

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
    @forelse($products as $product)
      <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
        <div class="relative h-40 sm:h-44 lg:h-48 bg-gray-100 overflow-hidden group w-full">
          @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition" loading="lazy">
          @else
            <div class="flex items-center justify-center h-full text-gray-400 text-xs sm:text-sm">No image</div>
          @endif
        </div>

        <div class="p-3 sm:p-4 flex flex-col flex-grow">
          <h3 class="text-sm sm:text-base lg:text-lg font-medium text-gray-900 h-10 sm:h-12 overflow-hidden">{{ $product->name }}</h3>
          <p class="mt-1 text-gray-600 text-xs sm:text-sm h-8 sm:h-10 overflow-hidden">{{ \Illuminate\Support\Str::limit($product->description, 60) }}</p>

          <div class="mt-3 sm:mt-4 flex items-center justify-between">
            <div class="text-lg sm:text-xl lg:text-2xl font-bold text-indigo-600">₹{{ number_format($product->price, 2) }}</div>
          </div>

          <div class="mt-4 grid grid-cols-2 gap-2 sm:gap-3">
            <a href="{{ route('products.detail_view', $product->id) }}" class="inline-flex items-center justify-center px-3 sm:px-4 py-1.5 sm:py-2 border border-gray-300 text-xs sm:text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
              Details
            </a>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
              @csrf
              <button type="submit" class="w-full inline-flex items-center justify-center px-3 sm:px-4 py-1.5 sm:py-2 border border-transparent text-xs sm:text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                Add to Cart
              </button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <div class="col-span-full text-center py-12 sm:py-16">
        <p class="text-gray-500 text-sm sm:text-base">No products available</p>
      </div>
    @endforelse
  </div>

  @if($products->hasPages())
    <div class="mt-8 sm:mt-12 overflow-x-auto">
      {{ $products->links() }}
    </div>
  @endif
</div>

@endsection
