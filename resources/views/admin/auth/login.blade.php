<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-roboto">
    <div class="flex items-center justify-center min-h-screen md:p-0 p-2">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h3 class="text-center text-2xl text-blue-600 font-semibold mb-6">Admin Login</h3>
            @if (session()->has('error'))
                <div class="bg-red-100 text-red-700 py-2 px-3 mb-4 shadow">
                    <span class="text-md">{{ session()->get('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-md text-gray-700">Email</label>
                    <input type="email"
                        class="mt-1 px-2 py-2 w-full text-md border border-gray-300 rounded 
                        @error('email') border-red-500 @enderror"
                        name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-md text-gray-700">Password</label>
                    <input type="password"
                        class="mt-1 px-2 py-2 w-full text-md border border-gray-300 rounded 
                        @error('password') border-red-500 @enderror"
                        name="password" id="password" placeholder="Password">
                    @error('password')
                        <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-300">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>
