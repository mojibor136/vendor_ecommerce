@extends('seller.layouts.app')
@section('title', 'Show Products')
@section('content')
    <div class="w-full h-full flex flex-col gap-4 max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="md:text-2xl text-xl font-bold text-gray-800 mb-2">Products</h2>
                <a href="{{ route('seller.products.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Products
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('seller.dashboard') }}" class="text-blue-600 hover:underline">Home</a> / Products /
                    Show
                </p>
                <a href="{{ route('seller.products.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Products
                </a>
            </div>
        </div>

        <!-- Product Details -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <!-- Product Image -->
                <div class="flex justify-center">
                    @if ($product->product_image)
                        <img src="{{ asset('storage/' . $product->product_image) }}"
                            class="w-52 h-52 object-cover rounded-lg shadow-lg">
                    @else
                        <img src="https://via.placeholder.com/150" class="w-52 h-52 object-cover rounded-lg shadow-lg">
                    @endif
                </div>

                <!-- Product Information -->
                <div class="flex flex-col gap-4 text-gray-700">
                    <div class="flex flex-col">
                        <span class="font-semibold">Name:</span>
                        <span class="text-gray-600">{{ $product->product_name }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold">Description:</span>
                        <span class="text-gray-600">{{ $product->product_desc }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Category:</span>
                        <span class="text-gray-600">{{ $product->category->category_name ?? 'Null' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Subcategory:</span>
                        <span class="text-gray-600">{{ $product->subcategory->subcategory_name ?? 'Null' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Price:</span>
                        <span class="text-gray-600">${{ number_format($product->product_price, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Quantity:</span>
                        <span class="text-gray-600">{{ $product->product_quantity }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Author:</span>
                        <span class="text-gray-600">{{ $product->role }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Author Id:</span>
                        <span class="text-gray-600">{{ $product->author_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Click:</span>
                        <span class="text-gray-600">{{ $product->click_count }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Order:</span>
                        <span class="text-gray-600">{{ $product->order_count }}</span>
                    </div>
                    @if (!empty(json_decode($product->size)))
                        <div class="flex justify-between">
                            <span class="font-semibold">Size:</span>
                            <span class="text-gray-600 capitalize">
                                @foreach (json_decode($product->size, true) as $size)
                                    <span class="mr-1">{{ $size }}</span>
                                @endforeach
                            </span>
                        </div>
                    @endif
                    @if (!empty(json_decode($product->tag)))
                        <div class="flex justify-between">
                            <span class="font-semibold">Tags:</span>
                            <span class="text-gray-600 capitalize">
                                @foreach (json_decode($product->tag, true) as $tag)
                                    <span class="mr-1">{{ $tag }}</span>
                                @endforeach
                            </span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="font-semibold">Created At:</span>
                        <span class="text-gray-600">{{ $product->created_at ?? 'Null' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Updated At:</span>
                        <span class="text-gray-600">{{ $product->updated_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
