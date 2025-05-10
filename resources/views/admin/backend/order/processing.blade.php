@extends('admin.layouts.app')
@section('title', 'Processing Order')

@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-3">
        <!-- Page Heading -->
        <div class="px-4 pt-6 flex flex-col gap-1">
            <h1 class="text-2xl font-semibold text-gray-800">Processing Order</h1>
            <p class="text-sm text-gray-500">Track, filter, and manage all customer orders and their payment statuses.</p>
        </div>
        <!-- Header Section -->
        <div class="p-3 flex items-center justify-between gap-4 flex-wrap">
            <div class="flex flex-wrap md:flex-nowrap md:w-auto w-full items-center gap-3">
                <!-- Search Input -->
                <div
                    class="flex items-center md:w-[250px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-10">
                    <i class="ri-search-line text-gray-500 ml-2 text-lg"></i>
                    <input id="searchInput" type="text" placeholder="Search" name="search"
                        class="flex-1 px-0 bg-transparent text-gray-700 outline-none border-none focus:ring-0 focus:outline-none h-full text-sm">
                </div>

                <!-- Date Range Picker -->
                <div class="flex items-center gap-2">
                    <input type="date" id="startDate"
                        class="px-3 py-2 border border-gray-300 text-gray-700 rounded focus:border-green-600 focus:outline-none" />
                    <input type="date" id="endDate"
                        class="px-3 py-2 border border-gray-300 text-gray-700 rounded focus:border-green-600 focus:outline-none" />
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Customer</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Shop</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Amount</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Status</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Payment</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Order Date
                            </th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="orderList">
                        <!-- Orders will be loaded here -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="my-4">
                <div id="paginationLinks" class="flex justify-end mt-4 gap-2"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            fetchOrder();

            $('#startDate, #endDate').on('change', function() {
                const query = $('#searchInput').val();
                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();
                fetchOrder(query, 1, startDate, endDate);
            });

        });

        function getStatusColor(status) {
            switch (status.toLowerCase()) {
                case 'pending':
                    return 'bg-yellow-500';
                case 'processing':
                    return 'bg-blue-500';
                case 'shipped':
                    return 'bg-purple-500';
                case 'delivered':
                    return 'bg-green-600';
                case 'cancelled':
                case 'rejected':
                    return 'bg-red-500';
                default:
                    return 'bg-gray-500';
            }
        }

        function getPaymentColor(status) {
            if (!status) return 'bg-gray-500';
            const cleanStatus = status.toString().trim().toLowerCase();

            switch (cleanStatus) {
                case 'paid':
                    return 'bg-green-600';
                case 'unpaid':
                    return 'bg-red-500';
                default:
                    return 'bg-gray-500';
            }
        }

        function capitalize(text) {
            if (!text) return '';
            return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
        }

        function fetchOrder(query = '', page = 1, startDate = '', endDate = '') {
            const orderList = document.querySelector('.orderList');
            const paginationLinks = document.getElementById('paginationLinks');

            orderList.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Loading...</td>
                </tr>`;
            paginationLinks.innerHTML = '';

            fetch(
                    `{{ route('processing.order.api') }}?search=${query}&page=${page}&start_date=${startDate}&end_date=${endDate}`
                )
                .then(response => response.json())
                .then(data => {
                    orderList.innerHTML = '';
                    paginationLinks.innerHTML = '';

                    if (data.data.length === 0) {
                        orderList.innerHTML = `
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">No orders found.</td>
                            </tr>`;
                        return;
                    }

                    data.data.forEach(order => {
                        const statusColor = getStatusColor(order.order_status);
                        const paymentColor = getPaymentColor(order.payment.status);

                        const row = `
                            <tr class="border-b hover:bg-gray-100 transition-all">
                                <td class="px-6 py-1 text-gray-700 text-sm">${order.id}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm capitalize">
                                    ${order.shipping?.shipping_name ?? 'N/A'}
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm capitalize">
                                    ${order.seller?.shop_name ?? 'N/A'}
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm">${order.payment.amount}</td>
                                <td class="px-6 py-1 text-sm">
                                    <span title="${order.order_status}" class="px-2 py-1 rounded text-white text-xs font-medium ${statusColor}">
                                        ${capitalize(order.order_status)}
                                    </span>
                                </td>
                                <td class="px-6 py-1 text-sm">
                                    <span title="${order.payment.status}" class="px-2 py-1 rounded text-white text-xs font-medium ${paymentColor}">
                                        ${capitalize(order.payment.status)}
                                    </span>
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm">
                                    ${new Date(order.created_at).toLocaleDateString('en-US')}
                                </td>
                                <td class="px-6 py-2 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="/admin/order/show/${order.seller.shop_name?.toLowerCase()}/${order.id}" class="inline-block text-gray-600 hover:text-blue-600 text-[19px]">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you want to delete this order?')" href="categories/destroy/${order.id}" class="inline-block text-gray-600 hover:text-red-600 text-[19px]">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </a>
                                        <a href="orders/invoice/${order.id}" class="inline-block text-gray-600 text-[19px]" title="Invoice">
                                            <i class="ri-file-download-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `;
                        orderList.insertAdjacentHTML('beforeend', row);
                    });

                    // Pagination
                    if (data.links) {
                        let prevLink = data.links.find(link => link.label.toLowerCase().includes('previous'));
                        let nextLink = data.links.find(link => link.label.toLowerCase().includes('next'));

                        if (prevLink && prevLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchOrder('${query}', ${new URL(prevLink.url).searchParams.get('page')})"
                                    class="px-4 py-1.5 border bg-gray-500 text-gray-50 rounded hover:bg-gray-600 transition-all">
                                    Previous
                                </button>`;
                        }

                        if (nextLink && nextLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchOrder('${query}', ${new URL(nextLink.url).searchParams.get('page')})"
                                    class="px-4 py-1.5 border bg-gray-500 text-gray-50 rounded hover:bg-gray-600 transition-all">
                                    Next
                                </button>`;
                        }
                    }
                })
                .catch(error => {
                    orderList.innerHTML = `
                        <tr>
                            <td colspan="7" class="text-center py-4 text-red-500">Error loading orders.</td>
                        </tr>`;
                    console.error('Error:', error);
                });
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            fetchOrder(this.value, 1, startDate, endDate);
        });
    </script>
@endpush
