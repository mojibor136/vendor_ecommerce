@extends('admin.layouts.app')
@section('title', 'Create Company')
@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Company</h2>
                <a href="{{ route('company.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Company
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Company / Create
                </p>
                <a href="{{ route('company.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Company
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded md:px-6 px-3">
            <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
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

                <!-- Editor Name Input -->
                <div class="mb-6 mt-6">
                    <label for="name" class="block text-gray-700 font-medium">Name<span class="text-red-500">
                            *</span></label>
                    <input type="text" name="name" id="name" placeholder="Editor Name"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="mb-6 mt-6">
                    <label for="email" class="block text-gray-700 font-medium">Email<span class="text-red-500">
                            *</span></label>
                    <input type="email" name="email" id="email" placeholder="Email"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address Input -->
                <div class="mb-6 mt-6">
                    <label for="address" class="block text-gray-700 font-medium">Address<span class="text-red-500">
                            *</span></label>
                    <input type="text" name="address" id="address" placeholder="Address"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('address') }}">
                    @error('address')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Fax Input -->
                <div class="mb-6 mt-6">
                    <label for="fax" class="block text-gray-700 font-medium">Fax</label>
                    <input type="text" name="fax" id="fax" placeholder="Fax"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('fax') }}">
                    @error('fax')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Input -->
                <div class="mb-6 mt-6">
                    <label for="phone" class="block text-gray-700 font-medium">Phone</label>
                    <input type="text" name="phone" id="phone" placeholder="Phone"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- company Input -->
                <div class="mb-6 mt-6">
                    <label for="company" class="block text-gray-700 font-medium">Company</label>
                    <input type="text" name="company" id="company" placeholder="company"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('company') }}">
                    @error('company')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Logo Input -->
                <div class="mb-6 mt-6">
                    <label for="logo" class="block text-gray-700 font-medium">Logo</label>
                    <input type="file" name="logo" id="logo"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('logo') }}">
                    @error('logo')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Icon Input -->
                <div class="mb-6 mt-6">
                    <label for="icon" class="block text-gray-700 font-medium">Icon</label>
                    <input type="file" name="icon" id="icon"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ old('icon') }}">
                    @error('icon')
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
