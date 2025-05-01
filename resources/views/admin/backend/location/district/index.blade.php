@extends('admin.layouts.app')
@section('title', 'All District')
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

            <div class="flex flex-row w-full gap-2 md:gap-3 md:w-auto">
                <a href="{{ route('country.index') }}"
                    class="bg-blue-500 flex flex-row items-center justify-center text-white px-4 md:py-2 py-2.5 md:w-auto w-full rounded text-sm font-medium hover:bg-blue-600 transition">
                    <i class="ri-arrow-left-line mr-1"></i>
                    Back
                </a>
                <a href="{{ route('district.create') }}"
                    class="bg-teal-500 flex flex-row items-center justify-center text-white px-4 md:py-2 py-2.5 md:w-auto w-full rounded text-sm font-medium hover:bg-teal-600 transition">
                    Add District
                </a>
            </div>
        </div>

        <!-- Data Table -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">District</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Division</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Date</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="districtList">
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Loading districts...</td>
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
            fetchDistrict();
        });

        function fetchDistrict(query = '', page = 1) {
            const districtList = document.querySelector('.districtList');
            // Show loading state
            districtList.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Loading districts...</td>
                </tr>`;

            fetch(`{{ route('district.api') }}?search=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    districtList.innerHTML = ''; // Clear loading message

                    if (data.data.length === 0) {
                        districtList.innerHTML = `
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">No districts found.</td>
                            </tr>`;
                        return;
                    }

                    // Loop through the data and insert rows
                    data.data.forEach(district => {
                        const formattedDate = new Date(district.created_at).toLocaleDateString('en-US');
                        const row = `
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-2 text-gray-700 text-sm whitespace-nowrap">${district.id}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${district.name}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${district.division.name}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${formattedDate}</td>
                                <td class="px-6 pt-4 flex flex-row justify-center gap-3 items-center text-center whitespace-nowrap">
                                    <a href="district/edit/${district.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-edit-box-line"></i></a>
                                    <a href="district/destroy/${district.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-delete-bin-6-line"></i></a>
                                </td>
                            </tr>`;
                        districtList.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    districtList.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Error loading districts. Please try again later.</td>
                        </tr>`;
                });
        }

        // Search handler
        document.getElementById('searchInput').addEventListener('input', function() {
            fetchDistrict(this.value); // Trigger fetch when search input changes
        });
    </script>
@endpush
