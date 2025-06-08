@extends('admin.layouts.app')
@section('title', 'Email Integration Setup')

@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- 🔰 Email Integration Header -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Email Integration Setup</h2>
                <a href="{{ route('admin.index') }}"
                    class="block bg-blue-600 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-blue-700 transition">
                    Dashboard
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Settings / Email
                    Integration
                </p>
            </div>
            <p class="text-gray-700 text-sm">
                Configure your email service to send transactional and marketing emails properly.
            </p>
        </div>

        <!-- 🔹 Email Integration Form -->
        <div class="w-full bg-white rounded md:px-6 px-3 py-4 shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Email Setup</h2>
            <form action="" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="mail_driver" class="block text-gray-700 font-medium">Mail Driver<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="mail_driver" name="mail_driver"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="e.g., smtp"
                        required>
                </div>

                <div class="mb-4">
                    <label for="mail_host" class="block text-gray-700 font-medium">Mail Host<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="mail_host" name="mail_host"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="e.g., smtp.mailtrap.io" required>
                </div>

                <div class="mb-4">
                    <label for="mail_port" class="block text-gray-700 font-medium">Mail Port<span
                            class="text-red-500">*</span></label>
                    <input type="number" id="mail_port" name="mail_port"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="e.g., 2525"
                        required>
                </div>

                <div class="mb-4">
                    <label for="mail_username" class="block text-gray-700 font-medium">Username<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="mail_username" name="mail_username"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Enter email username" required>
                </div>

                <div class="mb-4">
                    <label for="mail_password" class="block text-gray-700 font-medium">Password<span
                            class="text-red-500">*</span></label>
                    <input type="password" id="mail_password" name="mail_password"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Enter email password" required>
                </div>

                <div class="mb-4">
                    <label for="mail_encryption" class="block text-gray-700 font-medium">Encryption</label>
                    <input type="text" id="mail_encryption" name="mail_encryption"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="e.g., tls">
                </div>

                <div class="mb-4 flex items-center gap-2">
                    <input type="checkbox" id="mail_enabled" name="mail_enabled"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded" checked>
                    <label for="mail_enabled" class="text-gray-700 font-medium">Enable Email Sending</label>
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
