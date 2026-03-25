@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <h1 class="text-2xl font-semibold text-gray-900 mb-6">Order History</h1>

  @if(session('success'))
    <div class="mb-4 p-3 rounded-md bg-green-50 border border-green-100 text-green-800">{{ session('success') }}</div>
  @endif

  @if($orders->isEmpty())
    <div class="bg-yellow-50 border border-yellow-100 text-yellow-800 p-4 rounded">You have no orders yet.</div>
  @else
    <div class="space-y-6">
      @foreach($orders as $order)
        <div class="bg-white shadow rounded-lg p-4">
          <div class="flex items-center justify-between mb-3">
            <div>
              <div class="text-sm text-gray-500">Order #{{ $order->id }}</div>
              <div class="text-sm text-gray-500">Placed: {{ $order->created_at->format('M d, Y H:i') }}</div>
            </div>
            <div class="text-lg font-medium text-gray-900">${{ number_format($order->total,2) }}</div>
          </div>

          <!-- Shipping Address Added -->
          <div class="mt-3">
            <p class="text-sm font-medium text-gray-700">Shipping Address:</p>
            <p class="text-sm text-gray-500">
              {{ $order->address }}, {{ $order->city }}, {{ $order->state }}, {{ $order->zip }}, {{ $order->country }}
            </p>
          </div>

          <div class="border-t pt-3">
            <ul class="divide-y divide-gray-100">
              @foreach($order->items as $item)
                <li class="py-3 flex items-center space-x-4">
                  <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded overflow-hidden">
                    @if($item->product && $item->product->image_url)
                      <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                    @endif
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900">{{ $item->product?->name ?? 'Product' }}</p>
                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} • ${{ number_format($item->price,2) }}</p>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endforeach
    </div>
  @endif

</div>

@endsection