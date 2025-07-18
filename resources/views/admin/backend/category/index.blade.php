@extends('admin.layouts.app')
@section('title', 'All Categories')

@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-3">
        <!-- Page Heading -->
        <div class="px-4 pt-6 flex flex-col gap-1">
            <h1 class="text-2xl font-semibold text-gray-800">Categories Management</h1>
            <p class="text-sm text-gray-500">Track, filter, and manage all categories and status.</p>
        </div>
        <!-- Header Section -->
        <div class="p-3 flex items-center justify-between gap-4 flex-wrap">
            <!-- Search Box -->
            <div
                class="flex items-center md:w-[250px] w-full gap-2 bg-gray-50 rounded ring-1 ring-gray-300 focus-within:ring-2 focus-within:ring-blue-500 h-10">
                <i class="ri-search-line text-gray-500 ml-2 text-lg"></i>
                <input id="searchInput" type="text" placeholder="Search" name="search"
                    class="flex-1 px-0 bg-transparent text-gray-700 outline-none border-none focus:ring-0 focus:outline-none h-full">
            </div>

            <!-- Add Category Button -->
            <a href="{{ route('categories.create') }}"
                class="bg-teal-500 flex flex-row items-center justify-center text-white px-4 py-2 md:w-auto w-full rounded text-sm font-medium hover:bg-teal-600 transition h-10">
                Add Categories
            </a>
        </div>

        <!-- Data Table -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Image</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-left uppercase">Category</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-center uppercase">Subcategories</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-center uppercase">Product</th>
                            <th class="px-6 py-2 text-gray-700 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="categoryList">
                        <!-- Categories will be loaded here -->
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
            fetchCategories();
        });

        function fetchCategories(query = '', page = 1) {
            const categoryList = document.querySelector('.categoryList');
            const paginationLinks = document.getElementById('paginationLinks');

            // Show loading message
            categoryList.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Loading categories...</td>
                </tr>`;
            paginationLinks.innerHTML = '';

            fetch(`{{ route('categories.api') }}?search=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    categoryList.innerHTML = '';
                    paginationLinks.innerHTML = '';

                    if (data.data.length === 0) {
                        categoryList.innerHTML = `
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">No categories found.</td>
                            </tr>`;
                        return;
                    }

                    data.data.forEach(category => {
                        const row = `
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${category.id}</td>
                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                    ${category.category_img 
                                        ? `<img src="/storage/${category.category_img}" class="w-12 h-12 object-cover rounded">`
                                        : `<span>No Image</span>`}
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap capitalize">${category.category_name}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap text-center">${category.subcategory_count}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap text-center">${category.product_count}</td>
                                <td class="px-6 py-2 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="categories/show/${category.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-eye-line"></i></a>
                                        <a href="categories/edit/${category.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-edit-box-line"></i></a>
                                        <a onclick="return confirm('Are you sure?')" href="categories/destroy/${category.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-delete-bin-6-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                        `;
                        categoryList.insertAdjacentHTML('beforeend', row);
                    });

                    // Pagination
                    if (data.links) {
                        let prevLink = data.links.find(link => link.label.toLowerCase().includes('previous'));
                        let nextLink = data.links.find(link => link.label.toLowerCase().includes('next'));

                        if (prevLink && prevLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchCategories('${query}', ${new URL(prevLink.url).searchParams.get('page')})"
                                    class="px-4 py-1.5 border bg-gray-500 text-gray-50 rounded">
                                    Previous
                                </button>`;
                        }

                        if (nextLink && nextLink.url) {
                            paginationLinks.innerHTML += `
                                <button onclick="fetchCategories('${query}', ${new URL(nextLink.url).searchParams.get('page')})"
                                    class="px-4 py-1.5 border bg-gray-500 text-gray-50 rounded">
                                    Next
                                </button>`;
                        }
                    }
                })
                .catch(error => {
                    categoryList.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center py-4 text-red-500">Error loading categories.</td>
                        </tr>`;
                    console.error('Error:', error);
                });
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            fetchCategories(this.value);
        });
    </script>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "{{ session('success') }}",
                icon: "success",
                draggable: true
            });
        </script>
    @endif
@endpush
