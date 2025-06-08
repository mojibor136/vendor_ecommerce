@extends('admin.layouts.app')
@section('title', 'Courier Integration')

@section('content')

    <div class="w-full h-full flex flex-col gap-4">

        <!-- 🔰 Courier Integration Header -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Courier Integration</h2>
                <a href="{{ route('admin.index') }}"
                    class="block bg-blue-600 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-blue-700 transition">
                    Dashboard
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Settings / Courier
                    Integration
                </p>
            </div>
            <p class="text-gray-700 text-sm">
                Enter your <strong class="text-pink-600">Stedfast</strong> and <strong
                    class="text-yellow-500">Pathao</strong>
                courier details below to enable automatic delivery integration.
            </p>
        </div>

        <!-- 🚚 Stedfast Courier Form -->
        <div class="w-full bg-white rounded md:px-6 px-3 py-4 shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Stedfast Courier Integration</h2>
            <form action="" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="stedfast_number" class="block text-gray-700 font-medium">Stedfast Courier Number<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="stedfast_number" name="stedfast_number"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="01XXXXXXXXX">
                </div>

                <div class="mb-4 md:flex md:gap-4">
                    <div class="md:w-1/2 mb-4 md:mb-0">
                        <label for="stedfast_username" class="block text-gray-700 font-medium">Username<span
                                class="text-red-500">*</span></label>
                        <input type="text" id="stedfast_username" name="stedfast_username"
                            class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                            placeholder="Enter Username">
                    </div>
                    <div class="md:w-1/2">
                        <label for="stedfast_password" class="block text-gray-700 font-medium">Password<span
                                class="text-red-500">*</span></label>
                        <input type="password" id="stedfast_password" name="stedfast_password"
                            class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                            placeholder="Enter Password">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="stedfast_api_key" class="block text-gray-700 font-medium">API Key<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="stedfast_api_key" name="stedfast_api_key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="Enter API Key">
                </div>

                <div class="mb-4">
                    <label for="stedfast_secret_key" class="block text-gray-700 font-medium">Secret Key<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="stedfast_secret_key" name="stedfast_secret_key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="Enter Secret Key">
                </div>

                <div class="mb-4">
                    <label for="stedfast_base_url" class="block text-gray-700 font-medium">Base URL<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="stedfast_base_url" name="stedfast_base_url"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="https://...">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700 transition">Save Stedfast</button>
                </div>
            </form>
        </div>

        <!-- 🚚 Pathao Courier Form -->
        <div class="w-full bg-white rounded md:px-6 px-3 py-4 shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pathao Courier Integration</h2>
            <form action="" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="pathao_number" class="block text-gray-700 font-medium">Pathao Courier Number<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="pathao_number" name="pathao_number"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="01XXXXXXXXX">
                </div>

                <div class="mb-4 md:flex md:gap-4">
                    <div class="md:w-1/2 mb-4 md:mb-0">
                        <label for="pathao_username" class="block text-gray-700 font-medium">Username<span
                                class="text-red-500">*</span></label>
                        <input type="text" id="pathao_username" name="pathao_username"
                            class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                            placeholder="Enter Username">
                    </div>
                    <div class="md:w-1/2">
                        <label for="pathao_password" class="block text-gray-700 font-medium">Password<span
                                class="text-red-500">*</span></label>
                        <input type="password" id="pathao_password" name="pathao_password"
                            class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                            placeholder="Enter Password">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="pathao_api_key" class="block text-gray-700 font-medium">API Key<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="pathao_api_key" name="pathao_api_key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="Enter API Key">
                </div>

                <div class="mb-4">
                    <label for="pathao_secret_key" class="block text-gray-700 font-medium">Secret Key<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="pathao_secret_key" name="pathao_secret_key"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Enter Secret Key">
                </div>

                <div class="mb-4">
                    <label for="pathao_base_url" class="block text-gray-700 font-medium">Base URL<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="pathao_base_url" name="pathao_base_url"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" placeholder="https://...">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition">Save
                        Pathao</button>
                </div>
            </form>
        </div>
    </div>
@endsection
