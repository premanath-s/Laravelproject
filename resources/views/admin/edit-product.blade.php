@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-gray-900">Edit Product</h1>
      <a href="/admin/products" class="text-sm text-indigo-600 hover:underline">Back</a>
    </div>

    <form method="POST" action="/admin/products/{{ $product->id }}" class="space-y-6" enctype="multipart/form-data">
      @csrf
      @method('patch')

      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <div class="mt-1">
          <input id="name" name="name" type="text" value="{{ old('name', $product->name) }}" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
        </div>
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
        <div class="mt-1">
          <input id="price" name="price" type="text" value="{{ old('price', $product->price) }}" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
        </div>
        @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="images" class="block text-sm font-medium text-gray-700">Images</label>
        <div class="mt-2 flex flex-col space-y-4">
          @if($product->images || $product->image)
          <div class="flex flex-wrap gap-4">
            @if($product->images)
              @foreach($product->images as $img)
                <div class="w-24 h-24 bg-gray-100 rounded overflow-hidden border">
                  <img src="{{ $img }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
              @endforeach
            @elseif($product->image)
              <div class="w-24 h-24 bg-gray-100 rounded overflow-hidden border">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
              </div>
            @endif
          </div>
          @endif
          <div class="flex-1">
            <input id="images" name="images[]" type="file" multiple accept="image/*" class="block w-full rounded-md border-gray-300" />
            <p class="text-xs text-gray-500 mt-1">Uploading new images will replace existing ones.</p>
            @error('images') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            @error('images.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>
        </div>
      </div>

      <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <div class="mt-1">
          <textarea id="description" name="description" rows="4"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $product->description) }}</textarea>
        </div>
        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <div class="flex items-center justify-end space-x-3 pt-4 border-t">
        <a href="/admin/products" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancel</a>
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">Update Product</button>
      </div>
    </form>
  </div>
</div>

@endsection
