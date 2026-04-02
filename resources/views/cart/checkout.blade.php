@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 sm:py-12 lg:py-16 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-6">Checkout</h1>

        <div class="mb-6 rounded-lg border border-indigo-200 bg-indigo-50 p-3 sm:p-4">
            <p class="text-xs sm:text-sm font-semibold text-indigo-800">Payment Method</p>
            <p class="mt-1 text-xs sm:text-sm text-indigo-700">
                Razorpay (UPI, Card, Netbanking, Wallet) will open on the next step after placing your order.
            </p>
        </div>

        <form action="{{ route('orders.store') }}" method="POST" class="space-y-4 sm:space-y-6">
            @csrf

            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" required
                       class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('address')
                    <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- City -->
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" name="city" id="city" value="{{ old('city') }}" required
                       class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('city')
                    <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- State -->
            <div>
                <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                <input type="text" name="state" id="state" value="{{ old('state') }}" required
                       class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('state')
                    <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- ZIP Code -->
            <div>
                <label for="zip" class="block text-sm font-medium text-gray-700">ZIP Code</label>
                <input type="text" name="zip" id="zip" value="{{ old('zip') }}" required
                       class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('zip')
                    <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Country -->
            <div>
                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                <input type="text" name="country" id="country" value="{{ old('country') }}" required
                       class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('country')
                    <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full inline-flex justify-center py-2.5 sm:py-3 px-4 sm:px-6 border border-transparent shadow-sm text-sm sm:text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Place Order & Continue to Razorpay
                </button>
            </div>
        </form>
    </div>
</div>
@endsection