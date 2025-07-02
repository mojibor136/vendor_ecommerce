@include('frontend.layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: 'Roboto', sans-serif;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto lg:mt-4 m-0 px-4">
        <div class="hidden lg:block ">
            <div class=w-full relative overflow-hidden">
                <div class="owl-carousel owl-theme banner-carousel">
                    @foreach ($mainSliders as $banner)
                        <a class="block rounded shadow-lg item" href="{{ $banner->link }}">
                            <img src="{{ asset('storage/' . $banner->images) }}" alt="Main Banner"
                                class="w-full h-full object-cover rounded-lg">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="lg:hidden grid grid-cols-1 gap-2 px-2 py-2 relative">
        <div class="owl-carousel owl-theme banner-carousel">
            @foreach ($mainSliders as $banner)
                <a class="block h-60 rounded shadow-lg item" href="{{ $banner->link }}">
                    <img src="{{ asset('storage/' . $banner->images) }}" alt="Main Banner"
                        class="w-full h-full object-cover rounded-lg">
                </a>
            @endforeach
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-2 lg:px-4 my-3">
        <div class="sm:hidden flex overflow-x-auto gap-4 mb-3 py-2 scrollbar-hide">
            <a href="/free-delivery"
                class="flex-shrink-0 w-48 flex items-center gap-2 border rounded-3xl py-1.5 px-1.5 transition-all duration-300 hover:shadow-lg hover:bg-green-50 group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-green-600 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-green-700">
                    <i class="ri-truck-line"></i>
                </div>
                <span class="text-sm text-gray-700 group-hover:text-green-700 transition-colors duration-300">
                    Free Delivery
                </span>
            </a>

            <a href="/top-stores"
                class="flex-shrink-0 w-48 flex items-center gap-2 border rounded-3xl py-1.5 px-1.5 transition-all duration-300 hover:shadow-lg hover:bg-blue-50 group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-blue-600 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-blue-700">
                    <i class="ri-store-2-line"></i>
                </div>
                <span class="text-sm text-gray-700 group-hover:text-blue-700 transition-colors duration-300">
                    Top Stores
                </span>
            </a>

            <a href="/top-products"
                class="flex-shrink-0 w-48 flex items-center gap-2 border rounded-3xl py-1.5 px-1.5 transition-all duration-300 hover:shadow-lg hover:bg-yellow-50 group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-yellow-500 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-yellow-600">
                    <i class="ri-star-line"></i>
                </div>
                <span class="text-sm text-gray-700 group-hover:text-yellow-600 transition-colors duration-300">
                    Top Products
                </span>
            </a>

            <a href="/support"
                class="flex-shrink-0 w-48 flex items-center gap-2 border rounded-3xl py-1.5 px-1.5 transition-all duration-300 hover:shadow-lg hover:bg-red-50 group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-red-500 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-red-600">
                    <i class="ri-customer-service-2-line"></i>
                </div>
                <span class="text-sm text-gray-700 group-hover:text-red-600 transition-colors duration-300">
                    24/7 Support
                </span>
            </a>

            <a href="/return-policy"
                class="flex-shrink-0 w-48 flex items-center gap-2 border rounded-3xl py-1.5 px-1.5 transition-all duration-300 hover:shadow-lg hover:bg-pink-50 group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-pink-600 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-pink-700">
                    <i class="ri-refresh-line"></i>
                </div>
                <span class="text-sm text-gray-700 group-hover:text-pink-700 transition-colors duration-300">
                    Easy Returns
                </span>
            </a>
        </div>

        <div
            class="hidden sm:grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-5 gap-2 mb-4 mt-2">
            <a href="/free-delivery"
                class="flex items-center gap-2 border rounded-3xl py-2 px-2 transition-all duration-300 hover:shadow-lg group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-green-600 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-green-700">
                    <i class="ri-truck-line"></i>
                </div>
                <span class="text-base text-gray-700 group-hover:text-green-700 transition-colors duration-300">
                    Free Delivery
                </span>
            </a>

            <a href="/top-stores"
                class="flex items-center gap-2 border rounded-3xl py-2 px-2 transition-all duration-300 hover:shadow-lg group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-blue-600 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-blue-700">
                    <i class="ri-store-2-line"></i>
                </div>
                <span class="text-base text-gray-700 group-hover:text-blue-700 transition-colors duration-300">
                    Top Stores
                </span>
            </a>

            <a href="/top-products"
                class="flex items-center gap-2 border rounded-3xl py-2 px-2 transition-all duration-300 hover:shadow-lg group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-yellow-500 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-yellow-600">
                    <i class="ri-star-line"></i>
                </div>
                <span class="text-base text-gray-700 group-hover:text-yellow-600 transition-colors duration-300">
                    Top Products
                </span>
            </a>

            <a href="/support"
                class="flex items-center gap-2 border rounded-3xl py-2 px-2 transition-all duration-300 hover:shadow-lg group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-red-500 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-red-600">
                    <i class="ri-customer-service-2-line"></i>
                </div>
                <span class="text-base text-gray-700 group-hover:text-red-600 transition-colors duration-300">
                    24/7 Support
                </span>
            </a>

            <a href="/return-policy"
                class="flex items-center gap-2 border rounded-3xl py-2 px-2 transition-all duration-300 hover:shadow-lg group">
                <div
                    class="w-8 h-8 text-sm rounded-full bg-pink-600 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-pink-700">
                    <i class="ri-refresh-line"></i>
                </div>
                <span class="text-base text-gray-700 group-hover:text-pink-700 transition-colors duration-300">
                    Easy Returns
                </span>
            </a>
        </div>


        <div class="flex items-center justify-between py-3 md:py-4">
            <h2 class="text-lg lg:text-xl font-bold text-gray-700">Top Seller</h2>
        </div>

        <div class="owl-carousel owl-theme seller-carousel relative h-[125px] mb-8">
            @foreach ($topShops as $shop)
                <a href="#"
                    class="mr-1 bg-white rounded border border-gray-100 p-4 flex flex-col items-center transition duration-300">
                    <div class="w-16 h-16 mb-2">
                        <img src="{{ asset('storage/' . $shop->shop_logo) }}" alt="{{ $shop->shop_name }}"
                            class="w-full h-full object-cover rounded-full" loading="lazy">
                    </div>
                    <p class="text-center font-medium text-gray-800 text-sm">{{ $shop->shop_name }}</p>
                </a>
            @endforeach
        </div>

        <div class="flex items-center justify-between py-3 md:py-4">
            <h2 class="font-semibold text-gray-800 text-xl">Top Categories</h2>
        </div>
        <div id="category-wrapper" class="grid grid-cols-4 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 mb-10">
            @foreach ($topCategories as $category)
                <a href="#"
                    class="category-card bg-white shadow p-4 flex flex-col items-center hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $category->category_img) }}" alt="Skin Care"
                        class="md:w-20 md:h-20 h-16 w-16 object-cover rounded-full mb-2" loading="lazy">
                    <p class="text-center font-medium text-gray-800">{{ $category->category_name }}</p>
                </a>
            @endforeach
        </div>

        <section class="py-6 bg-gray-50">
            <div class="flex justify-between items-center mb-6">
                <span class="font-semibold text-gray-800 text-xl">Hot Deals</span>

                <div class="flex space-x-2 text-white text-sm md:text-base">
                    <div class="bg-indigo-500 px-3 py-1 rounded text-center">
                        <span id="days" class="font-bold text-sm">04</span>
                    </div>
                    <div class="bg-purple-500 px-3 py-1 rounded text-center">
                        <span id="hours" class="font-bold text-sm">05</span>
                    </div>
                    <div class="bg-pink-500 px-3 py-1 rounded text-center">
                        <span id="minutes" class="font-bold text-sm">59</span>
                    </div>
                </div>
            </div>

            <div class="owl-carousel owl-theme hot relative">
                @foreach ($products as $product)
                    <div class="bg-white p-2.5 rounded shadow hover:shadow-lg" data-aos="fade-up"
                        data-aos-delay="100">
                        <img src="{{ asset('storage/' . $product->product_image) }}" loading="lazy"
                            alt="Wireless Headphones" class="w-full mb-2 rounded-lg object-cover h-48">
                        <h4 class="text-gray-800 text-sm">{{ $product->product_name }}</h4>
                        <p class="text-indigo-600 font-semibold mb-1.5 text-base">${{ $product->product_price }}</p>
                        <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 text-sm">Add to
                            Cart</button>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="py-6 bg-gray-50">
            <h3 class="font-semibold text-gray-800 text-xl mb-6">Products</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-x-2 gap-y-4">
                @foreach ($products as $product)
                    <div class="bg-white p-2.5 rounded shadow hover:shadow-lg" data-aos="fade-up"
                        data-aos-delay="100">
                        <img src="{{ asset('storage/' . $product->product_image) }}" loading="lazy"
                            alt="Wireless Headphones" class="w-full mb-2 rounded-lg object-cover h-48">
                        <h4 class="text-gray-800 text-sm">{{ $product->product_name }}</h4>
                        <p class="text-indigo-600 font-semibold text-base">${{ $product->product_price }}</p>
                        <div class="mb-2 flex items-center gap-1">
                            <div class="flex items-center space-x-0.5 text-yellow-400 text-sm">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-line"></i>
                            </div>
                            <span class="text-xs text-gray-500">(12)</span>
                        </div>
                        <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 text-sm">Add to
                            Cart</button>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="py-6 bg-gray-50">
            <h3 class="font-semibold text-gray-800 text-xl mb-6">Featured Products</h3>
            <div class="grid md:grid-cols-5 grid-cols-2 gap-x-2 gap-y-4">
                @foreach ($products as $product)
                    <a href="{{ route('frontend.products.show', ['product' => $product->slug, 'id' => $product->id]) }}"
                        class="col-span-1 p-1.5 block bg-white rounded overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 ease-in-out">
                        <div class="w-full">
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Image"
                                loading="lazy" class="w-full h-auto object-cover">
                        </div>
                        <div class="flex flex-col px-1 py-2 space-y-1">
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-blue-600 text-base font-semibold leading-[normal]">৳
                                    {{ $product->product_price }}
                                </span>

                                <div class="flex items-center gap-1">
                                    <button
                                        class="flex items-center gap-1 border border-[#0f4c81] w-[28px] h-[28px] flex items-center justify-center rounded bg-[#0f4c81] text-white transition">
                                        <i class="ri-shopping-cart-line text-sm"></i>
                                    </button>
                                </div>
                            </div>

                            <span
                                class="line-clamp-2 text-sm text-gray-700 hover:text-[#0f4c81] transition">{{ $product->product_name }}</span>

                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex gap-0.5 text-yellow-400 text-sm">
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-fill"></i>
                                    <i class="ri-star-line"></i>
                                    <i class="ri-star-line"></i>
                                </div>
                                <span class="text-xs text-gray-500">(12)</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>

</body>

</html>
@include('frontend.layouts.footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $('.banner-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 1000,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            },
            navText: [
                '<button class="bg-black/30 text-gray-400 flex items-center justify-center w-10 h-10 rounded-full absolute left-2 top-1/2 -translate-y-1/2 z-10 hover:bg-black/60 transition"><i class="ri-arrow-left-s-line text-2xl"></i></button>',
                '<button class="bg-black/30 text-gray-400 flex items-center justify-center w-10 h-10 rounded-full absolute right-2 top-1/2 -translate-y-1/2 z-10 hover:bg-black/60 transition"><i class="ri-arrow-right-s-line text-2xl"></i></button>'
            ]
        });

        $('.seller-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 2000,
            smartSpeed: 1000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 3
                },
                480: {
                    items: 4
                },
                768: {
                    items: 6
                },
                1024: {
                    items: 8
                }
            },
            navText: [
                '<button class="bg-black/10 text-gray-200 flex items-center justify-center w-10 h-10 rounded-full absolute left-2 top-1/2 -translate-y-1/2 z-10 hover:bg-black/30 transition"><i class="ri-arrow-left-s-line text-2xl"></i></button>',
                '<button class="bg-black/10 text-gray-200 flex items-center justify-center w-10 h-10 rounded-full absolute right-2 top-1/2 -translate-y-1/2 z-10 hover:bg-black/30 transition"><i class="ri-arrow-right-s-line text-2xl"></i></button>'
            ]
        });

        $('.hot').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplaySpeed: 2000,
            smartSpeed: 1000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                480: {
                    items: 3
                },
                768: {
                    items: 5
                },
                1024: {
                    items: 5
                }
            },
        });

    });
</script>

<script>
    function filterCategoriesByScreenSize() {
        const cards = document.querySelectorAll('.category-card');
        const screenWidth = window.innerWidth;
        let maxItems = 16;

        if (screenWidth < 640) {
            maxItems = 8;
        } else if (screenWidth < 768) {
            maxItems = 8;
        } else if (screenWidth < 1024) {
            maxItems = 12;
        }

        cards.forEach((card, index) => {
            card.style.display = index < maxItems ? 'flex' : 'none';
        });
    }

    filterCategoriesByScreenSize();

    window.addEventListener('resize', filterCategoriesByScreenSize);
</script>
