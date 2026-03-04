@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
	<div class="flex items-center justify-between mb-6">
		<div>
			<h1 class="text-2xl font-semibold text-gray-900">Admin Panel</h1>
			<p class="mt-1 text-sm text-gray-500">Manage your store products.</p>
		</div>
		<a href="/admin/products/create" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">Add Product</a>
	</div>

	<div class="bg-white shadow overflow-hidden rounded-md">
		<div class="overflow-x-auto">
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-50">
					<tr>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
						<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
						<th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
					</tr>
				</thead>
				<tbody class="bg-white divide-y divide-gray-200">
					@foreach($products as $product)
						<tr>
							<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->id }}</td>
							<td class="px-6 py-4 whitespace-nowrap">
								@if($product->image)
									<img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-10 w-10 rounded object-cover">
								@else
									<div class="h-10 w-10 bg-gray-100 rounded"></div>
								@endif
							</td>
							<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->name }}</td>
							<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($product->price, 2) }}</td>
							<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
								<a href="/admin/products/{{ $product->id }}/edit" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
								<form action="/admin/products/{{ $product->id }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this product?');">
									@csrf
									@method('DELETE')
									<button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="mt-6">
		{{ $products->links() ?? '' }}
	</div>

</div>

@endsection
