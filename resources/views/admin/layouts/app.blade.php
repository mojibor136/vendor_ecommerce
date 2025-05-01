<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }

    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .submenu.open {
        max-height: 200px;
        transition: max-height 0.3s ease;
    }

    .active {
        background-color: #F3EFFD;
        color: #5025d1;
    }

    .scroll-bar::-webkit-scrollbar {
        display: none;
    }

    .scroll-bar {
        scrollbar-width: none;
    }
</style>

<body class="bg-[#f5f6f8]">
    <div class="flex flex-col h-screen relative">
        <!-- Header Section -->
        <div
            class="header border-b md:h-[70px] h-[60px] w-full py-3 md:px-6 px-3 bg-[#38414a] z-10 flex items-center fixed top-0 left-0 right-0">
            <div class="flex justify-between w-full items-center">
                <div class="logo flex flex-row gap-16 hidden md:block">
                    <div class="flex flex-row gap-2 items-center">
                        <span class="font-bold text-white text-xl tracking-wide uppercase">e-commerce</span>
                    </div>
                </div>
                <i id="menuBtn" class="ri-menu-line md:hidden block text-white text-xl font-medium"></i>
                <div class="flex flex-row items-center gap-5">
                    <div class="relative">
                        <div
                            class="absolute -right-1 -top-0 w-4 h-4 rounded-full bg-red-500 flex items-center justify-center">
                            <span class="text-white text-[10px] leading-none">2</span>
                        </div>
                        <i class="ri-notification-2-line cursor-pointer text-white/80 hover:text-white text-[21px]"></i>
                    </div>
                    <i class="ri-moon-line text-white/80 cursor-pointer hover:text-white text-[21px]"></i>
                    <div class="flex items-center flex-row gap-2 cursor-pointer">
                        <img src="{{ asset('upload/admin.png') }}" alt="Admin" class="w-10 h-10 rounded-full">
                        <span class="text-white/80 text-[15px]">Admin</span>
                        <i class="ri-arrow-down-s-line text-white/80"></i>
                    </div>
                    <i class="ri-settings-2-line cursor-pointer text-white/80 hover:text-white text-[21px]"></i>
                </div>
            </div>
        </div>

        <!-- Sidebar and Content Section -->
        <div class="flex flex-1 pt-[56px]">
            <div id="sidebar"
                class="scroll-bar w-[210px] z-50 md:block bg-white fixed md:top-[70px] top-[60px] bottom-0 overflow-y-auto 
            transition-all duration-500 ease-in-out transform -translate-x-full md:translate-x-0">
                <div class="pb-6 px-1.5 pt-1.5 md:border-none border-t border-gray-50">
                    <ul>
                        <!-- Dashboard -->

                        <li class="group">
                            <a href="{{ route('admin.index') }}"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 rounded transition duration-200
                                                   {{ request()->routeIs('admin.index') ? 'bg-blue-500 text-white' : 'text-gray-800 group-hover:text-white group-hover:bg-blue-500' }}">
                                <i
                                    class="ri-home-5-line mr-1 {{ request()->routeIs('admin.index') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}"></i>
                                <span class="text-[15px]">Dashboard</span>
                            </a>
                        </li>

                        <!-- Company -->
                        <li class="group">
                            <a href="{{ route('company.index') }}"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 rounded transition duration-200
                                                   {{ request()->routeIs('company.index', 'company.show', 'company.create', 'company.edit') ? 'bg-blue-500 text-white' : 'text-gray-800 group-hover:text-white group-hover:bg-blue-500' }}">
                                <i
                                    class="ri-global-line mr-1 {{ request()->routeIs('company.index', 'company.show', 'company.create', 'company.edit') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}"></i>
                                <span class="text-[15px]">Company</span>
                            </a>
                        </li>

                        <!-- Categories -->
                        <li class="group">
                            <a href="{{ route('categories.index') }}"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 rounded transition duration-200
                               {{ request()->routeIs('categories.index', 'categories.show', 'categories.create', 'categories.edit') ? 'bg-blue-500 text-white' : 'text-gray-800 group-hover:text-white group-hover:bg-blue-500' }}">
                                <i
                                    class="ri-apps-line mr-1 {{ request()->routeIs('categories.index', 'categories.show', 'categories.create', 'categories.edit') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}"></i>
                                <span class="text-[15px]">Categories</span>
                            </a>
                        </li>

                        <!-- Sub-Categories -->
                        <li class="group">
                            <a href="{{ route('subcategories.index') }}"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 rounded transition duration-200
                               {{ request()->routeIs('subcategories.index', 'subcategories.show', 'subcategories.create', 'subcategories.edit') ? 'bg-blue-500 text-white' : 'text-gray-800 group-hover:text-white group-hover:bg-blue-500' }}">
                                <i
                                    class="ri-list-check mr-1 {{ request()->routeIs('subcategories.index', 'subcategories.show', 'subcategories.create', 'subcategories.edit') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}"></i>
                                <span class="text-[15px]">Subcategories</span>
                            </a>
                        </li>

                        <!-- Product -->
                        <li class="group">
                            <a href="{{ route('products.index') }}"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 rounded transition duration-200
                               {{ request()->routeIs('products.index', 'products.show', 'products.edit', 'products.create') ? 'bg-blue-500 text-white' : 'text-gray-800 group-hover:text-white group-hover:bg-blue-500' }}">
                                <i
                                    class="ri-newspaper-line mr-1 {{ request()->routeIs('products.index', 'products.show', 'products.edit', 'products.create') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}"></i>
                                <span class="text-[15px]">Products</span>
                            </a>
                        </li>

                        <!-- Order  -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="order">
                                <i class="ri-truck-line mr-1"></i>
                                <span class="text-[15px]">Order</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('order/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('order.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">

                                        All Order
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('delivered.order') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Delivered Order
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shipping.order') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Shipping Order
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cancel.order') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.size') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Cancel Order
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Payment -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="payment">
                                <i class="ri-bar-chart-line mr-1"></i>
                                <span class="text-[15px]">Payment</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('payment/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('sales.location') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Seller payment
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sales.report') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Order payment
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sales.location') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Subscription payment
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Subscription -->
                        <li class="group">
                            <a href="{{ route('subscription.index') }}"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 rounded transition duration-200
                                                       {{ request()->routeIs('subscription.index', 'subscription.show', 'subscription.edit', 'subscription.create') ? 'bg-blue-500 text-white' : 'text-gray-800 group-hover:text-white group-hover:bg-blue-500' }}">
                                <i
                                    class="ri-vip-crown-line mr-1 {{ request()->routeIs('subscription.index', 'subscription.show', 'subscription.edit', 'subscription.create') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}"></i>
                                <span class="text-[15px]">Subscription</span>
                            </a>
                        </li>

                        <!-- Seller -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="seller">
                                <i class="ri-store-3-line mr-1"></i>
                                <span class="text-[15px]">Seller</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('seller/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('seller.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        All Seller
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sales.report') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Unverified Seller
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- User -->
                        <li class="group">
                            <a href="{{ route('user.index') }}"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 rounded transition duration-200
                                                       {{ request()->routeIs('user.index', 'user.show') ? 'bg-blue-500 text-white' : 'text-gray-800 group-hover:text-white group-hover:bg-blue-500' }}">
                                <i
                                    class="ri-group-line mr-1 {{ request()->routeIs('user.index', 'user.show') ? 'text-white' : 'text-gray-700 group-hover:text-white' }}"></i>
                                <span class="text-[15px]">User</span>
                            </a>
                        </li>

                        <!-- Location  -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="location">
                                <i class="ri-map-pin-line mr-1"></i>
                                <span class="text-[15px]">Location</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('location/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('country.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Country
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('division.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Division
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('district.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.size') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        District
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Analytics -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="analytics">
                                <i class="ri-bar-chart-line mr-1"></i>
                                <span class="text-[15px]">Analytics</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('analytics/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('sales.report') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Sales Report
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sales.location') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Sales Location
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('seller.location') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.size') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Seller Location
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Settings -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="settings">
                                <i class="ri-settings-2-line mr-1"></i>
                                <span class="text-[15px]">Settings</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('settings/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('payment-gateway.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Payment gateway
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sales.location') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Email configuration
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Logout -->
                        <li class="group">
                            <a href="{{ route('admin.logout') }}"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 rounded transition duration-200
                                       text-gray-800 group-hover:text-white group-hover:bg-blue-500">
                                <i class="ri-logout-box-r-line mr-1 text-gray-700 group-hover:text-white"></i>
                                <span class="text-[15px]">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content Section -->
            <div class="flex-1 md:ml-[210px] md:px-4 px-2 md:pt-8 pt-4 overflow-y-auto">
                @yield('content')
            </div>
        </div>
    </div>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submenuToggles = document.querySelectorAll('.submenu-toggle');

            submenuToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();

                    const submenu = this.nextElementSibling;
                    const submenuKey = this.dataset.menuKey; // Unique key from data attribute

                    // Toggle submenu open/close
                    if (submenu.classList.contains('open')) {
                        submenu.classList.remove('open');
                        submenu.style.maxHeight = '0';
                        this.classList.remove('bg-blue-500',
                            'text-white'); // Remove background when closed
                        localStorage.removeItem('openMenu'); // Remove from localStorage when closed
                    } else {
                        // Close any other open submenus
                        document.querySelectorAll('.submenu').forEach(function(sm) {
                            sm.classList.remove('open');
                            sm.style.maxHeight = '0';
                        });

                        // Remove background from all other submenu toggles
                        document.querySelectorAll('.submenu-toggle').forEach(function(st) {
                            st.classList.remove('bg-blue-500', 'text-white');
                        });

                        // Open the clicked submenu and set styles
                        submenu.classList.add('open');
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        this.classList.add('bg-blue-500', 'text-white'); // Add background when open
                        localStorage.setItem('openMenu', submenuKey); // Save key to localStorage
                    }
                });
            });

            // Check for open menu from localStorage and keep it open
            const openMenuKey = localStorage.getItem('openMenu');
            if (openMenuKey) {
                const openMenuToggle = document.querySelector(`[data-menu-key="${openMenuKey}"]`);
                if (openMenuToggle) {
                    const submenu = openMenuToggle.nextElementSibling;
                    submenu.classList.add('open');
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    openMenuToggle.classList.add('bg-blue-500', 'text-white');
                }
            }
        });
    </script>

    <script>
        document.getElementById("menuBtn").addEventListener("click", function() {
            let sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("-translate-x-full");
        });
    </script>
</body>

</html>
