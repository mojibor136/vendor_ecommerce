@extends('admin.layouts.app')
@section('title', 'Edit Categories')
@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Categories</h2>
                <a href="{{ route('categories.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Categories
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Categories /
                    Edit
                </p>
                <a href="{{ route('categories.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Categories
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded md:px-6 px-3">
            <form action="{{ route('categories.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $category->id }}">
                <!-- Subcategory Name Input -->
                <div class="mb-6 mt-6">
                    <label for="category_name" class="block text-gray-700 font-medium">Category Name<span
                            class="text-red-500"> *</span></label> <input type="text" name="category_name"
                        placeholder="Category Name"
                        id="category_name"class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ $category->category_name }}">
                </div>

                <!-- Category Image Input -->
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-medium">Image<span class="text-red-500">
                            *</span></label> <input type="file" name="category_img" id="image"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('image') }}">
                    @error('category_img')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Submit Button -->
                <div class="flex justify-end mb-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
