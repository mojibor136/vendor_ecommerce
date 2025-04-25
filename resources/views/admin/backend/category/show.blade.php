@extends('admin.layouts.app')
@section('title', 'Show Categories')
@section('content')
    <div class="w-full h-full flex flex-col gap-4 max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="md:text-2xl text-xl font-bold text-gray-800 mb-2">Categories</h2>
                <a href="{{ route('categories.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Categories
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Categories /
                    Show
                </p>
                <a href="{{ route('categories.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Categories
                </a>
            </div>
        </div>

        <!-- Category Details -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <!-- Category Image -->
                <div class="flex justify-center">
                    @if ($category->category_img)
                        <img src="{{ asset('storage/' . $category->category_img) }}"
                            class="w-52 h-52 object-cover rounded-lg shadow-lg">
                    @else
                        <img src="https://via.placeholder.com/150" class="w-52 h-52 object-cover rounded-lg shadow-lg">
                    @endif
                </div>
                <!-- Category Information -->
                <div class="space-y-3">
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Category Name:</span>
                        <span class="text-gray-600">{{ $category->category_name }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Subcategory Count:</span>
                        <span class="text-gray-600">{{ $category->subcategory_count }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Product Count:</span>
                        <span class="text-gray-600">{{ $category->product_count }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Created At:</span>
                        <span class="text-gray-600">{{ $category->created_at }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Updated At:</span>
                        <span class="text-gray-600">{{ $category->updated_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
