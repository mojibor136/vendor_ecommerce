@extends('admin.layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <style>
        .category-tag {
            transition: all 0.3s ease;
        }

        @keyframes growWidth {
            from {
                width: 0;
            }

            to {
                width: var(--progress-width);
            }
        }

        .progress-bar-inner {
            width: 0;
            animation-name: growWidth;
            animation-duration: 1.5s;
            animation-fill-mode: forwards;
            animation-timing-function: ease-out;
        }
    </style>
    <div class="flex flex-col">
        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-3 mb-6">

            <!-- Product Count Card -->
            <a href="{{ route('products.index') }}"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-green-600 bg-green-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-shopping-bag-3-line"></i>
                </div>
                <div class="text-2xl font-bold text-green-600">{{ $productCount }}</div>
                <div class="text-sm text-gray-500 capitalize">total products</div>
                <div class="w-full h-2 rounded-md bg-green-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-green-600 progress-bar-inner"
                        style="--progress-width: {{ min($productCount, 100) }}%;">
                    </div>
                </div>
            </a>

            <!-- Total Product Quantity Card -->
            <a href="{{ route('products.index') }}"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-yellow-600 bg-yellow-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-numbers-line"></i>
                </div>
                <div class="text-2xl font-bold text-yellow-600">{{ $totalProductQuantity }}</div>
                <div class="text-sm text-gray-500 capitalize">total quantity</div>
                <div class="w-full h-2 rounded-md bg-yellow-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-yellow-600 progress-bar-inner"
                        style="--progress-width: {{ min($totalProductQuantity, 100) }}%;"></div>
                </div>
            </a>

            <!-- Categories -->
            <a href="{{ route('categories.index') }}"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-blue-600 bg-blue-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-grid-line"></i>
                </div>
                <div class="text-2xl font-bold text-blue-600">{{ $categoryCount }}</div>
                <div class="text-sm text-gray-500 capitalize">categories</div>
                <div class="w-full h-2 rounded-md bg-blue-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-blue-600 progress-bar-inner"
                        style="--progress-width: {{ min($categoryCount, 100) }}%;"></div>
                </div>
            </a>

            <!-- Subcategories -->
            <a href="{{ route('subcategories.index') }}"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-purple-600 bg-purple-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-shape-2-line"></i>
                </div>
                <div class="text-2xl font-bold text-purple-600">{{ $subCategoryCount }}</div>
                <div class="text-sm text-gray-500 capitalize">subcategories</div>
                <div class="w-full h-2 rounded-md bg-purple-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-purple-600 progress-bar-inner"
                        style="--progress-width: {{ min($subCategoryCount, 100) }}%;"></div>
                </div>
            </a>

            <!-- Sellers -->
            <a href="{{ route('seller.index') }}"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-red-600 bg-red-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-store-3-line"></i>
                </div>
                <div class="text-2xl font-bold text-red-600">{{ $sellerCount }}</div>
                <div class="text-sm text-gray-500 capitalize">sellers</div>
                <div class="w-full h-2 rounded-md bg-red-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-red-600 progress-bar-inner"
                        style="--progress-width: {{ min($sellerCount, 100) }}%;"></div>
                </div>
            </a>

            <!-- Orders -->
            <a href="{{ route('order.index') }}"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-indigo-600 bg-indigo-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-truck-line"></i>
                </div>
                <div class="text-2xl font-bold text-indigo-600">{{ $orderCount }}</div>
                <div class="text-sm text-gray-500 capitalize">orders</div>
                <div class="w-full h-2 rounded-md bg-indigo-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-indigo-600 progress-bar-inner"
                        style="--progress-width: {{ min($orderCount, 100) }}%;"></div>
                </div>
            </a>

            <!-- Users -->
            <a href="{{ route('user.index') }}"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-teal-600 bg-teal-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-user-line"></i>
                </div>
                <div class="text-2xl font-bold text-teal-600">{{ $userCount }}</div>
                <div class="text-sm text-gray-500 capitalize">customer</div>
                <div class="w-full h-2 rounded-md bg-teal-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-teal-600 progress-bar-inner"
                        style="--progress-width: {{ min($userCount, 100) }}%;"></div>
                </div>
            </a>

            <!-- Visitors -->
            <a href="#"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-orange-600 bg-orange-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-eye-line"></i>
                </div>
                <div class="text-2xl font-bold text-orange-600">{{ $visitorCount }}</div>
                <div class="text-sm text-gray-500 capitalize">visitors</div>
                <div class="w-full h-2 rounded-md bg-orange-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-orange-600 progress-bar-inner"
                        style="--progress-width: {{ min($visitorCount, 100) }}%;"></div>
                </div>
            </a>

            <!-- Sales Report -->
            <a href="#"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-rose-600 bg-rose-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-bar-chart-2-line"></i>
                </div>
                <div class="text-2xl font-bold text-rose-600">10,000</div>
                <div class="text-sm text-gray-500 capitalize">sales report</div>
                <div class="w-full h-2 rounded-md bg-rose-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-rose-600 progress-bar-inner" style="--progress-width: 100%;"></div>
                </div>
            </a>

            <!-- Products Sold -->
            <a href="#"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-amber-600 bg-amber-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-pie-chart-2-line"></i>
                </div>
                <div class="text-2xl font-bold text-amber-600">{{ $totalProductsSold }}</div>
                <div class="text-sm text-gray-500 capitalize">products sold</div>
                <div class="w-full h-2 rounded-md bg-amber-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-amber-600 progress-bar-inner"
                        style="--progress-width: {{ min($totalProductsSold, 100) }}%;"></div>
                </div>
            </a>

            <!-- Division -->
            <a href="{{ route('division.index') }}"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-cyan-600 bg-cyan-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-map-pin-line"></i>
                </div>
                <div class="text-2xl font-bold text-cyan-600">{{ $divisionCount }}</div>
                <div class="text-sm text-gray-500 capitalize">divisions</div>
                <div class="w-full h-2 rounded-md bg-cyan-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-cyan-600 progress-bar-inner"
                        style="--progress-width: {{ min($divisionCount, 100) }}%;"></div>
                </div>
            </a>

            <!-- District -->
            <a href="{{ route('district.index') }}"
                class="relative bg-white p-5 rounded-md shadow hover:-translate-y-1 transition-transform block">
                <div
                    class="absolute top-4 right-4 p-2 rounded-full text-lime-600 bg-lime-100 inline-flex items-center justify-center text-xl">
                    <i class="ri-building-line"></i>
                </div>
                <div class="text-2xl font-bold text-lime-600">{{ $districtCount }}</div>
                <div class="text-sm text-gray-500 capitalize">districts</div>
                <div class="w-full h-2 rounded-md bg-lime-600 mt-3 bg-opacity-30">
                    <div class="h-2 rounded-md bg-lime-600 progress-bar-inner"
                        style="--progress-width: {{ min($districtCount, 100) }}%;"></div>
                </div>
            </a>
        </div>

        <div class="flex flex-col gap-6">
            <div class="bg-white rounded shadow">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h2 class="text-sm uppercase font-bold text-gray-600">New Orders</h2>
                    <i class="ri-refresh-line text-gray-500 cursor-pointer text-lg"></i>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="uppercase bg-gray-50 text-gray-600 font-bold text-xs">
                            <tr>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Product</th>
                                <th class="px-4 py-3">Customer</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Payment</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($newOrder as $order)
                                @foreach ($order->orderItems as $item)
                                    @php
                                        $method = $order->payment ? $order->payment->method : '';
                                        $color = match ($method) {
                                            'bkash' => 'text-pink-600',
                                            'Cash On Delivery' => 'text-green-600',
                                            'nagad' => 'text-orange-500',
                                            default => 'text-gray-700',
                                        };
                                    @endphp
                                    <tr class="border-b border-gray-100 hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $order->created_at->format('Y-m-d') }}</td>
                                        <td class="px-4 py-3">
                                            @if ($item->product)
                                                <a href="" class="hover:text-blue-500 text-gray-700">
                                                    {{ \Illuminate\Support\Str::limit($item->product->product_name, 30) }}
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <img src="https://www.svgrepo.com/show/382109/male-avatar-boy-face-man-user-7.svg"
                                                    class="w-8 h-8 rounded-full" alt="Profile">
                                                <span
                                                    class="text-sm text-gray-700 capitalize">{{ $order->shipping->shipping_name ?? 'Unknown' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">&#2547;{{ $order->payment->amount }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-1">
                                                <i class="ri-typhoon-line {{ $color }} text-lg"></i>
                                                <span
                                                    class="{{ $color }} capitalize cursor-pointer hover:text-orange-600">
                                                    {{ $method }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="chart p-4 bg-white rounded-md shadow-md">
                <div class="chart-header flex justify-between items-center mb-4">
                    <h2 class="text-sm uppercase font-bold text-gray-600">Product sales</h2>
                    <div class="chart-btn space-x-2">
                        <button onclick="loadSalesData('weekly')"
                            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Weekly</button>
                        <button onclick="loadSalesData('monthly')"
                            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Monthly</button>
                        <button onclick="loadSalesData('yearly')"
                            class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Yearly</button>
                    </div>
                </div>
                <div id="chart">
                    <canvas id="salesChart" class="w-full h-64"></canvas>
                </div>
            </div>

            <div class="order bg-white shadow rounded-md">
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                    <h2 class="text-sm uppercase font-bold text-gray-600">Recent Transactionss</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse">
                        <thead class="border-b border-gray-300">
                            <tr class="text-left text-sm font-bold text-gray-700">
                                <th class="px-4 py-3">Status</th>
                                <th class="px-3 py-3">Invoice</th>
                                <th class="px-3 py-3">Customer Name</th>
                                <th class="px-3 py-3">Products</th>
                                <th class="px-3 py-3">Categories</th>
                                <th class="px-3 py-3 text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                            @foreach ($latestOrder as $order)
                                @foreach ($order->orderItems as $item)
                                    @php
                                        $method = $order->payment ? $order->payment->method : '';
                                        $colorClass = match ($method) {
                                            'bkash' => 'text-pink-700',
                                            'Cash On Delivery' => 'text-green-600',
                                            'nagad' => 'text-orange-500',
                                            default => 'text-gray-600',
                                        };
                                    @endphp
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <i class="ri-typhoon-line text-lg {{ $colorClass }}"></i>
                                                <span
                                                    class="text-sm capitalize cursor-pointer transition-colors duration-200 {{ $colorClass }} hover:text-orange-500">
                                                    {{ $method }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-3 py-3 text-sm text-blue-600">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="px-3 py-3 text-sm text-gray-700">
                                            <div class="flex items-center gap-2">
                                                <img src="https://www.svgrepo.com/show/382109/male-avatar-boy-face-man-user-7.svg"
                                                    class="w-8 h-8 rounded-full" alt="Profile">
                                                <span>{{ $order->shipping->shipping_name ?? 'Unknown' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-3 py-3 text-sm text-gray-700">
                                            @if ($item->product)
                                                <a href="#" class="hover:text-blue-500">
                                                    {{ \Illuminate\Support\Str::limit($item->product->product_name, 30) }}
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-3 py-3 text-sm text-gray-700">
                                            <div class="category-tag px-4 py-2 rounded-2xl text-center">
                                                {{ $item->product && $item->product->category ? $item->product->category->category_name : 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-3 py-3 text-sm text-gray-700 text-center">
                                            &#2547;{{ $order->payment->amount }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');

        let salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Sales',
                    data: [],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });

        function loadSalesData(type) {
            fetch(`/admin/sales/${type}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not OK');
                    }
                    return response.json();
                })
                .then(data => {
                    const labels = data.map(item => new Date(item.created_at).toLocaleDateString());
                    const values = data.map(item => item.amount);

                    salesChart.data.labels = labels;
                    salesChart.data.datasets[0].data = values;
                    salesChart.update();
                })
                .catch(error => {
                    console.error('Error loading sales data:', error);
                });
        }

        loadSalesData('monthly');

        document.querySelectorAll('.chart-btn button').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.chart-btn button').forEach(b => b.classList.remove('active'));

                this.classList.add('active');

                loadSalesData(this.textContent.toLowerCase());
            });
        });
    </script>

    <script>
        const colors = [
            '#108de0', '#28a745', '#dc3545', '#ffc107', '#6610f2', '#20c997', '#e83e8c',
            '#17a2b8', '#6f42c1', '#fd7e14', '#343a40', '#ff6b6b', '#00b894', '#6c5ce7',
            '#fab1a0', '#ffeaa7', '#55efc4', '#a29bfe', '#fd79a8', '#e17055', '#d63031',
            '#0984e3', '#00cec9', '#2d3436', '#636e72', '#b2bec3', '#ffeaa7', '#ff7675'
        ];

        document.querySelectorAll('.category-tag').forEach(tag => {
            const color = colors[Math.floor(Math.random() * colors.length)];

            const hexToRGBA = (hex, alpha = 0.1) => {
                const bigint = parseInt(hex.slice(1), 16);
                const r = (bigint >> 16) & 255;
                const g = (bigint >> 8) & 255;
                const b = bigint & 255;
                return `rgba(${r}, ${g}, ${b}, ${alpha})`;
            };

            const lightBg = hexToRGBA(color, 0.1);

            tag.style.backgroundColor = lightBg;
            tag.style.border = `1px solid ${color}`;
            tag.style.color = color;
            tag.style.transition = 'all 0.3s ease';

            tag.addEventListener('mouseenter', () => {
                tag.style.backgroundColor = color;
                tag.style.color = '#fff';
            });

            tag.addEventListener('mouseleave', () => {
                tag.style.backgroundColor = lightBg;
                tag.style.color = color;
            });
        });
    </script>
@endpush
