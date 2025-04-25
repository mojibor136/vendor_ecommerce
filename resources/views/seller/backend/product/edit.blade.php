@extends('seller.layouts.app')
@section('title', 'Edit Products')
@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Products</h2>
                <a href="{{ route('seller.products.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Products
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('seller.dashboard') }}" class="text-blue-600 hover:underline">Home</a> / Products / Edit
                </p>
                <a href="{{ route('seller.products.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Products
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded md:px-6 px-3">
            <form action="{{ route('seller.products.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <!-- Subcategory Name Input -->
                <div class="mb-6 mt-6">
                    <label for="product_name" class="block text-gray-700 font-medium">Name<span class="text-red-500">
                            *</span></label> <input type="text" name="product_name"
                        id="product_name"class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ $product->product_name }}">
                    @error('product_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="product_description" class="block text-gray-700 font-medium">Description<span
                            class="text-red-400"> *</span></label>
                    <textarea name="product_description" id="product_description"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="Description">{{ $product->product_desc }}</textarea>
                    @error('product_description')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price Input -->
                <div class="mb-6">
                    <label for="product_price" class="block text-gray-700 font-medium">Price <span
                            class="text-red-400">*</span></label>
                    <input type="number" name="product_price" id="product_price"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ $product->product_price }}" step="0.01">
                    @error('product_price')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Quantity Input -->
                <div class="mb-6">
                    <label for="product_quantity" class="block text-gray-700 font-medium">Quantity <span
                            class="text-red-400">*</span></label>
                    <input type="number" name="product_quantity" id="product_quantity"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ $product->product_quantity }}">
                    @error('product_quantity')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category Select -->
                <div class="mb-6">
                    <label for="category" class="block text-gray-700 font-medium">Select Category <span
                            class="text-red-400">*</span></label>
                    <select name="category_id" id="category"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- SubCategory Select -->
                <div class="mb-6">
                    <label for="subcategory" class="block text-gray-700 font-medium">Select Subcategory <span
                            class="text-red-400">*</span></label>
                    <select name="subcategory_id" id="subcategory"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                        <option value="">-- Select Subcategory --</option>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}"
                                {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>
                                {{ $subcategory->subcategory_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subcategory_id')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-6 mt-6">
                    <label for="image" class="block text-gray-700 font-medium">Image<span class="text-red-500">
                            *</span></label> <input type="file" name="image" id="image"
                        class="w-full mt-2 p-2 border rounded">
                    @error('image')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Multiple Image Input -->
                <div class="mb-6">
                    <label for="multiple_image" class="block text-gray-700 font-medium">
                        Multiple Image<span class="text-red-400"></span>
                    </label>
                    <input type="file" name="multiple_image[]" id="multiple_image" class="w-full mt-2 p-2 border rounded"
                        multiple accept="image/*">

                    @error('multiple_image.*')
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
@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ route('get.subcategories', ':id') }}".replace(':id', category_id),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#subcategory').empty();
                            $('#subcategory').append(
                                '<option value="">-- Select Subcategory --</option>');
                            $.each(data, function(key, subcategory) {
                                $('#subcategory').append('<option value="' + subcategory
                                    .id + '">' + subcategory.subcategory_name +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory').empty();
                    $('#subcategory').append('<option value="">-- Select Subcategory --</option>');
                }
            });
        });
    </script>
@endpush
