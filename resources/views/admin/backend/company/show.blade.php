@extends('admin.layouts.app')
@section('title', 'Show Company')
@section('content')
    <div class="w-full h-full flex flex-col gap-4 max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="md:text-2xl text-xl font-bold text-gray-800 mb-2">Company</h2>
                <a href="{{ route('company.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Company
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Company / Show
                </p>
                <a href="{{ route('company.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Company
                </a>
            </div>
        </div>

        <!-- Category Details -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 gap-4">
                <div class="space-y-3">
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="font-medium text-gray-700">Logo:</span>
                        @if ($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" class="w-auto h-16 object-cover rounded">
                        @else
                            <span class="text-gray-600">No Logo</span>
                        @endif
                    </div>
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="font-medium text-gray-700">Icon:</span>
                        @if ($company->icon)
                            <img src="{{ asset('storage/' . $company->icon) }}" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-600">No Icon</span>
                        @endif
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Email:</span>
                        <span class="text-gray-600">{{ $company->email }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">CEO Name:</span>
                        <span class="text-gray-600">{{ $company->name }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Address:</span>
                        <span class="text-gray-600">{{ $company->address }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Phone:</span>
                        <span class="text-gray-600">{{ $company->phone }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Fax:</span>
                        <span class="text-gray-600">{{ $company->fax }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="font-medium text-gray-700">Company:</span>
                        <span class="text-gray-600">{{ $company->company }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Created At:</span>
                        <span class="text-gray-600">{{ $company->created_at }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-700">Updated At:</span>
                        <span class="text-gray-600">{{ $company->updated_at ?? 'Null' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
