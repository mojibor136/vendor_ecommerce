@extends('admin.layouts.app')
@section('title', 'Subscription Payment')

@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-5">
        <!-- Page Heading -->
        <div class="px-4 pt-6 flex flex-col gap-1">
            <h1 class="text-2xl font-semibold text-gray-800">Subscription Payment List</h1>
            <p class="text-sm text-gray-500">Filter and view all subscription payment details from seller.</p>
        </div>


        <!-- Filter Section -->
        <div class="px-4 flex items-center justify-between gap-4 flex-wrap">
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
                            <th class="px-6 py-2 text-gray-700 text-xs text-left whitespace-nowrap uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left whitespace-nowrap uppercase">Shop</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left whitespace-nowrap uppercase">Subscription
                            </th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left whitespace-nowrap uppercase">Payment Method
                            </th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left whitespace-nowrap uppercase">Amount</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left whitespace-nowrap uppercase">Transaction
                            </th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left whitespace-nowrap uppercase">Renew Date
                            </th>
                        </tr>
                    </thead>
                    <tbody class="paymentList">
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
            fetchOrderPayment();

            // Filter input changes
            $('#methodFilter, #startDate, #endDate').on('change', function() {
                fetchOrderPayment();
            });
        });

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
                    `{{ route('subscription.payment.api') }}?method=${method}&start_date=${startDate}&end_date=${endDate}&page=${page}`
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
                        const methodColor = getMethodColor(payment.method);

                        const row = `
                            <tr class="border-b hover:bg-gray-100 transition-all">
                                <td class="px-6 py-3 text-gray-700 text-sm capitalize">#${payment.id}</td>
                                <td class="px-6 text-gray-700 text-sm capitalize">${payment.seller.shop_name}</td>
                                <td class="px-6 text-gray-700 text-sm capitalize">${payment.subscription.name}</td>
                                <td class="px-6 text-sm capitalize">
                                    <span title="${payment.method}" class="px-2 py-1 rounded text-white text-xs font-medium  ${methodColor}">
                                        ${payment.method}
                                    </span>
                                </td>
                                <td class="px-6 text-gray-700 text-sm capitalize">${payment.amount}</td>
                                <td class="px-6 text-gray-700 text-sm capitalize">${payment.transaction_id}</td>
                                <td class="px-6 text-gray-700 text-sm capitalize">${payment.formatted_date}</td>
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
