@extends('seller.layouts.app')
@section('title', 'All Subcategories')
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
        </div>

        <!-- Data Table with Scroll -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Subcategories</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Product Count</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Category</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="subcategoryList">

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
            fetchSubCategories();
        });

        function fetchSubCategories(query = '', page = 1) {
            fetch(`{{ route('seller.subcategories.api') }}?search=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const subcategoryList = document.querySelector('.subcategoryList');
                    const paginationLinks = document.getElementById('paginationLinks');
                    subcategoryList.innerHTML = '';
                    paginationLinks.innerHTML = '';

                    data.data.forEach(subcategory => {
                        const row = `
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-2 text-gray-700 text-sm whitespace-nowrap">${subcategory.id}</td>
                    <td class="px-6 py-2 text-gray-700 text-sm whitespace-nowrap">${subcategory.subcategory_name}</td>
                    <td class="px-6 py-2 text-gray-700 text-sm whitespace-nowrap">${subcategory.seller_products_count}</td>
                    <td class="px-6 py-2 text-gray-700 text-sm whitespace-nowrap">${subcategory.category.category_name}</td>
                    <td class="px-6 py-2 text-center whitespace-nowrap">
                        <a href="subcategories/show/${subcategory.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-eye-line"></i></a>
                    </td>
                </tr>
                `;
                        subcategoryList.insertAdjacentHTML('beforeend', row);
                    });

                    // Pagination Links
                    if (data.links) {
                        let prevLink = data.links.find(link => link.label.toLowerCase().includes('previous'));
                        let nextLink = data.links.find(link => link.label.toLowerCase().includes('next'));

                        if (prevLink && prevLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchSubCategories('${query}', ${new URL(prevLink.url).searchParams.get('page')})" 
                                    class="px-4 py-1.5 border bg-gray-400 text-gray-50 rounded">
                                    Previous
                                </button>`;
                        }

                        if (nextLink && nextLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchSubCategories('${query}', ${new URL(nextLink.url).searchParams.get('page')})" 
                                    class="px-4 py-1.5 border bg-gray-400 text-gray-50 rounded">
                                    Next
                                </button>`;
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            fetchSubCategories(this.value);
        });
    </script>
@endpush
