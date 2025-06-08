@extends('admin.layouts.app')
@section('title', 'Google Tag Manager')

@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- 🔰 Google Tag Integration Header -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Google Tag Manager</h2>
                <a href="{{ route('admin.index') }}"
                    class="block bg-blue-600 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-blue-700 transition">
                    Dashboard
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Settings / Google
                    Tag
                </p>
            </div>
            <p class="text-gray-700 text-sm">
                Connect your website with <strong class="text-blue-600">Google Tag Manager</strong> to manage marketing tags
                and track user behavior.
            </p>
        </div>

        <!-- 🔹 Google Tag Form -->
        <div class="w-full bg-white rounded md:px-6 px-3 py-4 shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Google Tag Setup</h2>
            <form action="" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="gtm_container_id" class="block text-gray-700 font-medium">Container ID<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="gtm_container_id" name="gtm_container_id"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="e.g., GTM-XXXXXXX"
                        required>
                </div>

                <div class="mb-4">
                    <label for="gtm_status" class="block text-gray-700 font-medium">Status</label>
                    <select id="gtm_status" name="gtm_status"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
