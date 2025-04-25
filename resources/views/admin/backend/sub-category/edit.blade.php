@extends('admin.layouts.app')
@section('title', 'Edit Subcategories')
@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Subcategories</h2>
                <a href="{{ route('subcategories.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Subcategories
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Subcategories /
                    Edit
                </p>
                <a href="{{ route('subcategories.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Subcategories
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded md:px-6 px-3">
            <form action="{{ route('subcategories.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $subcategory->id }}">

                <!-- Status Select -->
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 font-medium">Select Category <span
                            class="text-red-500"></span></label> <select name="category_id" id="category_id"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Subcategory Name Input -->
                <div class="mb-6 mt-6">
                    <label for="name" class="block text-gray-700 font-medium">Name<span
                            class="text-red-500"></span></label> <input type="text" name="name"
                        id="name"class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ $subcategory->subcategory_name }}">
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
