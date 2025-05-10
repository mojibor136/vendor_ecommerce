@extends('admin.layouts.app')
@section('title', 'Add Stock')
@section('content')
    <div class="w-full h-full flex flex-col gap-6">

        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded-lg md:p-6 p-4 gap-2">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-gray-800">Products Stock</h2>
                <a href="{{ route('products.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">All
                    Products</a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> /
                    <span class="text-gray-500">Products / Stock</span>
                </p>
                <a href="{{ route('products.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">All
                    Products</a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded-lg shadow p-6">
            <!-- Success & Error Messages -->
            @if (session('success'))
                <div
                    class="bg-green-100 text-green-800 px-4 py-3 rounded flex items-center gap-2 mb-4 border border-green-300">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (!isset($product))
                <div class="bg-red-100 text-red-800 px-4 py-3 rounded flex items-center gap-2 mb-4 border border-red-300">
                    <span>Product not found.</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-800 px-4 py-3 rounded flex items-center gap-2 mb-4 border border-red-300">
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Quantity Input Section -->
            <div class="flex flex-col md:flex-row justify-between gap-4">
                <!-- Product ID Input -->
                <form action="{{ route('product.add.stock') }}" method="GET"
                    class="flex flex-col md:flex-row gap-2 items-center w-full md:w-1/2">
                    <input type="number" name="ProductId" placeholder="Input Product ID" value="{{ request('ProductId') }}"
                        class="w-full md:w-auto border rounded border-gray-300 focus:border-green-700 text-gray-700">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Get Stock</button>
                </form>

                <!-- Update Stock Form -->
                @if (isset($product))
                    <form action="{{ route('product.update.stock') }}" method="POST"
                        class="flex flex-col md:flex-row gap-2 items-center w-full md:w-1/2">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="text" value="{{ $product->product_quantity }}" disabled
                            class="w-full md:w-20 text-center bg-gray-100 border border-gray-300 rounded px-2 py-2">
                        <input type="number" name="quantity" placeholder="Enter stock quantity"
                            class="w-full md:w-auto border rounded border-gray-300 text-gray-700">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Update</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
