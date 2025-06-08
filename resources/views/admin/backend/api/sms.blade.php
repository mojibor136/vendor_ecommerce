@extends('admin.layouts.app')
@section('title', 'SMS Integration Setup')

@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- 🔰 SMS Integration Header -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">SMS Integration Setup</h2>
                <a href="{{ route('admin.index') }}"
                    class="block bg-blue-600 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-blue-700 transition">
                    Dashboard
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Settings / SMS
                    Integration
                </p>
            </div>
            <p class="text-gray-700 text-sm">
                Configure your SMS gateway to send transactional and promotional SMS messages.
            </p>
        </div>

        <!-- 🔹 SMS Integration Form -->
        <div class="w-full bg-white rounded md:px-6 px-3 py-4 shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">SMS Setup</h2>
            <form action="" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="sms_provider" class="block text-gray-700 font-medium">SMS Provider<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="sms_provider" name="sms_provider"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="e.g., Twilio, Nexmo, etc." required>
                </div>

                <div class="mb-4">
                    <label for="sms_api_key" class="block text-gray-700 font-medium">API Key<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="sms_api_key" name="sms_api_key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Enter your SMS gateway API key" required>
                </div>

                <div class="mb-4">
                    <label for="sms_api_secret" class="block text-gray-700 font-medium">API Secret</label>
                    <input type="text" id="sms_api_secret" name="sms_api_secret"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Enter your SMS gateway API secret">
                </div>

                <div class="mb-4">
                    <label for="sms_sender_id" class="block text-gray-700 font-medium">Sender ID</label>
                    <input type="text" id="sms_sender_id" name="sms_sender_id"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Enter sender ID or phone number">
                </div>

                <div class="mb-4">
                    <label for="sms_status" class="block text-gray-700 font-medium">Status</label>
                    <select id="sms_status" name="sms_status"
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
