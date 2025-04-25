@extends('seller.layouts.app')
@section('title', 'Show Subcategories')
@section('content')
    <div class="w-full h-full flex flex-col gap-4 max-w-6xl mx-auto">
        <!-- Header Section -->

        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="md:text-2xl text-xl font-bold text-gray-800 mb-2">Subcategories</h2>
                <a href="{{ route('seller.subcategories.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Subcategories
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('seller.dashboard') }}" class="text-blue-600 hover:underline">Home</a> / Subcategories /
                    Show
                </p>
                <a href="{{ route('seller.subcategories.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Subcategories
                </a>
            </div>
        </div>

        <!-- Subcategory Details -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 gap-4">
                <!-- Subcategory Information -->
                <div class="space-y-3">
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Subcategory Name:</span>
                        <span class="text-gray-600">{{ $subcategory->subcategory_name }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Category Name:</span>
                        <span class="text-gray-600">{{ $subcategory->category->category_name }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Product Count:</span>
                        <span class="text-gray-600">{{ $subcategory->product_count }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Created At:</span>
                        <span class="text-gray-600">{{ $subcategory->created_at }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Updated At:</span>
                        <span class="text-gray-600">{{ $subcategory->updated_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
