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
<script>
    const data = {
        products: [{
                name: 'Apple'
            },
            {
                name: 'Banana'
            },
            {
                name: 'Cherry'
            },
            {
                name: 'Date'
            }
        ],
        categories: [{
                name: 'Fruits'
            },
            {
                name: 'Vegetables'
            },
            {
                name: 'Dairy'
            }
        ],
        sellers: [{
                name: 'Fresh Market'
            },
            {
                name: 'Organic Store'
            },
            {
                name: 'Local Vendor'
            }
        ]
    };

    let selectedModel = 'products';

    // Modal Toggle Function
    function toggleFilter() {
        const modal = document.getElementById('filterModal');
        modal.classList.toggle('hidden');
    }

    // Update the selected model and update button styles
    function updateModel(model) {
        selectedModel = model;
        searchItems(document.getElementById('searchBox1').value, 'results1');
        searchItems(document.getElementById('searchBox2').value, 'results2');

        // Highlight the active filter button
        const buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(button => {
            button.classList.remove('active');
            if (button.textContent.toLowerCase() === model) {
                button.classList.add('active');
            }
        });

        // Close the modal after selection
        toggleFilter();
    }

    function searchItems(query, resultContainerId) {
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

        const filtered = data[selectedModel].filter(item => item.name.toLowerCase().includes(query.toLowerCase()));
        if (filtered.length > 0) {
            searchIn.classList.add('border-none');
            searchIn.classList.remove('focus-within:ring-1');
            searchIn.classList.add('focus-within:ring-0');
            searchIn.classList.remove('rounded-b-md');
            resultBox.classList.remove('hidden');
            // Pagination ডিভ তৈরি করুন
            const paginationDiv = document.createElement('div');
            paginationDiv.className = 'flex items-center justify-between p-2 border-t';

            // Total Data Div
            const totalDiv = document.createElement('div');
            totalDiv.className = 'flex items-center w-full';

            // Total count span
            const totalSpan = document.createElement('span');
            totalSpan.textContent = `Search Results: ${filtered.length}`;
            totalSpan.className = 'text-gray-400 text-sm';

            // Button Div
            const buttonDiv = document.createElement('div');
            buttonDiv.className = 'flex gap-2';

            // Left pagination button
            const leftBtn = document.createElement('button');
            leftBtn.innerHTML = '<i class="ri-arrow-left-s-line text-xl"></i>';
            leftBtn.className = 'h-9 w-9 bg-gray-100 text-gray-600 rounded hover:bg-gray-200';

            // Right pagination button
            const rightBtn = document.createElement('button');
            rightBtn.innerHTML = '<i class="ri-arrow-right-s-line text-xl"></i>';
            rightBtn.className = 'h-9 w-9 bg-gray-100 text-gray-600 rounded hover:bg-gray-200';

            // Button Div-এ বাটন অ্যাপেন্ড করুন
            buttonDiv.appendChild(leftBtn);
            buttonDiv.appendChild(rightBtn);

            // Total Div-এ Total Span যোগ করুন
            totalDiv.appendChild(totalSpan);

            // Pagination Div-এ Total Div এবং Button Div যোগ করুন
            paginationDiv.appendChild(totalDiv);
            paginationDiv.appendChild(buttonDiv);

            // ফলাফল ড্রপডাউন পরিষ্কার করুন
            resultBox.innerHTML = '';

            filtered.forEach(item => {
                const resultdiv = document.createElement('div');
                const result = document.createElement('a');

                result.className = 'px-3 py-2 text-gray-700 hover:bg-gray-100 block';
                result.textContent = item.name;
                result.href = '';

                resultdiv.className = 'flex flex-col gap-2';
                resultdiv.appendChild(result);

                resultBox.appendChild(resultdiv);
            });

            // লুপের বাইরে paginationDiv যোগ করুন
            resultBox.appendChild(paginationDiv);

        } else {
            searchIn.classList.remove('border-none');
            resultBox.classList.add('hidden');
            searchIn.classList.add('rounded-b-md');
            searchIn.classList.remove('focus-within:ring-0');
            searchIn.classList.add('focus-within:ring-1');
        }
    }
</script>

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
                class="flex items-center rounded-t-md rounded-b-md w-[450px] h-11 bg-white shadow-sm px-3 border border-gray-300 focus-within:ring-1 focus-within:ring-gray-200 transition">
                <i class="ri-search-line text-gray-600"></i>
                <input id="searchBox1" type="text" placeholder="Search..."
                    oninput="searchItems(this.value, 'results1')"
                    class="flex-1 h-full w-full text-gray-700 bg-transparent border-none pl-2 outline-none focus:ring-0 focus:outline-none">
                <i onclick="toggleFilter()"
                    class="ri-equalizer-line text-gray-600 cursor-pointer hover:text-gray-800"></i>
            </div>
            <div id="results1" class="absolute w-full bg-white border border-gray-300 rounded-b-md z-10 hidden">
            </div>
        </div>

        <!-- Filter Modal -->
        <div id="filterModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex justify-center items-center">
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

            <!-- Wishlist -->
            <button class="relative hover:text-[#ffd700] transition">
                <i class="ri-heart-line text-xl"></i>
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 rounded-full">3</span>
            </button>

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
            <input id="searchBox2" type="text" placeholder="Search..." oninput="searchItems(this.value, 'results2')"
                class="flex-1 h-full w-full text-gray-700 bg-transparent border-none pl-2 outline-none focus:ring-0 focus:outline-none">
            <i onclick="toggleFilter()" class="ri-equalizer-line text-gray-600 cursor-pointer hover:text-gray-800"></i>
        </div>
        <div id="results2"
            class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-b-lg z-10 hidden mx-2 box-content">
        </div>
    </div>
</header>

<!-- Category + Navigation Bar -->
<nav id="navbar" class="bg-white shadow-sm md:block hidden shadow border-b border-gray-50">
    <div class="max-w-7xl mx-auto px-4 flex items-center gap-6 py-3">

        <!-- Category Item -->
        <div
            class="flex items-center gap-1 border border-[#0f4c81] text-[#0f4c81] px-3 py-1.5 rounded hover:bg-[#0f4c81] hover:text-white transition cursor-pointer">
            <i class="ri-grid-fill text-base"></i>
            <span class="font-medium leading-none">Category</span>
            <i class="ri-arrow-down-s-line text-base"></i>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex items-center gap-6 text-[#0f4c81] font-medium">
            <a href="#" class="hover:text-[#0056a3] transition">Shop</a>
            <a href="#" class="hover:text-[#0056a3] transition">Today's Products</a>
            <a href="#" class="hover:text-[#0056a3] transition">Hot Deals</a>
            <a href="#" class="hover:text-[#0056a3] transition">New Arrivals</a>
            <a href="#" class="hover:text-[#0056a3] transition">Best Sellers</a>
        </div>
    </div>
</nav>
<script>
    let hasScrolledAbove100 = null;
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 100 && hasScrolledAbove100 !== true) {
            // Add fixed classes
            navbar.classList.add('fixed', 'top-0', 'right-0', 'w-full', 'z-50', 'shadow-lg');
            hasScrolledAbove100 = true;
        } else if (window.scrollY <= 100 && hasScrolledAbove100 !== false) {
            // Remove fixed classes
            navbar.classList.remove('fixed', 'top-0', 'right-0', 'w-full', 'z-50', 'shadow-lg');
            hasScrolledAbove100 = false;
        }
    });
</script>
