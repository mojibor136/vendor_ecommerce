@extends('admin.layouts.app')
@section('title', 'Update Gateway')
@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Gateway</h2>
                <a href="{{ route('payment-gateway.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Gateway
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Gateway / Update
                </p>
                <a href="{{ route('payment-gateway.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Gateway
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded md:px-6 px-3">
            <form action="{{ route('payment-gateway.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Error Message for Duplicate Category -->
                @if (session('error'))
                    <div class="bg-red-600 text-white px-4 py-3 rounded flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-5-5 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z">
                            </path>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <input type="hidden" value="{{ $payment_gateway->id }}" name="id">

                <!-- Gateway Name Dropdown -->
                <div class="mb-6 mt-6">
                    <label for="gateway_name" class="block text-gray-700 font-medium">Gateway Name</label>
                    <select name="gateway_name" id="gateway_name"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                        <option value="">-- Select Gateway --</option>
                        <option value="BKash"
                            {{ old('gateway_name', $payment_gateway->gateway_name) == 'BKash' ? 'selected' : '' }}>BKash
                        </option>
                        <option value="Nagad"
                            {{ old('gateway_name', $payment_gateway->gateway_name) == 'Nagad' ? 'selected' : '' }}>Nagad
                        </option>
                    </select>
                    @error('gateway_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- App Key Input -->
                <div class="mb-6 mt-6">
                    <label for="app_key" class="block text-gray-700 font-medium">App Key</label>
                    <input type="text" name="app_key" id="app_key" placeholder="App Key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ old('app_key', $payment_gateway->credentials['app_key'] ?? '') }}">
                    @error('app_key')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- App Secret Input -->
                <div class="mb-6 mt-6">
                    <label for="app_secret" class="block text-gray-700 font-medium">App Secret</label>
                    <input type="text" name="app_secret" id="app_secret" placeholder="App Secret"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ old('app_secret', $payment_gateway->credentials['app_secret'] ?? '') }}">
                    @error('app_secret')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Username Input -->
                <div class="mb-6 mt-6">
                    <label for="username" class="block text-gray-700 font-medium">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ old('username', $payment_gateway->credentials['username'] ?? '') }}">
                    @error('username')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-6 mt-6">
                    <label for="password" class="block text-gray-700 font-medium">Password</label>
                    <input type="text" name="password" id="password" placeholder="Password"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        value="{{ old('password', $payment_gateway->credentials['password'] ?? '') }}">
                    @error('password')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6 mt-6">
                    <label for="is_active" class="block text-gray-700 font-medium">Gateway Name</label>
                    <select name="is_active" id="is_active"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                        <option value="">-- Select Status --</option>
                        <option value="0"
                            {{ old('is_active', $payment_gateway->is_active) == '0' ? 'selected' : '' }}>Inactive
                        </option>
                        <option value="1"
                            {{ old('is_active', $payment_gateway->is_active) == '1' ? 'selected' : '' }}>Active
                        </option>
                    </select>
                    @error('is_active')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mb-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
