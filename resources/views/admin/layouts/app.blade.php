<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('remixicon/remixicon.css') }}">
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
        <div class="header border-b w-full bg-[#38414a] z-10 flex items-center fixed top-0 left-0 right-0">
            <div class="md:h-[70px] h-[60px] w-full py-3 md:px-6 px-3 relative">
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
                            <i
                                class="ri-notification-2-line cursor-pointer text-white/80 hover:text-white text-[21px]"></i>
                        </div>
                        <i class="ri-moon-line text-white/80 cursor-pointer hover:text-white text-[21px]"></i>
                        <div id="profile_menu_btn" class="flex items-center flex-row gap-2 cursor-pointer">
                            <img src="{{ asset('upload/admin.png') }}" alt="Admin" class="w-10 h-10 rounded-full">
                            <span class="text-white/80 text-[15px]">Admin</span>
                            <i class="ri-arrow-down-s-line text-white/80"></i>
                        </div>
                        <i class="ri-settings-2-line cursor-pointer text-white/80 hover:text-white text-[21px]"></i>
                    </div>
                </div>
                <!-- Dropdown Menu -->
                <div id="profile_menu"
                    class="absolute top-full mt-0 right-0 w-60 bg-white hidden rounded-b-lg overflow-hidden shadow-lg border border-gray-200">
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2 transition duration-300 hover:bg-[#38414a] group">
                        <i
                            class="ri-user-line text-lg text-gray-600 group-hover:text-white transition duration-300"></i>
                        <span
                            class="text-gray-800 font-medium group-hover:text-white transition duration-300">Profile</span>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2 transition duration-300 hover:bg-[#38414a] group">
                        <i
                            class="ri-logout-box-r-line text-lg text-gray-600 group-hover:text-white transition duration-300"></i>
                        <span
                            class="text-gray-800 font-medium group-hover:text-white transition duration-300">Logout</span>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-2 transition duration-300 hover:bg-[#38414a] group">
                        <i
                            class="ri-settings-3-line text-lg text-gray-600 group-hover:text-white transition duration-300"></i>
                        <span class="text-gray-800 font-medium group-hover:text-white transition duration-300">Site
                            Setting</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar and Content Section -->
        <div class="flex flex-1 pt-[56px]">
            <div id="sidebar"
                class="scroll-bar md:w-[210px] lg:w-[240px] z-50 md:block bg-white fixed md:top-[70px] top-[60px] bottom-0 overflow-y-auto 
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

                        <!-- Ecommerce  -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="ecommerce">
                                <i class="ri-newspaper-line mr-1"></i>
                                <span class="text-[15px]">Ecommerce</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('ecommerce/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('products.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('products.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">

                                        Products
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('categories.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('categories.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Categories
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subcategories.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('subcategories.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Subcategories
                                    </a>
                                </li>
                            </ul>
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
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('order.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">

                                        All Order
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('processing.order') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('processing.order') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Processing Order
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('shipping.order') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('shipping.order') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Shipping Order
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('delivered.order') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('delivered.order') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Delivered Order
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cancel.order') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('cancel.order') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Cancel Order
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Sliders Menu -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('slider*') ? 'active' : '' }}"
                                data-menu-key="slider">
                                <i class="ri-slideshow-line mr-1"></i>
                                <span class="text-[15px]">Slider</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('slider*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('slider.main.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('slider.main.index', 'slider.main.create') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Main Slider
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('slider.sub.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('slider.sub.index', 'slider.sub.create') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Sub Slider
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
                                    <a href="{{ route('seller.payment.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('seller.payment.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Seller payment
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('order.payment.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('order.payment.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Order payment
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subscription.payment.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('subscription.payment.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Subscription payment
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Subscription -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="subscription">
                                <i class="ri-vip-crown-line mr-1"></i>
                                <span class="text-[15px]">Subscription</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('subscription/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('subscription.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('subscription.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        All Subscription
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subscription.monthly') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('subscription.monthly') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Monthly Subscription
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('subscription.yearly') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('subscription.yearly') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Yearly Subscription
                                    </a>
                                </li>
                            </ul>
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
                                    <a href="{{ route('active.seller') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Active Seller
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('inactive.seller') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Inactive Seller
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- User -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="user">
                                <i class="ri-group-line mr-1"></i>
                                <span class="text-[15px]">User</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('user/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('user.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        All User
                                    </a>
                                </li>
                            </ul>
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
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('country.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Country
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('division.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('division.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Division
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('district.index') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('district.index') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
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
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('sales.report') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Sales Report
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sales.location') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('sales.location') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Sales Location
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('seller.location') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('seller.location') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Seller Location
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- API Integration -->
                        <li>
                            <a href="#"
                                class="mb-1 flex text-[17px] items-center pl-4 py-2.5 text-gray-800 hover:bg-blue-500 hover:text-white rounded transition duration-200 submenu-toggle {{ request()->is('setting/*') ? 'active' : '' }}"
                                data-menu-key="api">
                                <i class="ri-bar-chart-line mr-1"></i>
                                <span class="text-[15px]">API Integration</span>
                                <i class="ri-arrow-down-s-line ml-auto mr-4 transition-transform duration-200"></i>
                            </a>
                            <ul class="submenu pl-2 {{ request()->is('api/*') ? 'open' : '' }}">
                                <li>
                                    <a href="{{ route('payment.integration') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('payment.integration') ? 'text-blue-600' : 'text-gray-800' }} hover:text-blue-600 transition duration-200">
                                        Payment Integration
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('courier.integration') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('courier.integration') ? 'text-blue-600' : 'text-gray-800' }} hover:text-blue-600 transition duration-200">
                                        Courier Integration
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('pixel.integration') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('pixel.integration') ? 'text-blue-600' : 'text-gray-800' }} hover:text-blue-600 transition duration-200">
                                        Facebook Pixel Integration
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('gtag.integration') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('gtag.integration') ? 'text-blue-600' : 'text-gray-800' }} hover:text-blue-600 transition duration-200">
                                        Google Tag Integration
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('sms.integration') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('sms.integration') ? 'text-blue-600' : 'text-gray-800' }} hover:text-blue-600 transition duration-200">
                                        SMS Integration
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('email.integration') }}"
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('email.integration') ? 'text-blue-600' : 'text-gray-800' }} hover:text-blue-600 transition duration-200">
                                        Email Integration
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
                                    <a href=""
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href=""
                                        class="flex text-[15px] items-center py-2 pl-6 {{ request()->routeIs('all.color') ? 'text-blue-600' : 'text-gray-800' }} rounded-lg hover:text-blue-600 transition duration-200">
                                        Site Setting
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content Section -->
            <div class="flex-1 md:ml-[210px] lg:ml-[240px] md:px-4 px-2 md:pt-8 mb-6 pt-4 overflow-y-auto">
                @yield('content')
            </div>
        </div>
    </div>

    @stack('scripts')
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        profile_menu_btn.onclick = () => profile_menu.classList.toggle('hidden');
    </script>
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
