@extends('admin.layouts.app')
@section('title', 'Payment Integration')

@section('content')

    <div class="w-full h-full flex flex-col gap-4">
        <!-- 🔰 Payment Integration Header -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Payment Integration</h2>
                <a href="{{ route('admin.index') }}"
                    class="block bg-blue-600 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-blue-700 transition">
                    Dashboard
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Settings / Payment
                    Integration
                </p>
            </div>
            <p class="text-gray-700 text-sm">
                Configure your <strong class="text-pink-600">BKash</strong> and <strong
                    class="text-yellow-500">Nagad</strong> merchant credentials here to enable mobile
                payment services. Make sure to provide accurate API keys and account info.
            </p>
        </div>

        <!-- 🔹 bKash Integration Form -->
        <div class="w-full bg-white rounded md:px-6 px-3 py-4 shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">BKash Integration</h2>
            <form action="" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="bkash_number" class="block text-gray-700 font-medium">BKash Number<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="bkash_number" name="bkash_number"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="01XXXXXXXXX">
                </div>

                <div class="mb-4 md:flex md:gap-4">
                    <div class="md:w-1/2 w-full mb-4 md:mb-0">
                        <label for="bkash_username" class="block text-gray-700 font-medium">Username<span
                                class="text-red-500">*</span></label>
                        <input type="text" id="bkash_username" name="bkash_username"
                            class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                            placeholder="Enter Username">
                    </div>
                    <div class="md:w-1/2 w-full">
                        <label for="bkash_password" class="block text-gray-700 font-medium">Password<span
                                class="text-red-500">*</span></label>
                        <input type="password" id="bkash_password" name="bkash_password"
                            class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                            placeholder="Enter Password">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="bkash_api_key" class="block text-gray-700 font-medium">API Key<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="bkash_api_key" name="bkash_api_key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="Enter API Key">
                </div>

                <div class="mb-4">
                    <label for="bkash_secret_key" class="block text-gray-700 font-medium">Secret Key<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="bkash_secret_key" name="bkash_secret_key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="Enter Secret Key">
                </div>

                <div class="mb-4">
                    <label for="bkash_base_url" class="block text-gray-700 font-medium">Base URL<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="bkash_base_url" name="bkash_base_url"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="https://...">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700 transition">Save bKash</button>
                </div>
            </form>
        </div>


        <!-- 🔸 Nagad Integration Form -->
        <div class="w-full bg-white rounded md:px-6 px-3 py-4 shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Nagad Integration</h2>
            <form action="" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="nagad_number" class="block text-gray-700 font-medium">Nagad Number<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nagad_number" name="nagad_number"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="01XXXXXXXXX">
                </div>

                <div class="mb-4 md:flex md:gap-4">
                    <div class="md:w-1/2 w-full mb-4 md:mb-0">
                        <label for="nagad_username" class="block text-gray-700 font-medium">Username<span
                                class="text-red-500">*</span></label>
                        <input type="text" id="nagad_username" name="nagad_username"
                            class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                            placeholder="Enter Username">
                    </div>
                    <div class="md:w-1/2 w-full">
                        <label for="nagad_password" class="block text-gray-700 font-medium">Password<span
                                class="text-red-500">*</span></label>
                        <input type="password" id="nagad_password" name="nagad_password"
                            class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                            placeholder="Enter Password">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="nagad_api_key" class="block text-gray-700 font-medium">API Key<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nagad_api_key" name="nagad_api_key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="Enter API Key">
                </div>

                <div class="mb-4">
                    <label for="nagad_secret_key" class="block text-gray-700 font-medium">Secret Key<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nagad_secret_key" name="nagad_secret_key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Enter Secret Key">
                </div>

                <div class="mb-4">
                    <label for="nagad_base_url" class="block text-gray-700 font-medium">Base URL<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nagad_base_url" name="nagad_base_url"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="https://...">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition">Save
                        Nagad</button>
                </div>
            </form>
        </div>
    </div>
@endsection
