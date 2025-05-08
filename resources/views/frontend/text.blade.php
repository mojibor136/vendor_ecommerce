<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="p-8 bg-white rounded-lg shadow-lg w-full max-w-4xl">
                <!-- Order Summary -->
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div class="bg-blue-100 rounded-md py-4">
                        <p class="text-xl font-bold text-blue-700">0</p>
                        <p class="text-blue-600 font-medium text-sm">TOTAL ORDER</p>
                    </div>
                    <div class="bg-green-100 rounded-md py-4">
                        <p class="text-xl font-bold text-green-700">0</p>
                        <p class="text-green-600 font-medium text-sm">TOTAL DELIVERY</p>
                    </div>
                    <div class="bg-red-100 rounded-md py-4">
                        <p class="text-xl font-bold text-red-700">0</p>
                        <p class="text-red-600 font-medium text-sm">TOTAL CANCEL</p>
                    </div>
                </div>

                <!-- Courier Data Table -->
                <div class="mt-6 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="p-3 px-4 bg-blue-500 text-white font-semibold rounded-tl-md">Courier Name
                                </th>
                                <th class="p-3 bg-green-500 text-white text-center font-semibold">Order</th>
                                <th class="p-3 bg-yellow-500 text-white text-center font-semibold">Delivery</th>
                                <th class="p-3 bg-red-500 text-white text-center font-semibold">Cancel</th>
                                <th class="p-3 bg-purple-500 text-white text-center font-semibold rounded-tr-md">Success
                                    Rate
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t hover:bg-blue-50 transition-colors">
                                <td
                                    class="p-3 bg-blue-100 font-semibold text-blue-700 rounded-l-lg border border-blue-300">
                                    RedX
                                </td>
                                <td
                                    class="p-3 text-center bg-green-100 text-green-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-yellow-100 text-yellow-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-red-100 text-red-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-purple-100 text-purple-700 border text-gray-700 border-gray-300">
                                    N/A</td>
                            </tr>
                            <tr class="border-t hover:bg-green-50 transition-colors">
                                <td
                                    class="p-3 bg-green-100 font-semibold text-green-700 rounded-l-lg border border-green-300">
                                    PaperFly</td>
                                <td
                                    class="p-3 text-center bg-green-100 text-green-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-yellow-100 text-yellow-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-red-100 text-red-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-purple-100 text-purple-700 border text-gray-700 border-gray-300">
                                    N/A</td>
                            </tr>
                            <tr class="border-t hover:bg-yellow-50 transition-colors">
                                <td
                                    class="p-3 bg-yellow-100 font-semibold text-yellow-700 rounded-l-lg border border-yellow-300">
                                    Pathao</td>
                                <td
                                    class="p-3 text-center bg-green-100 text-green-700 border text-gray-700 border-gray-300">
                                    2
                                </td>
                                <td
                                    class="p-3 text-center bg-yellow-100 text-yellow-700 border text-gray-700 border-gray-300">
                                    2
                                </td>
                                <td
                                    class="p-3 text-center bg-red-100 text-red-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-purple-100 text-purple-700 border text-gray-700 border-gray-300">
                                    100%</td>
                            </tr>
                            <tr class="border-t hover:bg-purple-50 transition-colors">
                                <td
                                    class="p-3 bg-purple-100 font-semibold text-purple-700 rounded-l-lg border border-purple-300">
                                    Steadfast New</td>
                                <td
                                    class="p-3 text-center bg-green-100 text-green-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-yellow-100 text-yellow-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-red-100 text-red-700 border text-gray-700 border-gray-300">
                                    0
                                </td>
                                <td
                                    class="p-3 text-center bg-purple-100 text-purple-700 border text-gray-700 border-gray-300">
                                    N/A</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <button onclick="togglePopup()"
                        class="py-1 px-4 bg-gray-500 text-white rounded hover:bg-gray-600">Close</button>
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

</html>
