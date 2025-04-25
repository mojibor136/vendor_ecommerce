@extends('admin.layouts.app')
@section('title', 'All Subscription')
@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-6">
        <!-- Header Section -->
        <div class="p-3 flex items-center justify-between gap-4 flex-wrap">
            <!-- Search Box -->
            <div
                class="flex items-center md:w-[250px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-9.5">
                <i class="ri-search-line text-gray-500 ml-2 text-lg"></i>
                <input id="searchInput" type="text" placeholder="Search..." name="search"
                    class="flex-1 px-0 bg-transparent text-gray-700 outline-none border-none focus:ring-0 focus:outline-none h-full">
            </div>

            <!-- Add Category Button -->
            <a href="{{ route('subscription.create') }}"
                class="bg-teal-500 flex flex-row items-center justify-center text-white px-4 md:py-2 py-2.5 md:w-auto w-full rounded text-sm font-medium hover:bg-teal-600 transition">
                Add Subscription
            </a>
        </div>

        <!-- Data Table -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Name</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Product</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Price</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-center uppercase">Days</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-center uppercase">Sells</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="subscriptionList">
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
            fetchSubscriptions();
        });

        function fetchSubscriptions(query = '', page = 1) {
            fetch(`{{ route('subscription.api') }}?search=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const subscriptionList = document.querySelector('.subscriptionList');
                    const paginationLinks = document.getElementById('paginationLinks');
                    subscriptionList.innerHTML = '';
                    paginationLinks.innerHTML = '';

                    data.data.forEach(subscription => {
                        const row = `
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${subscription.id}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${subscription.name}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${subscription.product_limit}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${subscription.price}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm text-center whitespace-nowrap">${subscription.duration_days}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm text-center whitespace-nowrap">${subscription.sells}</td>
                                <td class="px-6 pt-4 flex flex-row gap-3 items-center justify-center text-center whitespace-nowrap">
                                    <a href="subscription/show/${subscription.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-eye-line"></i></a>
                                    <a href="subscription/edit/${subscription.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-edit-box-line"></i></a>
                                    <a href="subscription/destroy/${subscription.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-delete-bin-6-line"></i></a>
                                </td>
                            </tr>
                        `;
                        subscriptionList.insertAdjacentHTML('beforeend', row);
                    });

                    // Pagination Links
                    if (data.links) {
                        let prevLink = data.links.find(link => link.label.toLowerCase().includes('previous'));
                        let nextLink = data.links.find(link => link.label.toLowerCase().includes('next'));

                        if (prevLink && prevLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchSubscriptions('${query}', ${new URL(prevLink.url).searchParams.get('page')})" 
                                    class="px-4 py-1.5 border bg-gray-500 text-gray-50 rounded">
                                    Previous
                                </button>`;
                        }

                        if (nextLink && nextLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchSubscriptions('${query}', ${new URL(nextLink.url).searchParams.get('page')})" 
                                    class="px-4 py-1.5 border bg-gray-500 text-gray-50 rounded">
                                    Next
                                </button>`;
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            fetchSubscriptions(this.value);
        });
    </script>
@endpush
