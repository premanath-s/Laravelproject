@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
        <!-- Image gallery -->
        <div class="flex flex-col-reverse">
            <!-- Image selector -->
            <div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                    @foreach($product->image_urls as $index => $url)
                        <button id="tabs-1-tab-{{ $index }}" class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4" role="tab" type="button" onclick="changeImage('{{ $url }}', {{ $index }})">
                            <span class="sr-only"> Image {{ $index + 1 }} </span>
                            <span class="absolute inset-0 rounded-md overflow-hidden">
                                <img src="{{ $url }}" alt="" class="w-full h-full object-center object-cover">
                            </span>
                            <!-- Selected: "ring-indigo-500", Not Selected: "ring-transparent" -->
                            <span id="tab-ring-{{ $index }}" class="{{ $index === 0 ? 'ring-indigo-500' : 'ring-transparent' }} absolute inset-0 rounded-md ring-2 ring-offset-2 pointer-events-none" aria-hidden="true"></span>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="w-full aspect-w-1 aspect-h-1">
                <!-- Tab panel, show/hide based on tab state. -->
                <div id="tabs-1-panel-1" aria-labelledby="tabs-1-tab-1" role="tabpanel" tabindex="0">
                    <img id="main-image" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-center object-contain sm:rounded-lg shadow-lg bg-gray-50 max-h-[500px]">
                </div>
            </div>
        </div>

        <!-- Product info -->
        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>

            <div class="mt-3">
                <h2 class="sr-only">Product information</h2>
                <p class="text-3xl text-indigo-600 font-bold">₹{{ number_format($product->price, 2) }}</p>
            </div>

            <div class="mt-6">
                <h3 class="sr-only">Description</h3>
                <div class="text-base text-gray-700 space-y-6">
                    <p>{{ $product->description }}</p>
                </div>
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-10">
                @csrf
                <div class="flex">
                    <button type="submit" class="max-w-xs flex-1 bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 sm:w-full">
                        Add to Cart
                    </button>
                </div>
            </form>

            <div class="mt-10 border-t border-gray-200 pt-10">
                <h3 class="text-sm font-medium text-gray-900">Details</h3>
                <div class="mt-4 prose prose-sm text-gray-500">
                    <ul role="list">
                        <li>High quality materials</li>
                        <li>Durable and long lasting</li>
                        <li>Ethically sourced</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(url, index) {
        document.getElementById('main-image').src = url;
        
        // Update rings
        const rings = document.querySelectorAll('[id^="tab-ring-"]');
        rings.forEach(ring => {
            ring.classList.remove('ring-indigo-500');
            ring.classList.add('ring-transparent');
        });
        
        const activeRing = document.getElementById('tab-ring-' + index);
        activeRing.classList.remove('ring-transparent');
        activeRing.classList.add('ring-indigo-500');
    }
</script>
@endsection
