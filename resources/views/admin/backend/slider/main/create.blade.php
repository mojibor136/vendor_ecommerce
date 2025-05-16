@extends('admin.layouts.app')
@section('title', 'Create Main Slider')
@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Create Main Slider</h2>
                <a href="{{ route('slider.main.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Main Sliders
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Sliders /
                    Create
                </p>
                <a href="{{ route('slider.main.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Main Sliders
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded px-6 py-6 shadow">
            <form action="{{ route('slider.main.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (session('error'))
                    <div class="bg-red-600 my-3 text-white px-4 py-3 rounded flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z">
                            </path>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Link Input -->
                <div class="mb-4">
                    <label for="link" class="block text-gray-700 font-medium">Link (URL)</label>
                    <input type="url" name="link" id="link" placeholder="https://example.com"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('link') }}">
                    @error('link')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Images Upload -->
                <div class="mb-4">
                    <label for="images" class="block text-gray-700 font-medium">Upload Images <span
                            class="text-red-500">*</span></label>
                    <input type="file" name="image"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                    <small class="text-gray-500 text-xs">You can upload single images.</small>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-teal-500 text-white px-6 py-2 rounded hover:bg-teal-600 transition">
                        Create Slider
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
