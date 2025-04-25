@extends('admin.layouts.app')
@section('title', 'Show Seller')
@section('content')
    <div class="w-full h-full flex flex-col gap-4 max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="md:text-2xl text-xl font-bold text-gray-800 mb-2">Seller</h2>
                <a href="{{ route('seller.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Seller
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Seller /
                    Show
                </p>
                <a href="{{ route('seller.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Seller
                </a>
            </div>
        </div>

        <!-- Seller Details -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                <!-- Seller Image -->
                <div class="flex justify-center">
                    @if ($seller->image)
                        <img src="{{ asset('storage/' . $seller->image) }}"
                            class="w-52 h-52 object-cover rounded-lg shadow-lg">
                    @else
                        <img src="https://via.placeholder.com/150" class="w-52 h-52 object-cover rounded-lg shadow-lg">
                    @endif
                </div>

                <!-- Seller Information -->
                <div class="flex flex-col gap-4 text-gray-700">
                    <div class="flex justify-between">
                        <span class="font-semibold">Name:</span>
                        <span class="text-gray-600">{{ $seller->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Email:</span>
                        <span class="text-gray-600">{{ $seller->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Phone:</span>
                        <span class="text-gray-600">{{ $seller->phone }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Shop Name:</span>
                        <span class="text-gray-600">{{ $seller->shop_name }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="font-semibold">Shop Address:</span>
                        <span class="text-gray-600">
                            {{ optional($seller->country)->name }},
                            {{ optional($seller->division)->name }},
                            {{ optional($seller->district)->name }},
                            {{ $seller->shop_address }}
                        </span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="font-semibold">Description:</span>
                        <span class="text-gray-600">{{ $seller->shop_description }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Average Rating:</span>
                        <span class="text-yellow-500">{{ $averageRating ?? 0 }}/5</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Verification:</span>
                        <span
                            class="capitalize font-medium
                            @if ($seller->verification_status == 'pending') text-yellow-500
                            @elseif($seller->verification_status == 'verified') text-green-600
                            @elseif($seller->verification_status == 'rejected') text-red-600
                            @else text-gray-600 @endif">
                            {{ $seller->verification_status }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Phone Verification:</span>
                        <span class="text-gray-600 capitalize">{{ $seller->phone_verification }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Status:</span>
                        <span
                            class="capitalize font-medium
                            @if ($seller->status == 'active') text-green-600
                            @elseif($seller->status == 'deactive') text-red-600
                            @else text-gray-600 @endif">
                            {{ $seller->status }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Upload Product:</span>
                        <span class="text-gray-600">{{ $seller->products->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Subscription Name:</span>
                        <span class="text-gray-600">
                            {{ $seller->activeSubscription && $seller->activeSubscription->subscription ? $seller->activeSubscription->subscription->name : 'N/A' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Product Limit:</span>
                        <span class="text-gray-600">
                            {{ $seller->activeSubscription && $seller->activeSubscription->subscription ? $seller->activeSubscription->subscription->product_limit : 'N/A' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Subscription Status:</span>
                        <span
                            class="capitalize font-medium
                            @if ($seller->subscription_status == 'active') text-green-600
                            @elseif($seller->subscription_status == 'deactive') text-red-600
                            @else text-gray-600 @endif">
                            {{ $seller->subscription_status }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Duration Days:</span>
                        <span class="text-gray-600">
                            {{ $seller->activeSubscription && $seller->activeSubscription->subscription ? $seller->activeSubscription->subscription->duration_days : 'N/A' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Start Date:</span>
                        <span class="text-green-600">
                            {{ optional($seller->activeSubscription)->start_date ? $seller->activeSubscription->start_date->format('d M Y') : 'N/A' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-800">Expire Date:</span>
                        <span class="text-red-500">
                            {{ optional($seller->activeSubscription)->end_date ? $seller->activeSubscription->end_date->format('d M Y') : 'N/A' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold">Created At:</span>
                        <span class="text-gray-600">{{ $seller->created_at }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Updated At:</span>
                        <span class="text-gray-600">{{ $seller->updated_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
