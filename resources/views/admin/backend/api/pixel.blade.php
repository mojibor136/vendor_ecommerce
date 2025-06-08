@extends('admin.layouts.app')
@section('title', 'Meta Pixel Integration')

@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- 🔰 Meta Pixel Integration Header -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Meta Pixel Integration</h2>
                <a href="{{ route('admin.index') }}"
                    class="block bg-blue-600 text-white px-4 md:py-2 py-2.5 rounded text-sm font-medium hover:bg-blue-700 transition">
                    Dashboard
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Settings / Meta
                    Pixel
                </p>
            </div>
            <p class="text-gray-700 text-sm">
                Integrate your website with <strong class="text-blue-600">Meta (Facebook) Pixel</strong> to track user
                interactions and optimize ad performance. Provide the correct Pixel ID and Access Token.
            </p>
        </div>

        <!-- 🔹 Meta Pixel Form -->
        <div class="w-full bg-white rounded md:px-6 px-3 py-4 shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Meta Pixel Setup</h2>
            <form action="" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="pixel_id" class="block text-gray-700 font-medium">Pixel ID<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="pixel_id" name="pixel_id"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Enter your Pixel ID" required>
                </div>

                <div class="mb-4">
                    <label for="access_token" class="block text-gray-700 font-medium">Access Token<span
                            class="text-red-500">*</span></label>
                    <input type="text" id="access_token" name="access_token"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Enter Access Token" required>
                </div>

                <div class="mb-4">
                    <label for="test_event_code" class="block text-gray-700 font-medium">Test Event Code</label>
                    <input type="text" id="test_event_code" name="test_event_code"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700"
                        placeholder="Optional - For testing Pixel events">
                </div>

                <div class="mb-4 flex items-center gap-2">
                    <input type="checkbox" id="conversion_api_enabled" name="conversion_api_enabled"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <label for="conversion_api_enabled" class="text-gray-700 font-medium">Enable Conversion API</label>
                </div>

                <div class="mb-4">
                    <label for="pixel_status" class="block text-gray-700 font-medium">Pixel Status</label>
                    <select id="pixel_status" name="pixel_status"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700">
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Save Meta Pixel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
