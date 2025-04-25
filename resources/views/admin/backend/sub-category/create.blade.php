@extends('admin.layouts.app')
@section('title', 'Create Subcategories')
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
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Subcategories
                    /
                    Create
                </p>
                <a href="{{ route('subcategories.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Subcategories
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded px-6">
            <form action="{{ route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('error'))
                    <div class="bg-red-600 mt-3 text-white px-4 py-3 rounded flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z">
                            </path>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Status Select -->
                <div class="my-4">
                    <label for="name" class="block text-gray-700 font-medium">Select Category <span
                            class="text-red-500">*</span></label> <select name="category_id" id="category_id"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Subcategory Name Input -->
                <div class="mb-4">
                    <label for="subcategory_name" class="block text-gray-700 font-medium">Subcategory Name <span
                            class="text-red-500">*</span></label> <input type="text" name="subcategory_name"
                        id="name" placeholder="Subcategory Name"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ old('subcategory_name') }}">
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mb-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
