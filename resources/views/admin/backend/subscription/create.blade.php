@extends('admin.layouts.app')
@section('title', 'Create Subscription')
@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Subscription</h2>
                <a href="{{ route('subscription.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Subscriptions
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Subscription /
                    Create
                </p>
                <a href="{{ route('subscription.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Subscriptions
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded md:px-6 px-3">
            <form action="{{ route('subscription.store') }}" method="POST">
                @csrf

                @if (session('error'))
                    <div class="bg-red-600 mt-3 text-white px-4 py-3 rounded flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-5-5
                                                                                        1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z">
                            </path>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Name -->
                <div class="my-4">
                    <label for="name" class="block text-gray-700 font-medium">Name<span
                            class="text-red-400">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Subscription Name"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Write subscription description...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-medium">Price (in USD)<span
                            class="text-red-400">*</span></label>
                    <input type="number" name="price" id="price" step="0.01" placeholder="0.00"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('price') }}">
                    @error('price')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Product Limit -->
                <div class="mb-4">
                    <label for="product_limit" class="block text-gray-700 font-medium">Product Limit</label>
                    <input type="number" name="product_limit" id="product_limit" placeholder="E.g. 5"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ old('product_limit') }}">
                    @error('product_limit')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Duration (Days) -->
                <div class="my-4">
                    <label for="name" class="block text-gray-700 font-medium">Select Duration <span
                            class="text-red-500">*</span></label> <select name="duration_days" id="duration_days"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                        <option value="">-- Select Duration --</option>
                        <option value="15">Free Trial</option>
                        <option value="30">Monthly</option>
                        <option value="360">Yearly</option>
                    </select>
                    @error('duration_days')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Features -->
                <div class="mb-4">
                    <label for="features" class="block text-gray-700 font-medium">Features <span
                            class="text-gray-400 text-sm">(comma separated)</span></label>
                    <input type="text" name="features" id="features" placeholder="Feature 1, Feature 2, Feature 3"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('features') }}">
                    @error('features')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mb-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
