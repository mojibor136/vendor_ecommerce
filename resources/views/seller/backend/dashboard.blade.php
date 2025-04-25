@extends('seller.layouts.app')
@section('title', 'Seller Dashboard')
@section('content')
    <div class="flex flex-col gap-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Product -->
            <a href="{{ route('products.index') }}"
                class="block bg-white text-gray-800 shadow-md rounded-md p-4 text-center hover:shadow-lg transition transform hover:scale-[1.03]">
                <i class="ri-shopping-bag-3-line text-3xl mb-2 text-blue-500"></i>
                <h3 class="text-sm font-medium">Products</h3>
                <p class="text-xl font-bold mt-1">25</p>
            </a>

            <!-- Categories -->
            <a href="{{ route('categories.index') }}"
                class="block bg-white text-gray-800 shadow-md rounded-md p-4 text-center hover:shadow-lg transition transform hover:scale-[1.03]">
                <i class="ri-grid-line text-3xl mb-2 text-green-500"></i>
                <h3 class="text-sm font-medium">Categories</h3>
                <p class="text-xl font-bold mt-1">20</p>
            </a>

            <!-- Subcategories -->
            <a href="{{ route('subcategories.index') }}"
                class="block bg-white text-gray-800 shadow-md rounded-md p-4 text-center hover:shadow-lg transition transform hover:scale-[1.03]">
                <i class="ri-shape-2-line text-3xl mb-2 text-purple-500"></i>
                <h3 class="text-sm font-medium">Subcategories</h3>
                <p class="text-xl font-bold mt-1">10</p>
            </a>

            <!-- Seller -->
            <a href="{{ route('seller.index') }}"
                class="block bg-white text-gray-800 shadow-md rounded-md p-4 text-center hover:shadow-lg transition transform hover:scale-[1.03]">
                <i class="ri-store-3-line text-3xl mb-2 text-red-500"></i>
                <h3 class="text-sm font-medium">Sellers</h3>
                <p class="text-xl font-bold mt-1">20</p>
            </a>

            <!-- Subscription -->
            <a href="{{ route('subscription.index') }}"
                class="block bg-white text-gray-800 shadow-md rounded-md p-4 text-center hover:shadow-lg transition transform hover:scale-[1.03]">
                <i class="ri-vip-crown-line text-3xl mb-2 text-yellow-500"></i>
                <h3 class="text-sm font-medium">Subscriptions</h3>
                <p class="text-xl font-bold mt-1">30</p>
            </a>

            <!-- Order -->
            <a href="#"
                class="block bg-white text-gray-800 shadow-md rounded-md p-4 text-center hover:shadow-lg transition transform hover:scale-[1.03]">
                <i class="ri-truck-line text-3xl mb-2 text-indigo-500"></i>
                <h3 class="text-sm font-medium">Orders</h3>
                <p class="text-xl font-bold mt-1">40</p>
            </a>

            <!-- Users -->
            <a href="{{ route('user.index') }}"
                class="block bg-white text-gray-800 shadow-md rounded-md p-4 text-center hover:shadow-lg transition transform hover:scale-[1.03]">
                <i class="ri-user-line text-3xl mb-2 text-teal-500"></i>
                <h3 class="text-sm font-medium">Users</h3>
                <p class="text-xl font-bold mt-1">10</p>
            </a>

            <!-- Visitors -->
            <a href="#"
                class="block bg-white text-gray-800 shadow-md rounded p-4 text-center hover:shadow-lg transition transform hover:scale-[1.03]">
                <i class="ri-eye-line text-3xl mb-2 text-orange-500"></i>
                <h3 class="text-sm font-medium">Visitors</h3>
                <p class="text-xl font-bold mt-1">10</p>
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
                                    <a href="" class="text-lg text-red-500"><i class="ri-delete-bin-7-line"></i></a>
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
