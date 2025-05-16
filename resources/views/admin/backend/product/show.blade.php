@extends('admin.layouts.app')
@section('title', 'Show Products')
@section('content')
    <div class="w-full h-full flex flex-col gap-4 max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="md:text-2xl text-xl font-bold text-gray-800 mb-2">Products</h2>
                <a href="{{ route('products.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Products
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Products /
                    Show
                </p>
                <a href="{{ route('products.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Products
                </a>
            </div>
        </div>

        <!-- Product Details -->
        <div class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-start">
                <!-- Product Image -->
                <div class="flex flex-col md:gap-3 pb-3 gap-1 bg-white shadow-md rounded-lg">
                    <img id="mainImg" src="{{ asset('storage/' . $product->product_image) }}"
                        class="w-auto h-auto object-cover">
                    <!-- Thumbnails -->
                    <div class="flex flex-row justify-center gap-4 relative md:p-0 p-2">
                        @if (!empty(json_decode($product->multiple_image)))
                            <div id="thumbnailContainer"
                                class="flex overflow-hidden gap-4 transition-transform duration-300 ease-in-out">
                                @foreach (json_decode($product->multiple_image, true) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" loading="lazy"
                                        data-src="{{ asset('storage/' . $image) }}" alt="Thumbnail"
                                        class="rounded cursor-pointer hover:border h-20 w-20 border-2">
                                @endforeach
                            </div>
                        @else
                            <span class="text-center block text-sm text-gray-700">Single Products</span>
                        @endif
                    </div>
                </div>

                <!-- Product Information -->
                <div class="flex flex-col gap-4 text-gray-700 bg-white shadow-md rounded-lg p-3">
                    <div class="flex flex-col">
                        <span class="font-semibold">Name:</span>
                        <span class="text-gray-600">{{ $product->product_name }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold">Description:</span>
                        <span class="text-gray-600">{{ $product->product_desc }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Category:</span>
                        <span class="text-gray-600">{{ $product->category->category_name ?? 'Null' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Subcategory:</span>
                        <span class="text-gray-600">{{ $product->subcategory->subcategory_name ?? 'Null' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Price:</span>
                        <span class="text-gray-600">${{ number_format($product->product_price, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Quantity:</span>
                        <span class="text-gray-600">{{ $product->product_quantity }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Status:</span>
                        <span
                            class="
                            @if ($product->product_status == 'approved') text-green-500 
                            @elseif($product->product_status == 'pending') text-yellow-500 
                            @elseif($product->product_status == 'rejected') text-red-500 
                            @else text-gray-600 @endif
                        ">
                            {{ ucfirst($product->product_status) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Author:</span>
                        <span
                            class="
                            @if ($product->role == 'admin') text-blue-500 
                            @elseif($product->role == 'seller') text-purple-500 
                            @else text-gray-600 @endif
                        ">
                            {{ ucfirst($product->role) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Author Id:</span>
                        <span class="{{ $product->author_id > 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $product->author_id }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-semibold">Click:</span>
                        <span class="{{ $product->click_count > 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $product->click_count }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="font-semibold">Order:</span>
                        <span class="{{ $product->order_count > 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $product->order_count }}
                        </span>
                    </div>
                    @if (!empty(json_decode($product->product_size)))
                        <div class="flex justify-between">
                            <span class="font-semibold">Size:</span>
                            <span class="text-gray-600 capitalize">
                                @foreach (json_decode($product->product_size, true) as $size)
                                    <span class="mr-1">{{ $size }}</span>
                                @endforeach
                            </span>
                        </div>
                    @endif
                    @if (!empty(json_decode($product->meta_tag)))
                        <div class="flex justify-between">
                            <span class="font-semibold">Tags:</span>
                            <span class="text-gray-600 capitalize">
                                @foreach (json_decode($product->meta_tag, true) as $tag)
                                    <span class="mr-1">{{ $tag }}</span>
                                @endforeach
                            </span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="font-semibold">Created At:</span>
                        <span class="text-gray-600">{{ $product->created_at ?? 'Null' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Updated At:</span>
                        <span class="text-gray-600">{{ $product->updated_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const mainImg = document.getElementById("mainImg");
        const thumbnails = document.querySelectorAll("#thumbnailContainer img");

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener("click", function() {
                mainImg.src = this.dataset.src;

                thumbnails.forEach(img => img.classList.remove("border-blue-500"));

                this.classList.add("border-blue-500");
            });
        });
    </script>
@endpush
