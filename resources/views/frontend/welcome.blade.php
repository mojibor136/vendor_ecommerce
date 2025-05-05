@include('frontend.layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('remixicon/remixicon.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
</style>

<body class="bg-gray-50">
    <!-- Banner Section -->
    <div class="max-w-7xl mx-auto lg:mt-4 m-0 px-4">
        <!-- Desktop view with 3 banners -->
        <div class="hidden lg:block ">
            <div class="grid grid-cols-6 gap-2">
                <div class="col-span-4">
                    <!-- Main Banner -->
                    <div class="bg-blue-600 rounded shadow-lg">
                        <img src="{{ asset('banner/main.png') }}" alt="Main Banner"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                </div>
                <div class="col-span-2 flex flex-col gap-2">
                    <!-- Sub Banner 1 -->
                    <div class="bg-red-600 rounded shadow-lg">
                        <img src="{{ asset('banner/sub1.png') }}" alt="Sub Banner 1"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                    <!-- Sub Banner 2 -->
                    <div class="bg-yellow-600 rounded shadow-lg">
                        <img src="{{ asset('banner/sub.png') }}" alt="Sub Banner 2"
                            class="w-full h-full object-cover rounded-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile view with 1 banner -->
    <div class="lg:hidden grid grid-cols-1 gap-2 px-2 py-2">
        <div class="bg-blue-600 h-60 rounded shadow-lg">
            <img src="{{ asset('banner/main.png') }}" alt="Main Banner" class="w-full h-full object-cover rounded-lg">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-2 lg:px-4 my-6">
        <!-- Categories grid section -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-700">Shops</h2>
            <a href="" class="text-sm text-gray-700 hover:underline inline-flex items-center">
                See More <i class="ri-arrow-right-line ml-1 text-base"></i>
            </a>
        </div>
        <div id="shop-wrapper" class="flex overflow-x-auto space-x-3 mb-10">
            @foreach ($topShops as $shop)
                <a href="#"
                    class="min-w-[100px] flex-shrink-0 bg-white shadow rounded p-4 flex flex-col items-center hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $shop->shop_logo) }}" alt="{{ $shop->shop_name }}"
                        class="w-20 h-20 object-cover rounded-full mb-2" loading="lazy">
                    <p class="text-center font-medium text-gray-800 text-sm">{{ $shop->shop_name }}</p>
                </a>
            @endforeach
        </div>

        <!-- Categories grid section -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-bold text-gray-700">Categories</h2>
            <a href="" class="text-sm text-gray-700 hover:underline inline-flex items-center">
                See More <i class="ri-arrow-right-line ml-1 text-base"></i>
            </a>
        </div>
        <div id="category-wrapper" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 mb-10">
            @foreach ($topCategories as $category)
                <a href="#"
                    class="category-card bg-white border-[0.5px] border-gray-100 shadow p-4 flex flex-col items-center hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $category->category_img) }}" alt="Skin Care"
                        class="w-20 h-20 object-cover rounded-full mb-2" loading="lazy">
                    <p class="text-center font-medium text-gray-800">{{ $category->category_name }}</p>
                </a>
            @endforeach
        </div>


        <!-- Product grid section -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl lg:text-2xl font-bold text-gray-700">Featured Products</h2>
            <a href="" class="text-sm text-gray-700 hover:underline inline-flex items-center">
                See More <i class="ri-arrow-right-line ml-1 text-base"></i>
            </a>
        </div>
        <div class="grid md:grid-cols-5 grid-cols-2 gap-3">
            <a href="#"
                class="col-span-1 block bg-white rounded overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 ease-in-out">
                <div class="w-full">
                    <img src="{{ asset('product/product1.jpg') }}" alt="Product Image"
                        class="w-full h-auto object-cover">
                </div>
                <div class="flex flex-col px-1 py-2 space-y-1">
                    <!-- Price & Sold -->
                    <div class="flex items-center justify-between">
                        <span class="text-blue-600 text-lg font-semibold leading-[normal]">৳ 420.00</span>

                        <!-- Buttons: Wishlist + Cart -->
                        <div class="flex items-center gap-1">
                            <!-- Wishlist Button (Pink) -->
                            <button
                                class="flex items-center gap-1 text-red-500 border border-red-500 px-1.5 py-0.5 rounded hover:bg-red-500 hover:text-white transition">
                                <i class="ri-heart-line text-base"></i>
                            </button>

                            <!-- Add to Cart Button (Blue) -->
                            <button
                                class="flex items-center gap-1 text-[#0f4c81] border border-[#0f4c81] px-1.5 py-0.5 rounded hover:bg-[#0f4c81] hover:text-white transition">
                                <i class="ri-shopping-cart-line text-base"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Title -->
                    <span class="line-clamp-2 text-sm text-gray-700 hover:text-[#0f4c81] transition">
                        Nature Leaf Ramadan Eid Special Combo | Elach 25gm, Lobonngo 50g, Daruchini 100g | Cardamom 25g,
                        Clove 50g, Cinnamon Whole 100g
                    </span>

                    <!-- Star Rating -->
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
        </div>
    </div>

</body>

</html>
@include('frontend.layouts.footer')
<script>
    function filterCategoriesByScreenSize() {
        const cards = document.querySelectorAll('.category-card');
        const screenWidth = window.innerWidth;
        let maxItems = 16;

        if (screenWidth < 640) {
            maxItems = 6;
        } else if (screenWidth < 768) {
            maxItems = 8;
        } else if (screenWidth < 1024) {
            maxItems = 12;
        }

        cards.forEach((card, index) => {
            card.style.display = index < maxItems ? 'flex' : 'none';
        });
    }

    // Initial call
    filterCategoriesByScreenSize();

    // Recalculate on resize
    window.addEventListener('resize', filterCategoriesByScreenSize);
</script>
