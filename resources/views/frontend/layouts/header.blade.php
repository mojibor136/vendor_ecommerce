<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    input:-webkit-autofill {
        background-color: transparent !important;
        -webkit-box-shadow: 0 0 0 1000px white inset !important;
        -webkit-text-fill-color: #000 !important;
    }

    .filter-btn.active {
        background-color: #0f4c81;
        color: white;
    }
</style>

<body>
    <div class="bg-gray-50 text-sm text-gray-700 border-b hidden md:block">
        <div class="max-w-7xl mx-auto px-4 py-1.5 flex items-center justify-between">
            <!-- Left Info -->
            <div class="flex items-center gap-3">
                <span class="text-blue-600 font-medium"><i class="ri-phone-line mr-1"></i> +45 7142 1852</span>
                <span class="hidden sm:block text-gray-500">|</span>
                <span class="hidden sm:block text-gray-600">Welcome to our shop!</span>
            </div>

            <!-- Right Navigation -->
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-blue-600 transition">Reseller</a>
                <a href="#" class="hover:text-blue-600 transition">Become a Seller</a>
                <a href="#" class="hover:text-blue-600 transition">Help Center</a>
                <a href="#" class="hover:text-blue-600 transition">Register</a>
                <a href="#" class="hover:text-blue-600 transition">Login</a>

                <span class="leading-[normal] text-sm">EN</span>
            </div>
        </div>
    </div>
    <!-- Header -->
    <header class="bg-[#0f4c81] text-white py-4 shadow-md">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center gap-2">
                <i class="ri-store-2-line text-2xl"></i>
                <span class="text-xl font-semibold">ShopZone</span>
            </div>

            <!-- Search Bar 1 -->
            <div class="hidden md:block relative">
                <div id="searchIn1"
                    class="flex items-center rounded-t-md rounded-b-md w-[480px] h-11 bg-white shadow-sm px-3 border border-gray-300 focus-within:ring-1 focus-within:ring-gray-200 transition">
                    <i class="ri-search-line text-gray-600"></i>
                    <input id="searchBox1" type="text" placeholder="Search..."
                        oninput="searchItems(this.value, 'results1')"
                        class="flex-1 h-full w-full text-gray-700 bg-transparent border-none pl-2 outline-none focus:ring-0 focus:outline-none">
                    <i onclick="toggleFilter()"
                        class="ri-equalizer-line text-gray-600 cursor-pointer hover:text-gray-800"></i>
                </div>
                <div id="results1" class="absolute w-full shadow-md bg-white rounded-b-md z-10 hidden">
                </div>
            </div>

            <!-- Filter Modal -->
            <div id="filterModal"
                class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg w-80 shadow-lg">
                    <h2 class="text-lg font-semibold mb-4">Select Filter</h2>
                    <div class="flex flex-col gap-2">
                        <button onclick="updateModel('products')"
                            class="filter-btn p-2 text-left text-gray-700 border rounded-md hover:bg-gray-100">Products</button>
                        <button onclick="updateModel('categories')"
                            class="filter-btn p-2 text-left text-gray-700 border rounded-md hover:bg-gray-100">Categories</button>
                        <button onclick="updateModel('sellers')"
                            class="filter-btn p-2 text-left text-gray-700 border rounded-md hover:bg-gray-100">Sellers</button>
                    </div>
                    <div class="mt-4 text-right">
                        <button onclick="toggleFilter()" class="text-white py-2 px-4 bg-blue-500 rounded">Close</button>
                    </div>
                </div>
            </div>

            <!-- Icons -->
            <div class="flex items-center gap-8 text-white">
                <!-- Cart -->
                <button class="relative hover:text-[#ffd700] transition">
                    <i class="ri-shopping-cart-line text-xl"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 rounded-full font-bold">5</span>
                </button>

                <!-- Account -->
                <button class="hover:text-[#ffd700] transition">
                    <i class="ri-user-line text-xl"></i>
                </button>

            </div>
        </div>

        <!-- Mobile Search Bar -->
        <div class="md:hidden relative px-2 mt-2">
            <div id="searchIn2"
                class="flex items-center rounded-t-md rounded-b-md w-full h-11 bg-white shadow-sm px-3 border border-gray-300 focus-within:ring-1 focus-within:ring-gray-200 transition">
                <i class="ri-search-line text-gray-600"></i>
                <input id="searchBox2" type="text" placeholder="Search..."
                    oninput="searchItems(this.value, 'results2')"
                    class="flex-1 h-full w-full text-gray-700 bg-transparent border-none pl-2 outline-none focus:ring-0 focus:outline-none">
                <i onclick="toggleFilter()"
                    class="ri-equalizer-line text-gray-600 cursor-pointer hover:text-gray-800"></i>
            </div>
            <div id="results2"
                class="absolute top-full left-0 w-full shadow-md bg-white rounded-b-lg z-10 hidden mx-2 box-content">
            </div>
        </div>
    </header>

    <nav id="navbar" class="bg-white shadow-sm md:block hidden shadow border-b border-gray-50">
        <div class="max-w-7xl mx-auto px-4 flex items-center gap-6 py-3 justify-between">

            <div class="relative">
                <!-- Button with dropdown together in one group -->
                <div class="group inline-block relative">
                    <!-- Category Button -->
                    <div
                        class="flex items-center gap-1 border border-[#0f4c81] text-[#0f4c81] px-3 py-1.5 rounded overflow-hidden cursor-pointer relative">
                        <!-- Background Animation Layer -->
                        <span
                            class="absolute inset-0 w-0 bg-[#0f4c81] transition-all duration-300 group-hover:w-full rounded"></span>
                        <div
                            class="relative flex items-center gap-1 z-10 text-[#0f4c81] group-hover:text-white transition">
                            <i class="ri-grid-fill text-base"></i>
                            <span class="font-medium leading-none text-sm">All Categories</span>
                            <i class="ri-arrow-down-s-line text-base"></i>
                        </div>
                    </div>

                    <!-- Dropdown List -->
                    <div
                        class="absolute left-0 top-full w-60 z-20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200">
                        <div class="mt-3.5 bg-white shadow-lg border border-gray-100 rounded">
                            <ul class="text-gray-700 text-base">
                                @foreach ($categories as $category)
                                    <li class="relative category-item group">
                                        <a href="#"
                                            class="flex items-center justify-between gap-3 px-4 py-2 hover:bg-gray-200 cursor-pointer transition">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full overflow-hidden bg-white flex-shrink-0">
                                                    <img src="{{ asset('storage/' . $category->category_img) }}"
                                                        alt="Category" class="w-full h-full object-cover">
                                                </div>
                                                <span
                                                    class="text-gray-800 font-medium">{{ $category->category_name }}</span>
                                            </div>
                                            <i class="ri-arrow-right-s-line text-gray-400 text-lg flex-shrink-0"></i>
                                        </a>

                                        <!-- Subcategory Dropdown -->
                                        @if ($category->subcategory->isNotEmpty())
                                            <div
                                                class="subcategory-menu absolute top-0 left-full w-60 bg-white shadow-lg border border-gray-100 rounded-r hidden">
                                                <ul>
                                                    @foreach ($category->subcategory as $subcategory)
                                                        <a href="#"
                                                            class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                                            <li>{{ $subcategory->subcategory_name }}</li>
                                                        </a>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-6 text-[#0f4c81] font-medium text-sm">
                <a href="{{ url('/') }}" class="relative group hover:text-[#0056a3] transition">
                    Home
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#0056a3] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#" class="relative group hover:text-[#0056a3] transition">
                    Shop
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#0056a3] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#" class="relative group hover:text-[#0056a3] transition">
                    Today's Products
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#0056a3] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#" class="relative group hover:text-[#0056a3] transition">
                    Hot Deals
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#0056a3] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="#" class="relative group hover:text-[#0056a3] transition">
                    Best Sellers
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#0056a3] transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <!-- Become a Seller Button -->
            <a href="#"
                class="bg-[#0f4c81] text-white text-sm font-medium px-4 py-2 rounded hover:bg-[#0056a3] transition">
                Become a Seller
            </a>

        </div>
    </nav>
    <script>
        document.querySelectorAll('.category-item').forEach(function(item) {
            const submenu = item.querySelector('.subcategory-menu');

            if (submenu) {
                item.addEventListener('mouseenter', function() {
                    submenu.classList.remove('hidden');
                });

                item.addEventListener('mouseleave', function() {
                    submenu.classList.add('hidden');
                });
            }
        });
    </script>

    <script>
        let hasScrolledAbove100 = null;
        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 100 && hasScrolledAbove100 !== true) {
                navbar.classList.add('fixed', 'top-0', 'right-0', 'w-full', 'z-50', 'shadow-lg');
                hasScrolledAbove100 = true;
            } else if (window.scrollY <= 100 && hasScrolledAbove100 !== false) {
                navbar.classList.remove('fixed', 'top-0', 'right-0', 'w-full', 'z-50', 'shadow-lg');
                hasScrolledAbove100 = false;
            }
        });
    </script>

    <script>
        let data = {
            products: [],
            categories: [],
            sellers: []
        };

        let selectedModel = 'products';

        function toggleFilter() {
            const modal = document.getElementById('filterModal');
            modal.classList.toggle('hidden');
        }

        function updateModel(model) {
            selectedModel = model;
            searchItems(document.getElementById('searchBox1').value, 'results1');
            searchItems(document.getElementById('searchBox2').value, 'results2');

            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(button => {
                button.classList.remove('active');
                if (button.textContent.toLowerCase() === model) {
                    button.classList.add('active');
                }
            });

            toggleFilter();
        }

        async function searchItems(query, resultContainerId) {
            const resultBox = document.getElementById(resultContainerId);
            const searchIn = resultBox.previousElementSibling;
            resultBox.innerHTML = '';

            searchIn.classList.add('rounded-t-md');

            if (query.trim() === '') {
                searchIn.classList.remove('border-none');
                resultBox.classList.add('hidden');
                searchIn.classList.add('rounded-b-md');
                searchIn.classList.remove('focus-within:ring-0');
                searchIn.classList.add('focus-within:ring-1');
                return;
            }

            try {
                const res = await fetch('/search-data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        query: query,
                        model: selectedModel,
                    })
                });

                const json = await res.json();

                const filtered = json[selectedModel] || [];

                if (filtered.length > 0) {
                    searchIn.classList.add('border-none');
                    searchIn.classList.remove('focus-within:ring-1');
                    searchIn.classList.add('focus-within:ring-0');
                    searchIn.classList.remove('rounded-b-md');
                    resultBox.classList.remove('hidden');

                    const totalDiv = document.createElement('div');
                    totalDiv.className = 'px-3 py-2.5 border-t border-gray-100';

                    const totalSpan = document.createElement('span');
                    totalSpan.textContent = `Search Results: ${filtered.length}`;
                    totalSpan.className = 'text-gray-400 text-sm';

                    totalDiv.appendChild(totalSpan);

                    resultBox.innerHTML = '';

                    filtered.forEach(item => {
                        const resultdiv = document.createElement('div');
                        const result = document.createElement('a');
                        const image = document.createElement('img');
                        const wrapper = document.createElement('div');

                        image.src = item.image || '/default.png';
                        image.alt = item.name.length > 50 ? item.name.slice(0, 50) + '...' : item.name;
                        image.className = 'w-8 h-8 rounded object-cover';

                        const rawName = item.name.length > 20 ? item.name.slice(0, 20) + '...' : item.name;

                        const slug = rawName
                            .toLowerCase()
                            .replace(/\s+/g, '-')
                            .replace(/[^\w\-]+/g, '')
                            .replace(/\-\-+/g, '-')
                            .replace(/^-+|-+$/g, '');

                        result.className =
                            'px-3 py-2 text-[14.5px] text-gray-700 hover:bg-gray-100 flex items-center gap-2';
                        result.href = `/${selectedModel}/${slug}/${item.id}`;

                        const span = document.createElement('span');
                        span.textContent = item.name.length > 50 ? item.name.slice(0, 50) + '...' : item.name;

                        result.appendChild(image);
                        result.appendChild(span);

                        resultdiv.appendChild(result);
                        resultBox.appendChild(resultdiv);
                    });


                    resultBox.appendChild(totalDiv);

                } else {
                    searchIn.classList.remove('border-none');
                    resultBox.classList.add('hidden');
                    searchIn.classList.add('rounded-b-md');
                    searchIn.classList.remove('focus-within:ring-0');
                    searchIn.classList.add('focus-within:ring-1');
                }

            } catch (error) {
                console.error('Failed to fetch search data:', error);
            }
        }
    </script>

</body>

</html>
