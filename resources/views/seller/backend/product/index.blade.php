@extends('seller.layouts.app')
@section('title', 'All Products')
@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-6">
        <!-- Header Section -->
        <div class="p-3 flex items-center justify-between gap-4 flex-wrap">
            <!-- Search Box -->
            <div
                class="flex items-center md:w-[250px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-9.5">
                <i class="ri-search-line text-gray-500 ml-2 text-lg"></i>
                <input id="searchInput" type="text" placeholder="Search" name="search"
                    class="flex-1 px-0 bg-transparent text-gray-700 outline-none border-none focus:ring-0 focus:outline-none h-full">
            </div>

            <!-- Add Product Button -->
            <a href="{{ route('seller.products.create') }}"
                class="bg-teal-500 flex flex-row items-center justify-center text-white px-4 md:py-2 py-2.5 md:w-auto w-full rounded text-sm font-medium hover:bg-teal-600 transition">
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
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Price</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Click</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Order</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="productList">
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
        });

        function limitText(text, length = 30) {
            return text.length > length ? text.slice(0, length) + '...' : text;
        }

        function fetchProducts(query = '', page = 1) {
            fetch(`{{ route('seller.products.api') }}?search=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const productList = document.querySelector('.productList');
                    productList.innerHTML = '';

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
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${product.category.category_name}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${product.product_price}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm text-center whitespace-nowrap">${product.click_count}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm text-center whitespace-nowrap">${product.order_count}</td>
                                <td class="px-6 pt-4 flex flex-row gap-3 items-center text-center whitespace-nowrap">
                                    <a href="products/show/${product.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-eye-line"></i></a>
                                    <a href="products/edit/${product.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-edit-box-line"></i></a>
                                    <a href="products/destroy/${product.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-delete-bin-6-line"></i></a>
                                </td>
                            </tr>`;
                        productList.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            fetchProducts(this.value);
        });
    </script>
@endpush
