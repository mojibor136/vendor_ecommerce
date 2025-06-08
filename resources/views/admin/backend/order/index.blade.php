@extends('admin.layouts.app')
@section('title', 'All Order')

@section('content')
    <style>
        /* Overlay */
        .popup-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 16px;
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Box */
        .popup-box {
            background: white;
            border-radius: 8px;
            padding: 24px;
            width: 100%;
            max-width: 1000px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        /* Header */
        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f3f4f6;
            padding: 16px;
            border-radius: 6px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .popup-title-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .popup-title {
            font-size: 20px;
            font-weight: 600;
            color: #374151;
        }

        .popup-subtitle {
            font-size: 14px;
            color: #6b7280;
        }

        .popup-close-btn {
            padding: 8px 16px;
            background: #4b5563;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup-close-btn:hover {
            background: #374151;
        }

        /* Summary Cards */
        .summary-cards {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .summary-card {
            flex: 1;
            min-width: 100px;
            border-radius: 6px;
            padding: 16px;
            text-align: center;
        }

        .summary-card p {
            margin: 0;
        }

        .summary-number {
            font-size: 20px;
            font-weight: bold;
        }

        .summary-label {
            font-size: 12px;
            font-weight: 500;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
            margin-top: 16px;
        }

        .courier-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .courier-table th,
        .courier-table td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        .no-data {
            padding: 16px;
            text-align: center;
            color: #9ca3af;
        }

        .courier-row:hover {
            background-color: #e0f2fe;
            transition: background 0.3s;
        }

        /* Utility Colors */
        .bg-blue {
            background: #3b82f6;
        }

        .bg-green {
            background: #22c55e;
        }

        .bg-yellow {
            background: #eab308;
        }

        .bg-red {
            background: #ef4444;
        }

        .bg-purple {
            background: #a855f7;
        }

        .bg-blue-light {
            background: #dbeafe;
        }

        .bg-green-light {
            background: #dcfce7;
        }

        .bg-yellow-light {
            background: #fef9c3;
        }

        .bg-red-light {
            background: #fee2e2;
        }

        .bg-purple-light {
            background: #f3e8ff;
        }

        .text-white {
            color: #ffffff;
        }

        .text-blue {
            color: #2563eb;
        }

        .text-green {
            color: #16a34a;
        }

        .text-yellow {
            color: #ca8a04;
        }

        .text-red {
            color: #dc2626;
        }

        .text-purple {
            color: #9333ea;
        }

        .border-left {
            border-left: 3px solid #3b82f6;
            border-radius: 6px 0 0 6px;
        }

        .border-right {
            border-right: 3px solid #a855f7;
            border-radius: 0 6px 6px 0;
        }
    </style>

    <div class="bg-white w-full h-full flex flex-col gap-3">
        <!-- Page Heading -->
        <div class="px-4 pt-6 flex flex-col gap-1">
            <h1 class="text-2xl font-semibold text-gray-800">Order Management</h1>
            <p class="text-sm text-gray-500">Track, filter, and manage all customer orders and their payment statuses.</p>
        </div>

        <!-- Header Section -->
        <div class="p-3 flex items-center justify-between gap-4 flex-wrap">
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-3 md:space-y-0 w-full">
                <!-- Search Input -->
                <div
                    class="flex items-center md:w-[250px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-10">
                    <i class="ri-search-line text-gray-500 ml-2 text-lg"></i>
                    <input id="searchInput" type="text" placeholder="Search" name="search"
                        class="flex-1 px-0 bg-transparent text-gray-700 outline-none border-none focus:ring-0 focus:outline-none h-full text-sm">
                </div>

                <!-- Status Filter Dropdown -->
                <div
                    class="flex items-center md:w-[200px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-10">
                    <select id="statusFilter" name="status"
                        class="flex-1 bg-transparent text-gray-700 outline-none border-none px-3 focus:ring-0 focus:outline-none h-full text-sm cursor-pointer">
                        <option value="">All Order Status</option>
                        <option value="pending">Pending</option>
                        <option value="processed">Processed</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <!-- Date Range Picker -->
                <div class="flex items-center gap-2 flex-wrap md:flex-nowrap">
                    <input type="date" id="startDate"
                        class="px-3 py-2 border border-gray-300 text-gray-700 rounded focus:border-green-600 focus:outline-none" />
                    <input type="date" id="endDate"
                        class="px-3 py-2 border border-gray-300 text-gray-700 rounded focus:border-green-600 focus:outline-none" />
                </div>
            </div>
        </div>

        <form id="courierForm" action="{{ route('courier.check') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="orderId" id="orderId" value="">
        </form>

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
                            <th class="px-6 py-2 text-gray-700 text-xs text-center uppercase">Courier</th>
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


    <!-- Courier Information -->

    @if (session('response'))
        @php
            $response = session('response', []);
            $couriers = collect($response['courierData'] ?? [])->except('summary');

            $totalParcels = $couriers->sum('total_parcel');
            $totalSuccess = $couriers->sum('success_parcel');
            $totalCancel = $couriers->sum('cancelled_parcel');
            $successRate = $totalParcels > 0 ? round(($totalSuccess / $totalParcels) * 100, 1) : 0;
        @endphp
        <div id="popup" class="popup-overlay">
            <div class="popup-box">
                <!-- Header -->
                <div class="popup-header">
                    <div class="popup-title-group">
                        <span class="popup-title">Courier Information</span>
                        <span class="popup-subtitle">
                            Mobile: <span class="text-green">{{ $response['phone'] ?? 'N/A' }}</span>
                        </span>
                    </div>
                    <button onclick="togglePopup()" class="popup-close-btn">Close</button>
                </div>

                <!-- Order Summary -->
                <div class="summary-cards">
                    <div class="summary-card blue">
                        <p class="summary-number">{{ $totalParcels }}</p>
                        <p class="summary-label">TOTAL ORDER</p>
                    </div>
                    <div class="summary-card green">
                        <p class="summary-number">{{ $totalSuccess }}</p>
                        <p class="summary-label">TOTAL DELIVERY</p>
                    </div>
                    <div class="summary-card red">
                        <p class="summary-number">{{ $totalCancel }}</p>
                        <p class="summary-label">TOTAL CANCEL</p>
                    </div>
                </div>

                <!-- Courier Data Table -->
                <div class="table-container">
                    <table class="courier-table">
                        <thead>
                            <tr>
                                <th class="bg-blue text-white">Courier Name</th>
                                <th class="bg-green text-white">Order</th>
                                <th class="bg-yellow text-white">Delivery</th>
                                <th class="bg-red text-white">Cancel</th>
                                <th class="bg-purple text-white">Success Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($response['courierData']) || count($response['courierData']) == 0)
                                <tr>
                                    <td colspan="5" class="no-data">No data found</td>
                                </tr>
                            @else
                                @foreach ($response['courierData'] as $name => $courier)
                                    @if ($name !== 'summary')
                                        <tr class="courier-row">
                                            <td class="bg-blue-light text-blue border-left">{{ ucfirst($name) }}</td>
                                            <td class="bg-green-light text-green">{{ $courier['total_parcel'] ?? 0 }}</td>
                                            <td class="bg-yellow-light text-yellow">{{ $courier['success_parcel'] ?? 0 }}
                                            </td>
                                            <td class="bg-red-light text-red">{{ $courier['cancelled_parcel'] ?? 0 }}</td>
                                            <td class="bg-purple-light text-purple border-right">
                                                {{ $courier['success_ratio'] ?? 'N/A' }}%</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    @if (session('response'))
        <script>
            togglePopup();
        </script>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    @if (session('response'))
        <script>
            function togglePopup() {
                const popup = document.getElementById("popup");
                popup.classList.toggle("hidden");
                popup.classList.toggle("flex");
            }

            document.addEventListener('DOMContentLoaded', function() {
                togglePopup();
            });
        </script>
    @endif

    <script>
        function submitOrderForm(orderId) {
            document.getElementById('orderId').value = orderId;
            document.getElementById('courierForm').submit();
        }

        $(document).ready(function() {
            fetchOrder();

            $('#statusFilter').on('change', function() {
                fetchOrderWithFilters();
            });

            $('#searchInput').on('input', function() {
                fetchOrderWithFilters();
            });

            $('#startDate, #endDate').on('change', function() {
                fetchOrderWithFilters();
            });
        });

        function fetchOrderWithFilters(page = 1) {
            const query = $('#searchInput').val();
            const status = $('#statusFilter').val();
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();

            fetchOrder(query, page, status, startDate, endDate);
        }

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

        function fetchOrder(query = '', page = 1, status = '', startDate = '', endDate = '') {
            const orderList = document.querySelector('.orderList');
            const paginationLinks = document.getElementById('paginationLinks');

            orderList.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Loading...</td>
                </tr>`;
            paginationLinks.innerHTML = '';

            fetch(
                    `{{ route('order.api') }}?search=${query}&page=${page}&status=${status}&start_date=${startDate}&end_date=${endDate}`
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
                                    <button onclick="submitOrderForm(${order.id})" class="py-1 px-3 bg-blue-500 text-white rounded text-xs hover:bg-blue-600">Check
                                    </button>
                                </td>
                                <td class="px-6 py-2 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="/admin/order/show/${order.seller.shop_name?.toLowerCase()}/${order.id}" 
                                            class="text-gray-600 hover:text-blue-600 text-[19px] flex items-center justify-center">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you want to delete this order?')" 
                                            href="categories/destroy/${order.id}" 
                                            class="text-gray-600 hover:text-red-600 text-[19px] flex items-center justify-center">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </a>
                                        <a href="orders/invoice/${order.id}" 
                                            class="text-gray-600 text-[19px] flex items-center justify-center" 
                                            title="Invoice">
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
            const query = this.value;
            const status = $('#statusFilter').val();
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            fetchOrder(query, 1, status, startDate, endDate);
        });
    </script>
@endpush
