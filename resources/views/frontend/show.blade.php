<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Primary Meta Tags -->
    <title>{{ $product->product_name }} | Bangladesh</title>
    <meta name="title" content="{{ $product->product_name }} | Bangladesh">
    <meta name="description" content="{{ Str::limit(strip_tags($product->product_desc), 160) }}">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $product->product_name }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($product->product_desc), 160) }}">
    <meta property="og:image" content="{{ asset('storage/' . $product->product_image) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $product->product_name }}">
    <meta property="twitter:description" content="{{ Str::limit(strip_tags($product->product_desc), 160) }}">
    <meta property="twitter:image" content="{{ asset('storage/' . $product->product_image) }}">
    <link rel="stylesheet" href="{{ asset('remixicon/remixicon.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <title>{{ $product->product_name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
</style>
<!-- Schema.org Product JSON-LD -->
<script type="application/ld+json">
        {
          "@context": "https://schema.org/",
          "@type": "Product",
          "name": "{{ $product->product_name }}",
          "image": [
            "{{ asset('storage/' . $product->product_image) }}"
          ],
          "description": "{{ Str::limit(strip_tags($product->product_desc), 160) }}",
          "sku": "SKU-{{ $product->id }}",
          "brand": {
            "@type": "Brand",
            "name": "Bangladesh"
          },
          "offers": {
            "@type": "Offer",
            "url": "{{ url()->current() }}",
            "priceCurrency": "BDT",
            "price": "{{ $product->product_price }}",
            "availability": "https://schema.org/InStock"
          }
        }
</script>

<body class="bg-gray-50">
    @include('frontend.layouts.header')
    <div
        class="container mx-auto md:p-4 p-0 sm:max-w-sm md:max-w-full lg:max-w-full xl:max-w-[1020px] 2xl:max-w-[1440px]">
        <div class="grid grid-cols-12 bg-white rounded md:p-4 p-0 ">
            <div class="md:col-span-4 col-span-12">
                <div class="flex flex-col md:gap-4 gap-1">
                    <!-- Main Image -->
                    <img id="mainImg" src="{{ asset('storage/' . $product->product_image) }}" loading="lazy"
                        alt="{{ $product->product_name }}"
                        class="rounded-none md:rounded md:border border-gray-300 h-auto">
                    <!-- Thumbnails -->
                    <div class="flex flex-row justify-center gap-4 relative md:p-0 p-2">
                        @if (!empty(json_decode($product->multiple_image)))
                            <div id="leftArrow"
                                class="absolute left-0 top-1/2 -translate-y-1/2 h-10 w-10 bg-white/80 shadow-md rounded-full flex items-center justify-center cursor-pointer hover:bg-gray-200 transition">
                                <i class="ri-arrow-left-s-line text-2xl text-gray-600"></i>
                            </div>

                            <div id="thumbnailContainer"
                                class="flex overflow-hidden gap-4 transition-transform duration-300 ease-in-out">
                                @foreach (json_decode($product->multiple_image, true) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" loading="lazy"
                                        data-src="{{ asset('storage/' . $image) }}" alt="Thumbnail"
                                        class="rounded cursor-pointer hover:border h-16 w-16 border-2">
                                @endforeach
                            </div>

                            <div id="rightArrow"
                                class="absolute right-0 top-1/2 -translate-y-1/2 h-10 w-10 bg-white/80 shadow-md rounded-full flex items-center justify-center cursor-pointer hover:bg-gray-200 transition">
                                <i class="ri-arrow-right-s-line text-2xl text-gray-600"></i>
                            </div>
                        @else
                            <span class="text-center block text-sm text-gray-700">Single Products</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="md:col-span-8 col-span-12 px-3 mb-4">
                <div class="md:w-2/3 w-full flex flex-col gap-4">
                    <div class="flex flex-col gap-1 md:gap-2">
                        <span class="text-xl line-clamp-2 text-gray-800">
                            {{ $product->product_name }}
                        </span>

                        <div class="flex flex-col gap-1">
                            <span class="text-xs text-gray-600 font-semibold uppercase">Description</span>
                            <span class="text-sm text-gray-600">
                                {{ $product->product_desc }}
                            </span>
                        </div>
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex flex-row gap-0.5 text-[15px] text-orange-500">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-line"></i>
                                <i class="ri-star-line"></i>
                            </div>
                            <span class="text-xl md:hidden block font-bold text-gray-700">
                                &#2547;{{ $product->product_price }}
                            </span>
                        </div>
                        <span class="text-xl hidden md:block font-bold text-gray-700">
                            &#2547;{{ $product->product_price }}
                        </span>
                    </div>

                    <div class="hidden md:flex flex-col gap-2">
                        <span class="text-xs text-gray-600 font-semibold">QUANTITY</span>
                        <input type="number" min="1" max="3" value="1"
                            class="rounded w-20 text-center py-1.5 border border-gray-300">
                    </div>

                    @if (!empty(json_decode($product->product_size)))
                        <div class="flex flex-col gap-2">
                            <span class="text-xs text-gray-600 font-semibold">SIZE</span>
                            <div class="flex flex-row gap-2">
                                @foreach (json_decode($product->product_size, true) as $index => $size)
                                    @php
                                        $id = strtolower(preg_replace('/\s+/', '-', $size)) . '-' . $index;
                                    @endphp

                                    <input type="radio" id="{{ $id }}" name="size"
                                        value="{{ $size }}" class="hidden peer/{{ $id }}">
                                    <label for="{{ $id }}"
                                        class="px-3 py-1.5 text-sm rounded cursor-pointer text-white bg-gray-400 hover:bg-blue-500 peer-checked/{{ $id }}:bg-blue-600">
                                        {{ $size }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="md:flex hidden flex-row gap-4">
                        <button class="bg-blue-500 text-white rounded px-4 py-2">Add to Cart</button>
                        <button class="bg-green-500 text-white rounded px-4 py-2">Buy Now</button>
                    </div>
                </div>
            </div>


            <div
                class="fixed block md:hidden overflow-hidden bottom-0 left-0 w-full bg-white shadow-md border-t  rounded-t-md z-20">
                <div class="flex justify-between items-center py-3 px-4">
                    <!-- Back Button -->
                    <button onclick="goBack()"
                        class="flex items-center gap-2 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                        <i class="ri-arrow-left-line"></i> Back
                    </button>

                    <div class="flex">
                        <!-- Add to Cart Button -->
                        <button id="addToCart"
                            class="flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-l hover:bg-blue-600 transition">
                            <i class="ri-shopping-cart-line block sm:hidden"></i> Add to Cart
                        </button>
                        <!-- Buy Now Button -->
                        <button id="buyNow"
                            class="flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded-r hover:bg-green-600 transition">
                            <i class="ri-money-dollar-circle-line block sm:hidden"></i> Buy Now
                        </button>
                    </div>
                </div>
            </div>

            <div id="bottomPanel"
                class="fixed rounded-t-md block md:hidden -bottom-40 bg-white z-50 w-full transition-all duration-500 ease-in-out">
                <div class="flex flex-row justify-between p-3 border-b">
                    <div class="flex flex-col gap-2">
                        <span class="text-xs text-gray-600 font-semibold">TYPE QUANTITY</span>
                        <input type="number" min="1" max="3" value="1"
                            class="rounded w-20 text-center py-1.5 border border-gray-300">
                    </div>
                    @if (!empty(json_decode($product->product_size)))
                        <div class="flex flex-col gap-2">
                            <span class="text-xs text-gray-600 font-semibold">SELECT COLOR</span>
                            <div class="flex flex-row gap-2">
                                <input type="radio" id="red" name="color[]" value="Red"
                                    class="hidden peer/red">
                                <label for="red"
                                    class="px-3 py-1.5 text-sm rounded cursor-pointer text-white bg-gray-400 hover:bg-red-500 peer-checked/red:bg-red-600">
                                    Red
                                </label>

                                <input type="radio" id="blue" name="color[]" value="Blue"
                                    class="hidden peer/blue">
                                <label for="blue"
                                    class="px-3 py-1.5 text-sm rounded cursor-pointer text-white bg-gray-400 hover:bg-blue-500 peer-checked/blue:bg-blue-600">
                                    Blue
                                </label>

                                <input type="radio" id="green" name="color[]" value="Green"
                                    class="hidden peer/green">
                                <label for="green"
                                    class="px-3 py-1.5 text-sm rounded cursor-pointer text-white bg-gray-400 hover:bg-green-500 peer-checked/green:bg-green-600">
                                    Green
                                </label>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="p-3">
                    <button class="text-white bg-green-600 rounded w-full py-2 text-center">Confrim</button>
                </div>
            </div>
        </div>

        <div class="w-full my-4 md:p-6 px-2 py-6 bg-white rounded">
            <div class="mb-6 border-b pb-4">
                <h2 class="text-xl text-gray-800 font-semibold">Rating & Review</h2>
            </div>
            <div class="mb-6">
                <div class="flex items-center space-x-1">
                    <h2 class="text-3xl text-gray-800 font-bold">4.5</h2>
                    <div class="flex items-center space-x-1">
                        <i class="ri-star-fill text-yellow-400"></i>
                        <span class="text-gray-600">Excellent</span>
                    </div>
                </div>
                <div class="flex space-x-1 mt-1">
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-half-line text-yellow-400"></i>
                </div>
                <p class="text-gray-600 mt-1">100 Ratings</p>
            </div>
            <div class="space-y-0.5">
                <div class="flex items-center space-x-2">
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <span class="ml-auto text-gray-600">50</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-line text-gray-300"></i>
                    <span class="ml-auto text-gray-600">30</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-fill text-yellow-400"></i>
                    <i class="ri-star-line text-gray-300"></i>
                    <i class="ri-star-line text-gray-300"></i>
                    <span class="ml-auto text-gray-600">15</span>
                </div>
            </div>
            <div class="mt-6">
                <h3 class="text-lg text-gray-800 font-semibold mb-4">Customer Reviews</h3>
                <div class="flex flex-col gap-2">
                    <div class="p-4 border rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex space-x-1">
                                <i class="ri-star-fill text-yellow-400"></i>
                                <i class="ri-star-fill text-yellow-400"></i>
                                <i class="ri-star-fill text-yellow-400"></i>
                                <i class="ri-star-fill text-yellow-400"></i>
                                <i class="ri-star-half-line text-yellow-400"></i>
                            </div>
                            <span class="text-gray-500 text-sm">2 days ago</span>
                        </div>
                        <p class="text-gray-700 font-medium">Great product, highly recommend!</p>
                        <div class="mt-2">
                            <img class="w-20 h-20 rounded-lg object-cover"
                                src="{{ asset('Image/Product/product1.jpg') }}" alt="Review image">
                        </div>
                    </div>
                    <div class="p-4 border rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex space-x-1">
                                <i class="ri-star-fill text-yellow-400"></i>
                                <i class="ri-star-fill text-yellow-400"></i>
                                <i class="ri-star-fill text-yellow-400"></i>
                                <i class="ri-star-fill text-yellow-400"></i>
                                <i class="ri-star-half-line text-yellow-400"></i>
                            </div>
                            <span class="text-gray-500 text-sm">2 days ago</span>
                        </div>
                        <p class="text-gray-700 font-medium">Great product, highly recommend!</p>
                        <div class="mt-2">
                            <img class="w-20 h-20 rounded-lg object-cover"
                                src="{{ asset('Image/Product/product3.jpg') }}" alt="Review image">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Product grid section -->
        <div class="grid md:grid-cols-5 grid-cols-2 md:px-0 md:py-4 xl:px-0 2xl:px-0 px-1 py-1 pb-2 gap-2">
            @if (!empty($products) && $products->count() > 0)
                @foreach ($products as $product)
                    <a href="{{ route('product.details', $product->id) }}"
                        class="col-span-1 block border rounded overflow-hidden shadow hover:shadow-xl transition-all duration-500 ease-in-out">
                        <div class="w-full">
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="">
                        </div>
                        <div class="flex flex-col px-1 py-0.5">
                            <div class="flex items-center justify-between">
                                <span class="text-orange-700">&#2547;{{ $product->product_price }}.00</span>
                                <div class="flex px-1 text-gray-700 text-xl hover:text-indigo-500">
                                    <i class="ri-shopping-cart-line"></i>
                                </div>
                            </div>
                            <span class="line-clamp-2 text-sm text-gray-700">
                                {{ $product->product_name }}
                            </span>
                            <div class="flex flex-row gap-0.5 text-[15px] text-orange-500">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-line"></i>
                                <i class="ri-star-line"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="col-span-full text-center py-5">
                    <p class="text-gray-700">Products not found</p>
                </div>
            @endif
        </div>

        <nav aria-label="Page navigation example" class="mb-2 flex justify-center">
            <ul class="inline-flex -space-x-px text-base h-10">
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            </ul>
        </nav>

    </div>

    <div class="mb-16 md:m-0">
        @include('frontend.layouts.footer')
    </div>
    <script>
        const bottomPanel = document.getElementById("bottomPanel");
        const addToCartBtn = document.getElementById("addToCart");
        const buyNowBtn = document.getElementById("buyNow");

        function showPanel(event) {
            bottomPanel.classList.remove("-bottom-40");
            bottomPanel.classList.add("bottom-0");

            event.stopPropagation();
        }

        addToCartBtn.addEventListener("click", showPanel);
        buyNowBtn.addEventListener("click", showPanel);

        document.body.addEventListener("click", function() {
            bottomPanel.classList.remove("bottom-0");
            bottomPanel.classList.add("-bottom-40");
        });

        bottomPanel.addEventListener("click", function(event) {
            event.stopPropagation();
        });

        const mainImg = document.getElementById("mainImg");
        const thumbnails = document.querySelectorAll("#thumbnailContainer img");

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener("click", function() {
                mainImg.src = this.dataset.src;

                thumbnails.forEach(img => img.classList.remove("border-blue-500"));

                this.classList.add("border-blue-500");
            });
        });

        const scrollAmount = 64;
        const leftArrow = document.getElementById("leftArrow");
        const rightArrow = document.getElementById("rightArrow");
        const thumbnailContainer = document.getElementById("thumbnailContainer");

        function checkScroll() {
            const maxScrollLeft = thumbnailContainer.scrollWidth - thumbnailContainer.clientWidth;

            if (thumbnailContainer.scrollLeft <= 0) {
                leftArrow.style.display = "none";
            } else {
                leftArrow.style.display = "flex";
            }

            if (thumbnailContainer.scrollLeft >= maxScrollLeft) {
                rightArrow.style.display = "none";
            } else {
                rightArrow.style.display = "flex";
            }

            if (maxScrollLeft <= 0) {
                leftArrow.style.display = "none";
                rightArrow.style.display = "none";
            }
        }

        thumbnailContainer.addEventListener("scroll", checkScroll);

        window.addEventListener("resize", checkScroll);

        leftArrow.addEventListener("click", () => {
            thumbnailContainer.scrollBy({
                left: -scrollAmount,
                behavior: "smooth"
            });
        });

        rightArrow.addEventListener("click", () => {
            thumbnailContainer.scrollBy({
                left: scrollAmount,
                behavior: "smooth"
            });
        });

        window.addEventListener("load", checkScroll);

        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
