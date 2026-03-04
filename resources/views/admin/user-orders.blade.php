@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <h1 class="text-2xl font-semibold text-gray-900 mb-6">Orders for {{ $user->email }}</h1>

  @if($orders->isEmpty())
    <div class="bg-yellow-50 border border-yellow-100 text-yellow-800 p-4 rounded">No orders found for this user.</div>
  @else
    <div class="space-y-4">
      @foreach($orders as $order)
        <div class="bg-white shadow rounded p-4">
          <div class="flex items-center justify-between mb-2">
            <div>Order #{{ $order->id }}</div>
            <div class="font-medium">${{ number_format($order->total,2) }}</div>
          </div>
          <ul class="divide-y divide-gray-100">
            @foreach($order->items as $item)
              <li class="py-2 flex items-center">
                <div class="flex-1">{{ $item->product?->name ?? 'Product' }}</div>
                <div class="text-sm text-gray-600">Qty: {{ $item->quantity }}</div>
              </li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>
  @endif

</div>

@endsection
