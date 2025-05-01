@extends('admin.layouts.app')

@section('title', 'All Products')

@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-6">
        <!-- Header Section -->
        <div class="p-3 flex items-center justify-between gap-4 flex-wrap bg-white rounded shadow-sm">
            <!-- Left Side: Search + Filter -->
            <div class="flex flex-wrap md:flex-nowrap md:w-auto w-full items-center gap-3">
                <!-- Search Input -->
                <div class="flex items-center md:w-[250px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-10">
                    <i class="ri-search-line text-gray-500 ml-2 text-lg"></i>
                    <input id="searchInput" type="text" placeholder="Search" name="search"
                        class="flex-1 px-0 bg-transparent text-gray-700 outline-none border-none focus:ring-0 focus:outline-none h-full text-sm">
                </div>

                <!-- Status Filter Dropdown -->
                <div class="flex items-center md:w-[200px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-10">
                    <select id="statusFilter" name="status"
                        class="flex-1 bg-transparent text-gray-700 outline-none border-none px-3 focus:ring-0 focus:outline-none h-full text-sm cursor-pointer">
                        <option value="">All Status</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <!-- Right Side: Add Button -->
            <a href="{{ route('products.create') }}"
                class="flex items-center justify-center bg-teal-500 hover:bg-teal-600 text-white font-medium text-sm rounded px-5 h-10 transition w-full md:w-auto">
                Add Products
            </a>
        </div>

        <!-- Data Table -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Image</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Products</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Category</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Status</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Price</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Click</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Order</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="productList">
                        <!-- Loading message will appear here initially -->
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Loading products...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                <div id="paginationLinks" class="flex justify-end mt-4"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            fetchProducts();

            $('#statusFilter').change(function() {
                const status = $(this).val();
                fetchProducts('', 1, status);
            });
        });

        function limitText(text, length = 30) {
            return text.length > length ? text.slice(0, length) + '...' : text;
        }

        function fetchProducts(query = '', page = 1, status = '') {
            const productList = document.querySelector('.productList');
            const paginationLinks = document.getElementById('paginationLinks');

            // Show loading message
            productList.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center py-4 text-gray-500">Loading products...</td>
                </tr>`;
            paginationLinks.innerHTML = '';

            fetch(`{{ route('products.api') }}?search=${query}&page=${page}&status=${status}`)
                .then(response => response.json())
                .then(data => {
                    productList.innerHTML = ''; // Clear loading message

                    if (data.data.length === 0) {
                        productList.innerHTML = `
                            <tr>
                                <td colspan="9" class="text-center py-4 text-gray-500">No products found.</td>
                            </tr>`;
                        return;
                    }

                    // Populate rows with products
                    data.data.forEach(product => {
                        const productName = limitText(product.product_name, 20);
                        const row = `
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-2 text-gray-700 text-sm whitespace-nowrap">${product.id}</td>
                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                    ${product.product_image 
                                        ? `<img src="{{ asset('storage/') }}/${product.product_image}" class="w-12 h-12 object-cover rounded">`
                                        : `<span>No Image</span>`}
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${productName}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${product.product_price}</td>
                                <td class="px-6 py-1 text-sm whitespace-nowrap text-center">
                                    <span class="px-2 py-1 rounded text-white text-xs font-medium 
                                        ${product.product_status === 'approved' ? 'bg-green-500' : 
                                            (product.product_status === 'pending' ? 'bg-yellow-500' : 
                                            (product.product_status === 'rejected' ? 'bg-red-500' : 'bg-gray-500'))
                                        } capitalize">
                                        ${product.product_status}
                                    </span>
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${product.product_price}</td>
                                <td class="px-6 py-1 text-sm text-center whitespace-nowrap">
                                    <span class="${product.click_count > 0 ? 'text-green-500' : 'text-red-500'}">
                                        ${product.click_count}
                                    </span>
                                </td>
                                <td class="px-6 py-1 text-sm text-center whitespace-nowrap">
                                    <span class="${product.order_count > 0 ? 'text-green-500' : 'text-red-500'}">
                                        ${product.order_count}
                                    </span>
                                </td>
                                <td class="px-6 pt-4 flex flex-row gap-3 items-center text-center whitespace-nowrap">
                                    <a href="products/show/${product.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-eye-line"></i></a>
                                    <a href="products/edit/${product.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-edit-box-line"></i></a>
                                    <a href="products/destroy/${product.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-delete-bin-6-line"></i></a>
                                </td>
                            </tr>`;
                        productList.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => {
                    productList.innerHTML = `
                        <tr>
                            <td colspan="9" class="text-center py-4 text-red-500">Failed to load products.</td>
                        </tr>`;
                    console.error('Error:', error);
                });
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            fetchProducts(this.value);
        });
    </script>
@endpush
