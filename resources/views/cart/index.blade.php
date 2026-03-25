@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

  @if(session('success'))
    <div class="mb-4 p-3 rounded-md bg-green-50 border border-green-100 text-green-800">{{ session('success') }}</div>
  @endif

  @if($cartItems->count())
    <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @foreach($cartItems as $item)
            <tr>
              <td class="px-6 py-4 text-sm font-medium text-gray-900">
                <div class="flex items-center">
                  <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded">
                    @if($item->product && $item->product->image_url)
                      <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded">
                    @endif
                  </div>
                  <div class="ml-4">{{ $item->product->name }}</div>
                </div>
              </td>
              <td class="px-6 py-4 text-sm text-gray-900">₹{{ number_format($item->product->price, 2) }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $item->quantity }}</td>
              <td class="px-6 py-4 text-right text-sm">
                <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Remove</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="bg-white shadow rounded-lg p-6 mb-6">
      <div class="flex items-center justify-between mb-6">
        <span class="text-lg font-medium text-gray-900">Total:</span>
        <span class="text-2xl font-bold text-indigo-600">₹{{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</span>
      </div>
      <a href="/checkout" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
        Proceed to Checkout
      </a>
    </div>

    <a href="/products" class="text-indigo-600 hover:underline">← Continue Shopping</a>
  @else
    <div class="bg-yellow-50 border border-yellow-100 text-yellow-800 p-6 rounded-lg text-center">
      <p class="text-lg mb-4">Your cart is empty</p>
      <a href="/products" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Start Shopping</a>
    </div>
  @endif

</div>

@endsection
