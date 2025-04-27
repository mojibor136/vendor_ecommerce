@extends('admin.layouts.app')

@section('title', 'All Payment Gateways')

@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-6">
        <!-- Header Section -->
        <div class="header flex flex-row gap-2 p-4">
            <a href="{{ route('payment-gateway.create') }}"
                class="bg-blue-500 flex flex-row items-center justify-center text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-blue-600 transition">
                Add Gateway
            </a>
        </div>

        <!-- Data Table -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Gateway Name</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Status</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gateways as $gateway)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-sm">{{ $gateway->id }}</td>
                                <td class="px-6 py-3 text-sm">{{ ucfirst($gateway->gateway_name) }}</td>
                                <td class="px-6 py-3 text-sm">
                                    @if ($gateway->is_active)
                                        <span class="text-green-500 font-semibold">Active</span>
                                    @else
                                        <span class="text-red-500 font-semibold">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-2 flex flex-row justify-center gap-3">
                                    <a href="{{ route('payment-gateway.edit', $gateway->id) }}"
                                        class="inline-block text-gray-600 text-[19px]"><i class="ri-edit-box-line"></i></a>
                                    <a href="{{ route('payment-gateway.destroy', $gateway->id) }}"
                                        class="inline-block text-gray-600 text-[19px]"><i
                                            class="ri-delete-bin-6-line"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
