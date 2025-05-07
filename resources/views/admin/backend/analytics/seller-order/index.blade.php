@extends('admin.layouts.app')
@section('title', 'Sales Analytics')
@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-6">
        <div class="p-3 flex items-center justify-between gap-4 flex-wrap">
            <div
                class="flex items-center md:w-[250px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-9.5">
                <i class="ri-search-line text-gray-500 ml-2 text-lg"></i>
                <input id="searchInput" type="text" placeholder="Search" name="search"
                    class="flex-1 px-0 bg-transparent text-gray-700 outline-none border-none focus:ring-0 focus:outline-none h-full">
            </div>
        </div>

        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase whitespace-nowrap">ID</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase whitespace-nowrap">Store Name
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Ratings</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Total Order
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Canceled
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Pending</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Delivered
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody class="salesList">
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Loading sales data...</td>
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
            fetchSales()
        });

        function fetchSales(query = '', page = 1) {
            const salesList = document.querySelector('.salesList');
            salesList.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Loading sales data...</td>
                </tr>`;

            fetch(`{{ route('sales.report.data') }}?search=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    salesList.innerHTML = '';

                    if (data.data.length === 0) {
                        salesList.innerHTML = `
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">No sales data found.</td>
                            </tr>`;
                        return;
                    }

                    data.data.forEach(seller => {
                        const averageRating = seller.average_rating !== null ? `${seller.average_rating} / 5` :
                            'No ratings';

                        const row = `
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${seller.id}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <img src="/storage/${seller.image}" class="w-10 h-10 shrink-0 rounded-full object-cover" alt="Owner 1">
                                        <span class="font-semibold text-md">${seller.shop_name}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-1 text-orange-700 text-sm whitespace-nowrap text-center">${averageRating}</td>
                                <td class="px-6 py-1 text-orange-700 text-sm whitespace-nowrap text-center">${seller.total_orders_count}</td>
                                <td class="px-6 py-1 text-red-500 text-sm whitespace-nowrap text-center">${seller.canceled_orders_count}</td>
                                <td class="px-6 py-1 text-yellow-500 text-sm whitespace-nowrap text-center">${seller.pending_orders_count}</td>
                                <td class="px-6 py-1 text-green-500 text-sm whitespace-nowrap text-center">${seller.delivered_orders_count}</td>
                                <td class="px-6 py-2 text-green-700 text-sm whitespace-nowrap">
                                    <div class="flex flex-row items-center justify-center gap-2">
                                        <a href="/admin/seller/orders/${seller.shop_name.toLowerCase()}/${seller.id}" class="inline-block text-green-600 text-[19px]">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>`;
                        salesList.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    salesList.innerHTML = `
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Error loading sales data. Please try again later.</td>
                        </tr>`;
                });
        }

        // Live search
        document.getElementById('searchInput').addEventListener('input', function() {
            fetchSales(this.value);
        });
    </script>
@endpush
