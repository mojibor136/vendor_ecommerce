@extends('admin.layouts.app')
@section('title', 'Show Subscription')
@section('content')
    <div class="w-full h-full flex flex-col gap-4 max-w-6xl mx-auto">
        <!-- Header Section -->

        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="md:text-2xl text-xl font-bold text-gray-800 mb-2">Subscription</h2>
                <a href="{{ route('subscription.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Subscription
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Subcategories /
                    Show
                </p>
                <a href="{{ route('subscription.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Subscription
                </a>
            </div>
        </div>

        <!-- subscription Details -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 gap-4">
                <!-- subscription Information -->
                <div class="space-y-3">
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Subscription name:</span>
                        <span class="text-gray-600">{{ $subscription->name }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Product limit:</span>
                        <span class="text-gray-600">{{ $subscription->product_limit }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Price:</span>
                        <span class="text-gray-600">{{ $subscription->price }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Duration Days:</span>
                        <span class="text-gray-600">{{ $subscription->duration_days }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Sells:</span>
                        <span class="text-gray-600">{{ $subscription->sells }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Status:</span>
                        <span
                            class="text-gray-600
                            @if ($subscription->is_active === 1) text-green-600
                            @elseif($subscription->is_active === 0) text-red-500
                            @else text-gray-500 @endif
                        ">
                            @if ($subscription->is_active === 1)
                                Active
                            @elseif($subscription->is_active === 0)
                                Deactive
                            @else
                                Unknown
                            @endif
                        </span>
                    </div>
                    <div class="flex flex-col border-b pb-2">
                        <span class="font-medium text-gray-700 mb-1">Features:</span>
                        @php
                            $features = json_decode($subscription->features, true);
                        @endphp

                        @if (!empty($features))
                            <ul class="text-sm text-gray-600 list-disc list-inside space-y-1">
                                @foreach ($features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500 text-sm">No features listed.</span>
                        @endif
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Created At:</span>
                        <span class="text-gray-600">{{ $subscription->created_at }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Updated At:</span>
                        <span class="text-gray-600">{{ $subscription->updated_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
