@extends('admin.layouts.app')
@section('title', 'All Seller')
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

        <!-- Data Table -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase whitespace-nowrap">ID</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase whitespace-nowrap">Owner Name
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase whitespace-nowrap">Store Name
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase whitespace-nowrap">Ratings</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Products
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Status</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Verification
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Subscription
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Create Date
                            </th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody class="sellerList">
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                <div id="paginationLinks" class="flex justify-end mt-4"></div>
            </div>
        </div>
    </div>

    <!-- Modal Overlay -->
    <div id="editModal" class="fixed inset-0 z-50 bg-black/30 flex items-center w-full justify-center hidden">
        <!-- Modal Box -->
        <div class="bg-white rounded-md border shadow-lg p-6 w-[400px]">
            <h2 class="text-xl font-bold mb-4">Seller Status</h2>

            <input type="hidden" id="modalSellerId">

            <div class="mb-4">
                <label for="statusSelect" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="statusSelect"
                    class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="deactive">Deactive</option>
                    <option value="active">Active</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 mt-6">
                <button onclick="closeModal()"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                <button onclick="updateSellerStatus()"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            fetchSeller();
        });

        const updateStatusRoute = "{{ route('seller.verification.status', ['id' => ':id']) }}";

        function limitText(text, length = 30) {
            return text.length > length ? text.slice(0, length) + '...' : text;
        }

        function fetchSeller(query = '', page = 1) {
            fetch(`{{ route('seller.api') }}?search=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const sellerList = document.querySelector('.sellerList');
                    sellerList.innerHTML = '';

                    data.data.forEach(seller => {
                        const formattedDate = new Date(seller.created_at).toLocaleDateString(
                            'en-US');
                        const productCount = seller.products.length;

                        let rating = 0;
                        if (seller.products.length > 0) {
                            const totalRating = seller.products.reduce((sum, product) => sum + product.rating,
                                0);
                            rating = totalRating / seller.products.length;
                        }

                        const verificationColorClass = seller.verification_status === 'pending' ?
                            'bg-yellow-500' :
                            seller.verification_status === 'verified' ?
                            'bg-green-600' :
                            seller.verification_status === 'rejected' ?
                            'bg-red-500' :
                            'bg-gray-700';

                        const subscriptionColorClass = seller.subscription_status === 'active' ?
                            'bg-green-600' :
                            seller.subscription_status === 'deactive' ?
                            'bg-red-500' :
                            'bg-gray-700';

                        const statusColorClass = seller.status === 'active' ?
                            'bg-green-600' :
                            seller.status === 'deactive' ?
                            'bg-red-500' :
                            'bg-gray-700';
                        const averageRating = seller.average_rating !== null ? `${seller.average_rating} ★` :
                            'No ratings';
                        const row = `
                            <tr class="border-b hover:bg-gray-100 vertical-align">
                                <td class="px-6 py-2 text-gray-700 text-sm whitespace-nowrap">${seller.id}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                       <img src="/storage/${seller.image}" class="w-10 h-10 shrink-0 rounded-full object-cover" alt="Owner 1">
                                       <span class="font-semibold text-md">${seller.name}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${seller.shop_name}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${averageRating}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap text-center">${productCount}</td>
                                <td class="px-6 py-1 text-white text-[13px] whitespace-nowrap capitalize">
                                    <a class="px-3 rounded-lg flex items-center justify-center ${statusColorClass}">${seller.status}</a>
                                </td>
                                <td class="px-6 py-1 text-white text-[13px] whitespace-nowrap capitalize">
                                   <a class="px-1 rounded-lg flex items-center justify-center ${verificationColorClass}">${seller.verification_status}</a>
                                </td>
                                <td class="px-6 py-1 text-white text-[13px] whitespace-nowrap capitalize">
                                    <a class="px-1 rounded-lg flex items-center justify-center ${subscriptionColorClass}">${seller.subscription_status}</a>
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">${formattedDate}</td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap text-center align-middle">
                                    <div class="flex flex-row items-center justify-center gap-2">
                                        <a href="#" onclick="showEditModal(${seller.id}, '${seller.status}')" class="text-lg text-gray-700"><i class="ri-edit-box-line"></i></a>
                                        <a href="seller/show/${seller.id}" class="inline-block text-gray-600 text-[19px]"><i class="ri-eye-line"></i></a>
                                        <a href="seller/destroy/${seller.id}" class="text-lg text-gray-700"><i class="ri-delete-bin-7-line"></i></a>
                                    </div>
                                </td>
                            </tr>`;
                        sellerList.insertAdjacentHTML('beforeend', row);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            fetchSeller(this.value);
        });

        // Show Modal
        function showEditModal(sellerId, currentStatus) {
            document.getElementById('modalSellerId').value = sellerId;
            document.getElementById('statusSelect').value = currentStatus;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }

        // Close Modal
        function closeModal() {
            document.getElementById('editModal').classList.remove('flex');
            document.getElementById('editModal').classList.add('hidden');
        }

        // Update Seller Status
        function updateSellerStatus() {
            const sellerId = document.getElementById('modalSellerId').value;
            const newStatus = document.getElementById('statusSelect').value;

            const url = updateStatusRoute.replace(':id', sellerId); // route name থেকে বানানো url

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeModal();
                        fetchSeller();
                    } else {
                        alert('Status update failed!');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endpush
