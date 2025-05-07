@extends('admin.layouts.app')
@section('title', 'Seller Payment')

@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-6">
        <!-- Filter Section -->
        <div class="p-3 flex items-center justify-between gap-4 flex-wrap">
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-3 md:space-y-0 w-full">
                <!-- Method Filter Dropdown -->
                <div
                    class="flex items-center md:w-[200px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-10">
                    <select id="methodFilter" name="method"
                        class="flex-1 bg-transparent text-gray-700 outline-none border-none px-3 focus:ring-0 focus:outline-none h-full text-sm cursor-pointer">
                        <option value="">All Methods</option>
                        <option value="bkash">BKash</option>
                        <option value="nagad">Nagad</option>
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

        <!-- Data Table -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-700 uppercase text-xs text-left">Order ID</th>
                            <th class="px-6 py-2 text-gray-700 uppercase text-xs text-left">Shop</th>
                            <th class="px-6 py-2 text-gray-700 uppercase text-xs text-left">Amount</th>
                            <th class="px-6 py-2 text-gray-700 uppercase text-xs text-left">Method</th>
                            <th class="px-6 py-2 text-gray-700 uppercase text-xs text-left">Status</th>
                            <th class="px-6 py-2 text-gray-700 uppercase text-xs text-left">Order Status</th>
                            <th class="px-6 py-2 text-gray-700 uppercase text-xs text-left">Payment Date</th>
                        </tr>
                    </thead>
                    <tbody class="paymentList">
                        <!-- Orders will load here -->
                    </tbody>
                </table>
            </div>
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
            fetchOrderPayment();

            // Filter input changes
            $('#methodFilter, #startDate, #endDate').on('change', function() {
                fetchOrderPayment();
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

        function getMethodColor(status) {
            switch (status.toLowerCase()) {
                case 'bkash':
                    return 'bg-pink-600';
                case 'nagad':
                    return 'bg-orange-600';
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

        function fetchOrderPayment(page = 1) {
            const method = $('#methodFilter').val();
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();

            const paymentList = document.querySelector('.paymentList');
            const paginationLinks = document.getElementById('paginationLinks');

            paymentList.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Loading...</td>
                </tr>`;
            paginationLinks.innerHTML = '';

            // API call with selected filters (method and date range)
            fetch(
                    `{{ route('seller.payment.api') }}?method=${method}&start_date=${startDate}&end_date=${endDate}&page=${page}`
                )
                .then(response => response.json())
                .then(data => {
                    paymentList.innerHTML = '';
                    paginationLinks.innerHTML = '';

                    if (data.data.length === 0) {
                        paymentList.innerHTML = `
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">No orders found.</td>
                            </tr>`;
                        return;
                    }

                    data.data.forEach(payment => {
                        const statusColor = getStatusColor(payment.order.order_status);
                        const methodColor = getMethodColor(payment.method);
                        const paymentColor = getPaymentColor(payment.status);

                        const row = `
                            <tr class="border-b hover:bg-gray-100 transition-all">
                                <td class="px-6 py-2 text-gray-700 text-sm capitalize">#${payment.order_id}</td>
                                <td class="px-6 py-2 text-gray-700 text-sm capitalize">${payment.seller.shop_name}</td>
                                <td class="px-6 py-2 text-gray-700 text-sm capitalize">${payment.amount}</td>
                                <td class="px-6 py-1 text-sm capitalize">
                                    <span title="${payment.method}" class="px-2 py-1 rounded text-white text-xs font-medium  ${methodColor}">
                                        ${payment.method}
                                    </span>
                                </td>
                                <td class="px-6 py-1 text-sm capitalize">
                                    <span title="${payment.status}" class="px-2 py-1 rounded text-white text-xs font-medium ${paymentColor}">
                                        ${payment.status}
                                    </span>
                                </td>
                                <td class="px-6 py-1 text-sm capitalize">
                                    <span title="${payment.order.order_status}" class="px-2 py-1 rounded text-white text-xs font-medium ${statusColor}">
                                        ${payment.order.order_status}
                                    </span>
                                </td>
                                <td class="px-6 py-2 text-gray-700 text-sm capitalize">${payment.formatted_date}</td>
                            </tr>`;
                        paymentList.insertAdjacentHTML('beforeend', row);
                    });

                    // Pagination
                    if (data.links) {
                        let prevLink = data.links.find(link => link.label.toLowerCase().includes('previous'));
                        let nextLink = data.links.find(link => link.label.toLowerCase().includes('next'));

                        if (prevLink && prevLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchOrderPayment(${new URL(prevLink.url).searchParams.get('page')})"
                                    class="px-4 py-1.5 border bg-gray-500 text-gray-50 rounded hover:bg-gray-600 transition-all">
                                    Previous
                                </button>`;
                        }

                        if (nextLink && nextLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchOrderPayment(${new URL(nextLink.url).searchParams.get('page')})"
                                    class="px-4 py-1.5 border bg-gray-500 text-gray-50 rounded hover:bg-gray-600 transition-all">
                                    Next
                                </button>`;
                        }
                    }
                })
                .catch(error => {
                    paymentList.innerHTML = `
                        <tr>
                            <td colspan="7" class="text-center py-4 text-red-500">Error loading orders.</td>
                        </tr>`;
                    console.error('Error:', error);
                });
        }
    </script>
@endpush
