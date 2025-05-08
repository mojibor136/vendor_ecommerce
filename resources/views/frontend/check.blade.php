{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <title>Courier Data</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script>
    function togglePopup() {
        const popup = document.getElementById("popup");
        popup.classList.toggle("hidden");
        popup.classList.toggle("flex");
    }
</script>
<style>
    body {
        font-family: 'Roboto', sans-serif;
    }
</style>

<body>
    <form action="{{ route('courier.check') }}" method="post" class="p-6 bg-white rounded shadow-md space-y-4">
        @csrf
        <h2 class="text-xl font-semibold">Courier Check</h2>
        <input type="number" value="01311890283" name="phone" placeholder="Enter phone number"
            class="block w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
        <button type="submit" class="w-full py-2 px-4 text-white bg-green-500 hover:bg-green-600 rounded">
            Check
        </button>
    </form>

    @if (session('response'))
        @php
            $response = session('response');
        @endphp
        <div id="popup" class="fixed inset-0 bg-black bg-opacity-50 p-2 sm:p-3 hidden items-center justify-center">
            <div class="p-4 sm:p-8 pt-6 bg-white rounded-lg shadow-lg w-full max-w-4xl">
                <!-- Header -->
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center p-4 bg-gray-100 rounded-md mb-4 shadow">
                    <div class="flex flex-col gap-1 sm:gap-2">
                        <span class="text-lg sm:text-xl font-semibold text-gray-700">Courier Information</span>
                        <span class="text-sm text-gray-500">
                            Mobile: <span class="text-green-600">{{ $response['phone'] ?? 'N/A' }}</span>
                        </span>
                    </div>
                    <button onclick="togglePopup()"
                        class="mt-2 sm:mt-0 py-1 px-4 sm:py-2 sm:px-6 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Close
                    </button>
                </div>

                <!-- Order Summary -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-4 text-center">
                    <div class="bg-blue-100 rounded-md py-2 sm:py-4">
                        <p class="text-lg sm:text-xl font-bold text-blue-700">{{ $response['total_orders'] ?? '0' }}</p>
                        <p class="text-blue-600 font-medium text-xs sm:text-sm">TOTAL ORDER</p>
                    </div>
                    <div class="bg-green-100 rounded-md py-2 sm:py-4">
                        <p class="text-lg sm:text-xl font-bold text-green-700">
                            {{ $response['total_deliveries'] ?? '0' }}</p>
                        <p class="text-green-600 font-medium text-xs sm:text-sm">TOTAL DELIVERY</p>
                    </div>
                    <div class="bg-red-100 rounded-md py-2 sm:py-4">
                        <p class="text-lg sm:text-xl font-bold text-red-700">{{ $response['total_cancels'] ?? '0' }}</p>
                        <p class="text-red-600 font-medium text-xs sm:text-sm">TOTAL CANCEL</p>
                    </div>
                </div>

                <!-- Courier Data Table -->
                <div class="mt-4 sm:mt-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="p-2 sm:p-3 bg-blue-500 text-white font-semibold rounded-tl-md">Courier Name
                                </th>
                                <th class="p-2 sm:p-3 bg-green-500 text-white text-center font-semibold">Order</th>
                                <th class="p-2 sm:p-3 bg-yellow-500 text-white text-center font-semibold">Delivery</th>
                                <th class="p-2 sm:p-3 bg-red-500 text-white text-center font-semibold">Cancel</th>
                                <th class="p-2 sm:p-3 bg-purple-500 text-white text-center font-semibold rounded-tr-md">
                                    Success Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($response['couriers']) || count($response['couriers']) == 0)
                                <tr>
                                    <td colspan="5" class="pt-8 text-center text-gray-500">
                                        No data found
                                    </td>
                                </tr>
                            @else
                                @foreach ($response['couriers'] as $courier)
                                    <tr class="border-t hover:bg-blue-50 transition-colors">
                                        <td
                                            class="p-2 sm:p-3 bg-blue-100 font-semibold text-blue-700 rounded-l-lg border border-blue-300">
                                            {{ $courier['name'] }}
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 text-center bg-green-100 text-green-700 border border-gray-300">
                                            {{ $courier['orders'] ?? 0 }}
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 text-center bg-yellow-100 text-yellow-700 border border-gray-300">
                                            {{ $courier['deliveries'] ?? 0 }}
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 text-center bg-red-100 text-red-700 border border-gray-300">
                                            {{ $courier['cancels'] ?? 0 }}
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 text-center bg-purple-100 text-purple-700 border border-gray-300 rounded-r-lg">
                                            {{ $courier['success_rate'] ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    @if (session('response'))
        <script>
            togglePopup();
        </script>
    @endif
</body>

</html> --}}
