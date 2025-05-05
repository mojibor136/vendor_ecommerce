@extends('admin.layouts.app')
@section('title', 'Add Stock')
@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Products</h2>
                <a href="{{ route('products.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Products
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Products / Stock
                </p>
                <a href="{{ route('products.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Products
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded md:px-6 px-3">
            <!-- Success & Error Messages -->
            @if (session('success'))
                <div class="bg-green-600 text-white px-4 py-3 rounded flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="white" viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z">
                        </path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-600 text-white px-4 py-3 rounded flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="white" viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z">
                        </path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Quantity Input -->
            <div class="mb-6 mt-6 flex flex-row justify-between">
                <form action="{{ route('product.add.stock') }}" method="GET" class="flex flex-row gap-2">
                    <input type="number" class="rounded border-gray-300" placeholder="Input Product ID" name="ProductId">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Get
                        Stock</button>
                </form>
                <form action="{{ route('product.update.stock') }}" method="POST" class="flex flex-row gap-2">
                    @csrf
                    <input type="hidden" name="id" value="{{ isset($product->id) }}">
                    <input type="number" class="rounded border-gray-300" placeholder="0"
                        value="{{ isset($product->product_quantity) }}" name="quantity">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
