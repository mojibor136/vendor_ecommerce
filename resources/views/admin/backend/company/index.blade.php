@extends('admin.layouts.app')
@section('title', 'All Company')
@section('content')
    <div class="bg-white w-full h-full flex flex-col gap-6">
        <!-- Header Section -->
        <div class="header flex flex-row gap-2 p-4">
            <a href="{{ route('company.create') }}"
                class="bg-teal-500 flex flex-row items-center justify-center text-white px-4 py-2.5 rounded text-sm font-medium hover:bg-teal-600 transition h-10">
                Add Company
            </a>
            <a href="{{ route('company.index') }}"
                class="bg-blue-500 flex flex-row items-center justify-center text-white px-4 py-2.5 rounded text-sm font-medium hover:bg-blue-600 transition h-10">
                SocialLink
            </a>
        </div>

        <!-- Data Table -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Logo</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">CEO Name</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-left uppercase">Phone</th>
                            <th class="px-6 py-2 text-gray-800 text-xs text-center uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr class="border-b">
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">{{ $company->id }}</td>
                                <td class="px-6 py-2 text-center whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $company->icon) }}"
                                        class="w-12 h-12 object-cover rounded">
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">{{ $company->name }}
                                </td>
                                <td class="px-6 py-1 text-gray-700 text-sm whitespace-nowrap">{{ $company->phone }}</td>
                                </td>
                                <td class="px-6 py-2 flex flex-row gap-3 items-center text-center whitespace-nowrap">
                                    <a href="{{ route('company.show', $company->id) }}"
                                        class="inline-block text-gray-600 text-[19px]"><i class="ri-eye-line"></i></a>
                                    <a href="{{ route('company.edit', $company->id) }}"
                                        class="inline-block text-gray-600 text-[19px]"><i class="ri-edit-box-line"></i></a>
                                    <a href="{{ route('company.destroy', $company->id) }}"
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
