@extends('admin.layouts.app')
@section('title', 'Order Invoice')

@section('content')
    <div class="max-w-5xl mx-auto p-6 bg-white shadow-md rounded-lg text-sm font-sans">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show bg-green-100 text-green-800 p-3 rounded mb-4"
                role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show bg-red-100 text-red-800 p-3 rounded mb-4"
                role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="flex justify-between items-center border-b pb-4 mb-6 w-full">
            <div>
                <h1 class="text-2xl font-bold mb-1">Order Invoice</h1>
                <p class="text-gray-600">Date: {{ now()->format('Y-m-d') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Order Status Change -->
                <form method="POST" action="{{ route('order.status') }}">
                    @csrf
                    <input type="hidden" value="{{ $order->id }}" name="id">
                    <div class="flex items-center gap-2">
                        <select name="status" id="order-status-select"
                            class="border border-gray-300 px-3 py-2 rounded text-sm text-gray-700 min-w-[120px]">
                            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped
                            </option>
                            <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                Processing</option>
                            <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered
                            </option>
                            <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled
                            </option>
                        </select>
                        <button type="submit" id="update-status-btn"
                            class="bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 text-sm">
                            Update
                        </button>
                    </div>
                </form>

                <!-- Print Button -->
                <a href="#" onclick="window.print()"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Print Invoice
                </a>
            </div>
        </div>


        <!-- Seller & Customer Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Seller -->
            <div class="border p-4 rounded">
                <h2 class="text-lg font-semibold mb-2">Seller Details</h2>
                <div class="flex flex-col gap-2">
                    <p class="text-gray-700 capitalize"><span class="font-semibold">Shop:</span>
                        {{ $order->seller->shop_name ?? 'N/A' }}</p>
                    <p class="text-gray-700 capitalize"><span class="font-semibold">Email:</span>
                        {{ $order->seller->email ?? 'N/A' }}</p>
                    <p class="text-gray-700 capitalize"><span class="font-semibold">Phone:</span>
                        {{ $order->seller->phone ?? 'N/A' }}</p>
                    <p class="text-gray-700 capitalize"><span class="font-semibold">Address:</span>
                        {{ $order->seller->country->name ?? 'N/A' }} {{ $order->seller->division->name ?? 'N/A' }}
                        {{ $order->seller->district->name ?? 'N/A' }}
                    </p>
                </div>
            </div>

            <!-- Customer -->
            <div class="border p-4 rounded">
                <h2 class="text-lg font-semibold mb-2">Customer Details</h2>
                <div class="flex flex-col gap-2">
                    <p class="text-gray-700 capitalize"><span class="font-semibold">Name:</span>
                        {{ $order->shipping->shipping_name ?? 'N/A' }}
                    </p>
                    <p class="text-gray-700 capitalize"><span class="font-semibold">Email:</span>
                        {{ $order->shipping->shipping_email ?? 'N/A' }}
                    </p>
                    <p class="text-gray-700 capitalize"><span class="font-semibold">Phone:</span>
                        {{ $order->shipping->shipping_phone ?? 'N/A' }}
                    </p>
                    <p class="text-gray-700 capitalize"><span class="font-semibold">Address:</span>
                        {{ $order->shipping->country->name ?? 'N/A' }} {{ $order->shipping->division->name ?? 'N/A' }}
                        {{ $order->shipping->district->name ?? 'N/A' }} {{ $order->shipping->shipping_address ?? 'N/A' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Order Info -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Order Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-gray-700">
                <div class="bg-blue-100 p-3 rounded">
                    <span class="font-semibold">Order ID:</span> #{{ $order->id }}
                </div>
                <div class="bg-green-100 p-3 rounded capitalize">
                    <span class="font-semibold">Payment Method:</span>
                    {{ $order->payment->method ?? 'N/A' }}
                </div>
                <div class="bg-yellow-100 p-3 rounded">
                    <span class="font-semibold">Order Status:</span> {{ ucfirst($order->order_status) }}
                </div>
                <div class="bg-red-100 p-3 rounded">
                    <span class="font-semibold">Payment Status:</span> {{ ucfirst($order->payment->status ?? 'Unpaid') }}
                </div>
                <div class="bg-purple-100 p-3 rounded">
                    <span class="font-semibold">Transaction ID:</span> {{ $order->payment->transaction_id ?? 'N/A' }}
                </div>
                <div class="bg-pink-100 p-3 rounded">
                    <span class="font-semibold">Paid At:</span>
                    {{ $order->payment->paid_at ? \Carbon\Carbon::parse($order->payment->paid_at)->format('Y-m-d H:i') : 'N/A' }}
                </div>
            </div>
        </div>

        @if ($order->order_status == 'shipped')
            <div class="mb-6 mt-4">
                <h2 class="text-lg font-semibold mb-2">Shipping Details</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 text-gray-700">
                    <div class="bg-blue-50 text-blue-400 p-3 rounded border border-blue-100">
                        <span class="font-semibold capitalize">Courier Name: {{ $order->courier_name ?? 'N/A' }}</span>
                    </div>
                    <div class="bg-blue-50 text-blue-400 p-3 rounded border border-blue-100">
                        <span class="font-semibold capitalize">Tracking Number:</span>
                        {{ $order->tracking_number ?? 'N/A' }}
                    </div>
                    <div class="bg-blue-50 text-blue-400 p-3 rounded border border-blue-100">
                        <span class="font-semibold capitalize">Manual Tracking:</span>
                        {{ $order->is_manual_tracking ? 'Yes' : 'No' }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Product Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-2 px-4 border">Item</th>
                        <th class="py-2 px-4 border">Image</th>
                        <th class="py-2 px-4 border">Name</th>
                        <th class="py-2 px-4 border">Price</th>
                        <th class="py-2 px-4 border text-center">Quantity</th>
                        <th class="py-2 px-4 border text-center">Size</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($order->orderItems as $item)
                        <tr class="border-t">
                            <td class="py-2 px-4 border">#{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border">
                                <img src="{{ asset('storage/' . $item->product_image) }}" alt="product"
                                    class="w-10 h-10 rounded" />
                            </td>
                            <td class="py-2 px-4 border">{{ $item->product_name }}</td>
                            <td class="py-2 px-4 border">BDT {{ number_format($item->price, 2) }}</td>
                            <td class="py-2 px-4 border text-center">{{ $item->quantity }}</td>
                            <td class="py-2 px-4 border text-center">{{ $item->product_size }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-end mt-6">
                <div class="w-64">
                    <div class="flex flex-row justify-between py-3 border-b font-semibold text-gray-700">
                        <span>Subtotal:</span>
                        <span>BDT {{ number_format($order->payment->amount ?? 0, 2) }}</span>
                    </div>
                    <div class="flex flex-row justify-between py-3 border-b font-semibold text-gray-700">
                        <span>Shipping:</span>
                        <span>BDT {{ number_format($order->shipping_charge, 2) }}</span>
                    </div>
                    <div class="flex flex-row justify-between py-2 font-bold text-gray-800 text-md">
                        <span>TOTAL:</span>
                        <span>BDT {{ number_format(($order->payment->amount ?? 0) + $order->shipping_charge, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="status-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white md:p-6 p-3 rounded-lg shadow-lg md:w-[450px] w-full">
            <h2 class="text-xl font-semibold mb-4">Shipping Order</h2>

            <div class="mb-4">
                <label class="block font-semibold mb-2 text-gray-800">Select Shipping Type:</label>
                <select id="shipping-type" class="border border-gray-300 px-3 py-2 rounded w-full">
                    <option value="auto">Auto Shipped</option>
                    <option value="manual">Manually Shipped</option>
                </select>
            </div>

            <form method="POST" action="{{ route('shipped.manual') }}" id="order-status-manual">
                @csrf
                <input type="hidden" value="{{ $order->id }}" name="id">
                <div id="manual-shipping" class="hidden">
                    <div class="mb-4">
                        <label class="block font-semibold mb-2 text-gray-800">Courier Name:</label>
                        <select class="border border-gray-300 px-3 py-2 rounded w-full" name="courier_name"
                            id="courier_name" required>
                            <option value="" selected disabled>Select Courier</option>
                            <option value="sundarban">Sundarban Courier</option>
                            <option value="pathao">Pathao Courier</option>
                            <option value="redx">REDX Courier</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1 text-gray-800">Tracking Number:</label>
                        <input type="text" name="tracking_number" id="tracking_number" required
                            class="border border-gray-300 px-3 py-2 rounded w-full" placeholder="XXXXXXXXXXXXX">
                    </div>
                </div>
            </form>

            <form method="POST" action="{{ route('shipped.auto') }}" id="order-status-auto">
                @csrf
                <input type="hidden" value="{{ $order->id }}" name="id">
            </form>

            <div class="flex justify-end gap-2">
                <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded"
                    id="close-modal-btn">Cancel</button>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded"
                    id="submit-status-btn">Submit</button>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('update-status-btn').addEventListener('click', function() {
            var status = document.getElementById('order-status-select').value;

            // If "Shipped" is selected, show the modal
            if (status === 'shipped') {
                event.preventDefault();
                document.getElementById('status-modal').classList.remove('hidden');
            }
        });

        document.getElementById('shipping-type').addEventListener('change', function() {
            var shippingType = this.value;

            // Toggle between manual and auto shipping
            if (shippingType === 'manual') {
                document.getElementById('manual-shipping').classList.remove('hidden');
            } else {
                document.getElementById('manual-shipping').classList.add('hidden');
            }
        });

        document.getElementById('close-modal-btn').addEventListener('click', function() {
            document.getElementById('status-modal').classList.add('hidden');
        });

        // Handle form submission
        document.getElementById('submit-status-btn').addEventListener('click', function() {
            var shippingType = document.getElementById('shipping-type').value;

            if (shippingType === 'manual') {
                var courier = document.getElementById('courier_name').value;
                var tracking = document.getElementById('tracking_number').value;

                if (!courier) {
                    alert('Please select a courier name.');
                    return;
                }

                if (!tracking.trim()) {
                    alert('Please enter a tracking number.');
                    return;
                }
                document.getElementById('order-status-manual').submit();
            } else {
                document.getElementById('order-status-auto').submit();
            }
        });
    </script>
@endpush
