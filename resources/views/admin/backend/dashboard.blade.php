@extends('admin.layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="flex flex-col gap-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-3">
            <!-- Product Count Card -->
            <a href="{{ route('products.index') }}"
                class="block bg-green-100 border text-green-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-green-600 w-12 h-12 rounded">
                        <i class="ri-shopping-bag-3-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $productCount }}</p>
                        <h3 class="text-sm font-medium">Total Products</h3>
                    </div>
                </div>
            </a>

            <!-- Total Product Quantity Card -->
            <a href="{{ route('products.index') }}"
                class="block bg-yellow-100 border text-yellow-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-yellow-500 w-12 h-12 rounded">
                        <i class="ri-numbers-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $totalProductQuantity }}</p>
                        <h3 class="text-sm font-medium">Total Quantity</h3>
                    </div>
                </div>
            </a>

            <!-- Categories -->
            <a href="{{ route('categories.index') }}"
                class="block bg-blue-100 border text-blue-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-blue-600 w-12 h-12 rounded">
                        <i class="ri-grid-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $categoryCount }}</p>
                        <h3 class="text-sm font-medium">Categories</h3>
                    </div>
                </div>
            </a>

            <!-- Subcategories -->
            <a href="{{ route('subcategories.index') }}"
                class="block bg-purple-100 border text-purple-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-purple-600 w-12 h-12 rounded">
                        <i class="ri-shape-2-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $subCategoryCount }}</p>
                        <h3 class="text-sm font-medium">Subcategories</h3>
                    </div>
                </div>
            </a>

            <!-- Sellers -->
            <a href="{{ route('seller.index') }}"
                class="block bg-red-100 border text-red-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-red-600 w-12 h-12 rounded">
                        <i class="ri-store-3-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $sellerCount }}</p>
                        <h3 class="text-sm font-medium">Sellers</h3>
                    </div>
                </div>
            </a>

            <!-- Subscriptions -->
            <a href="{{ route('subscription.index') }}"
                class="block bg-pink-100 border text-pink-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-pink-500 w-12 h-12 rounded">
                        <i class="ri-vip-crown-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $subscriptionCount }}</p>
                        <h3 class="text-sm font-medium">Subscriptions</h3>
                    </div>
                </div>
            </a>

            <!-- Orders -->
            <a href="{{ route('order.index') }}"
                class="block bg-indigo-100 border text-indigo-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-indigo-600 w-12 h-12 rounded">
                        <i class="ri-truck-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $orderCount }}</p>
                        <h3 class="text-sm font-medium">Orders</h3>
                    </div>
                </div>
            </a>

            <!-- Users -->
            <a href="{{ route('user.index') }}"
                class="block bg-teal-100 border text-teal-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-teal-600 w-12 h-12 rounded">
                        <i class="ri-user-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $userCount }}</p>
                        <h3 class="text-sm font-medium">Customar</h3>
                    </div>
                </div>
            </a>

            <!-- Visitors -->
            <a href="#"
                class="block bg-orange-100 border text-orange-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-orange-500 w-12 h-12 rounded">
                        <i class="ri-eye-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $visitorCount }}</p>
                        <h3 class="text-sm font-medium">Visitors</h3>
                    </div>
                </div>
            </a>

            <!-- Sales Report -->
            <a href="#"
                class="block bg-rose-100 border text-rose-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-rose-600 w-12 h-12 rounded">
                        <i class="ri-bar-chart-2-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">10000</p>
                        <h3 class="text-sm font-medium">Sales Report</h3>
                    </div>
                </div>
            </a>

            <!-- Products Sold -->
            <a href="#"
                class="block bg-amber-100 border text-amber-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-amber-600 w-12 h-12 rounded">
                        <i class="ri-pie-chart-2-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $totalProductsSold }}</p>
                        <h3 class="text-sm font-medium">Products Sold</h3>
                    </div>
                </div>
            </a>

            <!-- Country -->
            <a href="{{ route('country.index') }}"
                class="block bg-pink-100 border text-pink-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-pink-500 w-12 h-12 rounded">
                        <i class="ri-global-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $countryCount }}</p>
                        <h3 class="text-sm font-medium">Countries</h3>
                    </div>
                </div>
            </a>

            <!-- Division -->
            <a href="{{ route('division.index') }}"
                class="block bg-cyan-100 border text-cyan-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-cyan-600 w-12 h-12 rounded">
                        <i class="ri-map-pin-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $divisionCount }}</p>
                        <h3 class="text-sm font-medium">Divisions</h3>
                    </div>
                </div>
            </a>

            <!-- District -->
            <a href="{{ route('district.index') }}"
                class="block bg-lime-100 border text-lime-600 rounded px-2 py-2 md:px-3 md:py-3 shadow transition transform hover:scale-[1.03]">
                <div class="flex flex-row items-center gap-3">
                    <div class="flex items-center justify-center bg-lime-600 w-12 h-12 rounded">
                        <i class="ri-building-line text-white text-2xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xl font-bold">{{ $districtCount }}</p>
                        <h3 class="text-sm font-medium">Districts</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="rounded shadow bg-white/70 mb-4">
            <div class="data overflow-x-auto">
                <div class="table-container overflow-x-auto max-h-[500px]">
                    <table class="w-full border-collapse">
                        <thead class="text-left text-sm font-semibold text-gray-700">
                            <tr class="whitespace-nowrap">
                                <th class="px-3 py-4 border-b">
                                    <input type="checkbox" name="id"
                                        class="h-4.5 w-4.5 text-indigo-600 bg-white border-gray-300 rounded focus:ring-0 focus:outline-none" />
                                </th>
                                <th class="border-b">Owner Name</th>
                                <th class="border-b">Store Name</th>
                                <th class="border-b">Ratings</th>
                                <th class="border-b">Products</th>
                                <th class="border-b">Wallet Balance</th>
                                <th class="border-b">Create Date</th>
                                <th class="border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                            <tr class="hover:bg-gray-100 whitespace-nowrap">
                                <td class="p-3">
                                    <input type="checkbox" name="id"
                                        class="h-4.5 w-4.5 text-indigo-600 bg-white border-gray-300 rounded focus:ring-0 focus:outline-none" />
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center gap-2">
                                        <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full"
                                            alt="Owner 1">
                                        <span>Rafiul Islam</span>
                                    </div>
                                </td>
                                <td class="p-3">Tech World</td>
                                <td class="p-3">4.5 <i class="ri-star-s-fill text-yellow-600 text-[18px]"></i></td>
                                <td class="p-3">120</td>
                                <td class="p-3">৳5,200</td>
                                <td class="p-3">2024-06-12</td>
                                <td class="px-3 pt-4 flex flex-row gap-2">
                                    <a href="" class="text-lg text-green-500"><i class="ri-edit-box-line"></i></a>
                                    <a href="" class="text-lg text-red-500"><i
                                            class="ri-delete-bin-7-line"></i></a>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-100 whitespace-nowrap">
                                <td class="p-3">
                                    <input type="checkbox" name="id"
                                        class="h-4.5 w-4.5 text-indigo-600 bg-white border-gray-300 rounded focus:ring-0 focus:outline-none" />
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center gap-2">
                                        <img src="https://i.pravatar.cc/40?img=2" class="w-10 h-10 rounded-full"
                                            alt="Owner 2">
                                        <span>Samira Khan</span>
                                    </div>
                                </td>
                                <td class="p-3">Fashion Mart</td>
                                <td class="p-3">4.8 <i class="ri-star-s-fill text-yellow-600 text-[18px]"></i></td>
                                <td class="p-3">75</td>
                                <td class="p-3">৳3,800</td>
                                <td class="p-3">2024-05-08</td>
                                <td class="px-3 pt-4 flex flex-row gap-2">
                                    <a href="" class="text-lg text-green-500"><i class="ri-edit-box-line"></i></a>
                                    <a href="" class="text-lg text-red-500"><i
                                            class="ri-delete-bin-7-line"></i></a>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-100 whitespace-nowrap">
                                <td class="p-3">
                                    <input type="checkbox" name="id"
                                        class="h-4.5 w-4.5 text-indigo-600 bg-white border-gray-300 rounded focus:ring-0 focus:outline-none" />
                                </td>
                                <td class="p-3">
                                    <div class="flex items-center gap-2">
                                        <img src="https://i.pravatar.cc/40?img=3" class="w-10 h-10 rounded-full"
                                            alt="Owner 3">
                                        <span>Tanvir Ahmed</span>
                                    </div>
                                </td>
                                <td class="p-3">Gadget Point</td>
                                <td class="p-3">4.2 <i class="ri-star-s-fill text-yellow-600 text-[18px]"></i></td>
                                <td class="p-3">90</td>
                                <td class="p-3">৳6,000</td>
                                <td class="p-3">2024-04-27</td>
                                <td class="px-3 pt-4 flex flex-row gap-2">
                                    <a href="" class="text-lg text-green-500"><i class="ri-edit-box-line"></i></a>
                                    <a href="" class="text-lg text-red-500"><i
                                            class="ri-delete-bin-7-line"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-between items-center px-4 py-3 bg-white/70 border-t rounded-b">
                        <div class="text-sm text-gray-600">
                            Showing <span class="font-semibold">1</span> to <span class="font-semibold">3</span> of <span
                                class="font-semibold">10</span> results
                        </div>
                        <div class="inline-flex gap-1">
                            <button
                                class="px-3 py-1 rounded-full border text-sm text-gray-600 bg-white hover:bg-gray-100">Prev</button>
                            <button class="px-3 py-1 rounded-full border text-sm bg-indigo-500 text-white">1</button>
                            <button
                                class="px-3 py-1 rounded-full border text-sm text-gray-600 bg-white hover:bg-gray-100">2</button>
                            <button
                                class="px-3 py-1 rounded-full border text-sm text-gray-600 bg-white hover:bg-gray-100">3</button>
                            <button
                                class="px-3 py-1 rounded-full border text-sm text-gray-600 bg-white hover:bg-gray-100">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
