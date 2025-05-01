@extends('admin.layouts.app')

@section('title', 'Seller Orders')

@section('content')
    <div class="bg-white px-4 py-4 w-full h-full">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('sales.report') }}"
                class="inline-flex items-center text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-4 py-2.5">
                <i class="ri-arrow-left-line mr-2"></i> Back to Sellers
            </a>
        </div>

        <!-- Seller Details -->
        <div class="mb-0">
            <h1 class="md:text-2xl text-xl font-semibold text-gray-800">{{ $seller->shop_name }} - Orders
                <span class="text-green-500 text-lg">({{ $seller->orders->count() }})</span>
            </h1>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto bg-white rounded mt-4">
            <!-- Loading Message -->
            <div id="loadingMessage" class="text-center text-gray-500 p-4 hidden">
                Loading orders...
            </div>

            <!-- Empty Message -->
            <div id="emptyMessage" class="text-center text-gray-500 p-4 hidden">
                No orders found for this seller.
            </div>

            <table class="min-w-full table-auto text-sm text-left text-gray-500">
                <thead class="text-xs uppercase text-gray-700">
                    <tr>
                        <th class="px-1 py-2 text-gray-800 text-xs uppercase whitespace-nowrap">ID</th>
                        <th class="px-1 py-2 text-gray-800 text-xs uppercase whitespace-nowrap">Products</th>
                        <th class="px-1 py-2 text-gray-800 text-xs uppercase whitespace-nowrap">Ratings</th>
                        <th class="px-1 py-2 text-gray-800 text-xs uppercase whitespace-nowrap">Order Status</th>
                        <th class="px-1 py-2 text-gray-800 text-xs uppercase whitespace-nowrap">Order Date</th>
                        <th class="px-1 py-2 text-gray-800 text-xs text-center uppercase whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody id="orderList">
                    @foreach ($orders as $order)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="py-3 px-2">{{ $order->id }}</td>
                            <td class="py-3 px-2 whitespace-nowrap">
                                @foreach ($order->orderItems as $orderItem)
                                    <span class="text-sm text-gray-700">
                                        {{ \Illuminate\Support\Str::limit($orderItem->product->product_name, 30) }}
                                    </span><br>
                                @endforeach
                            </td>
                            <td class="py-3 px-2">
                                @foreach ($order->orderItems as $orderItem)
                                    @foreach ($orderItem->product->approvedRatings as $rating)
                                        <span class="text-yellow-500">{{ $rating->rating }} / 5</span><br>
                                    @endforeach
                                @endforeach
                            </td>
                            <td class="py-3 px-2">
                                <span
                                    class="px-2 py-1 rounded text-white text-xs font-medium
                                    {{ $order->order_status == 'delivered'
                                        ? 'bg-green-500'
                                        : ($order->order_status == 'pending'
                                            ? 'bg-yellow-500'
                                            : ($order->order_status == 'canceled'
                                                ? 'bg-red-500'
                                                : 'bg-gray-500')) }}">
                                    {{ $order->order_status }}
                                </span>
                            </td>
                            <td class="py-3 px-2">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-2 text-green-700 text-sm whitespace-nowrap">
                                <div class="flex flex-row items-center justify-center gap-2">
                                    <a href="{{ route('order.show', [
                                        'shop_name' => \Illuminate\Support\Str::slug(strtolower($seller->shop_name)),
                                        'id' => $order->id,
                                    ]) }}"
                                        class="inline-block text-green-600 text-[19px]">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Show loading message
            document.getElementById('loadingMessage').classList.remove('hidden');

            // Hide loading message when orders are loaded
            if (document.getElementById('orderList').children.length === 0) {
                document.getElementById('loadingMessage').classList.add('hidden');
                document.getElementById('emptyMessage').classList.remove('hidden');
            } else {
                document.getElementById('loadingMessage').classList.add('hidden');
            }
        </script>
    @endpush
@endsection
