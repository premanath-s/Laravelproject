@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
	<div class="bg-white shadow-md rounded-lg p-6">
		<div class="flex items-center justify-between mb-6">
			<div>
				<h1 class="text-2xl font-semibold text-gray-900">Add Product</h1>
				<p class="mt-1 text-sm text-gray-500">Create a new product for your store.</p>
			</div>
			<a href="/admin/products" class="text-sm text-indigo-600 hover:underline">Back to products</a>
		</div>

		@if(session('success'))
			<div class="mb-4 p-3 rounded-md bg-green-50 border border-green-100 text-green-800">{{ session('success') }}</div>
		@endif

		@if($errors->any())
			<div class="mb-4 p-3 rounded-md bg-red-50 border border-red-100 text-red-800">
				<ul class="list-disc pl-5">
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<form method="POST" action="/admin/products/store" class="space-y-6" enctype="multipart/form-data">
			@csrf

			<div>
				<label for="name" class="block text-sm font-medium text-gray-700">Name</label>
				<div class="mt-1">
					<input id="name" name="name" type="text" value="{{ old('name') }}" required
						class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
				</div>
				@error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
			</div>

			<div>
				<label for="price" class="block text-sm font-medium text-gray-700">Price</label>
				<div class="mt-1">
					<input id="price" name="price" type="text" value="{{ old('price') }}" required
						class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
				</div>
				@error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
			</div>

			<div>
				<label for="image" class="block text-sm font-medium text-gray-700">Image URL</label>
				<div class="mt-1">
					<input id="image" name="image" type="file"
						class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
				</div>
				@error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
			</div>

			<div>
				<label for="description" class="block text-sm font-medium text-gray-700">Description</label>
				<div class="mt-1">
					<textarea id="description" name="description" rows="4"
						class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
				</div>
				@error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
			</div>

			<div class="flex items-center justify-end space-x-3 pt-4 border-t">
				<a href="/admin/products" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancel</a>
				<button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
					Add Product
				</button>
			</div>
		</form>
	</div>
</div>

@endsection
