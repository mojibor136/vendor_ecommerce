@extends('admin.layouts.app')
@section('title', 'All Division')
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
                <a href="{{ route('division.create') }}"
                    class="bg-teal-500 flex flex-row items-center justify-center text-white px-4 md:py-2 py-2.5 md:w-auto w-full rounded text-sm font-medium hover:bg-teal-600 transition">
                    Add Division
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
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Division</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Country</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">District</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Date</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divisionList">
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Loading divisions...</td>
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
            fetchDivision();
        });

        function fetchDivision(query = '', page = 1) {
            const divisionList = document.querySelector('.divisionList');
            // Display loading message while fetching data
            divisionList.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Loading divisions...</td>
                </tr>`;

            fetch(`{{ route('division.api') }}?search=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    divisionList.innerHTML = ''; // Clear the loading message

                    if (data.data.length === 0) {
                        divisionList.innerHTML = `
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">No divisions found.</td>
                            </tr>`;
                        return;
                    }

                    // Populate division data
                    data.data.forEach(division => {
                        const formattedDate = new Date(division.created_at).toLocaleDateString('en-US');
                        const row = `
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-2 text-gray-700 text-sm whitespace-nowrap">${division.id}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${division.name}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${division.country.name}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${division.district_count}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${formattedDate}</td>
                                <td class="px-6 pt-4 flex flex-row gap-3 justify-center items-center text-center whitespace-nowrap">
                                    <a href="division/edit/${division.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-edit-box-line"></i></a>
                                    <a href="division/destroy/${division.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-delete-bin-6-line"></i></a>
                                </td>
                            </tr>`;
                        divisionList.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    divisionList.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Error loading divisions. Please try again later.</td>
                        </tr>`;
                });
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            fetchDivision(this.value); // Trigger fetch on search input change
        });
    </script>
@endpush
