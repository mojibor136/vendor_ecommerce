@extends('admin.layouts.app')
@section('title', 'Create Categories')
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
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Categories / Create
                </p>
                <a href="{{ route('categories.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Categories
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded md:px-6 px-3">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Error Message for Duplicate Category -->
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

                <!-- Category Image Input -->
                <div class="my-4">
                    <label for="category_img" class="block text-gray-700 font-medium">Image<span class="text-red-500">
                            *</span></label>
                    <input type="file" id="category_img"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ old('category_img') }}">
                    @error('category_img')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror

                    <!-- Hidden input for optimized image -->
                    <input type="hidden" name="optimized_image" id="optimizedImage">
                </div>

                <!-- Category Name Input -->
                <div class="mb-6">
                    <label for="category_name" class="block text-gray-700 font-medium">Category Name<span
                            class="text-red-500"> *</span></label>
                    <input type="text" name="category_name" id="category_name" placeholder="Category Name"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ old('category_name') }}">
                    @error('category_name')
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

    <script>
        document.getElementById('category_img').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    // Resize to 800x800 while maintaining aspect ratio
                    canvas.width = 800;
                    canvas.height = 800;
                    const ratio = Math.min(800 / img.width, 800 / img.height);
                    const newWidth = img.width * ratio;
                    const newHeight = img.height * ratio;
                    const offsetX = (800 - newWidth) / 2;
                    const offsetY = (800 - newHeight) / 2;

                    ctx.fillStyle = "#fff"; // White background
                    ctx.fillRect(0, 0, 800, 800);
                    ctx.drawImage(img, offsetX, offsetY, newWidth, newHeight);

                    // Convert to WebP and store in hidden input
                    canvas.toBlob(blob => {
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            document.getElementById('optimizedImage').value = reader.result;
                        };
                        reader.readAsDataURL(blob);
                    }, 'image/webp', 0.8);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection
