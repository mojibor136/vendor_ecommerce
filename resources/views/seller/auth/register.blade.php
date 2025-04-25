<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Create</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center py-6 px-4">
    <div class="bg-white w-full max-w-3xl rounded-md shadow-md p-6">
        <h2 class="text-xl font-bold mb-6 text-gray-700">Create Seller Account</h2>

        <form id="sellerForm" method="POST" enctype="multipart/form-data" action="{{ route('seller.store') }}">
            @csrf

            {{-- Step 1: Personal Information --}}
            <div id="step1">
                <h3 class="text-[16px] mb-4 text-green-700">Step 1: Personal Information</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-800">Profile Image</label>
                        <input type="file" name="image" required
                            class="w-full mt-1 border border-gray-300 px-2 py-1.5 rounded">
                        @error('email')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Full Name</label>
                        <input type="text" name="name" data-field="name" placeholder="Enter full name"
                            value="{{ old('name') }}" required
                            class="input-check w-full mt-1 border border-gray-300 p-2 rounded">
                        <span id="nameError" class="text-sm text-red-500"></span>
                        @error('name')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Email</label>
                        <input type="email" name="email" data-field="email" placeholder="Enter email"
                            value="{{ old('email') }}" required
                            class="input-check w-full mt-1 border border-gray-300 p-2 rounded">
                        <span id="emailError" class="text-sm text-red-500"></span>
                        @error('email')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Password</label>
                        <input type="password" value="{{ old('password') }}" name="password"
                            placeholder="Enter password" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">
                        @error('password')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Confirm Password</label>
                        <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation"
                            placeholder="Re-enter password" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">
                        @error('password_confirmation')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Phone Number</label>
                        <input type="text" name="phone" data-field="phone" placeholder="Enter phone number"
                            value="{{ old('phone') }}" required
                            class="input-check w-full mt-1 border border-gray-300 p-2 rounded">
                        <span id="phoneError" class="text-sm text-red-500"></span>
                        @error('phone')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 text-right">
                    <button type="button" onclick="goToStep2()"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">Next</button>
                </div>
            </div>

            {{-- Step 2: Shop Info --}}
            <div id="step2" class="hidden">
                <h3 class="text-[16px] mb-4 text-green-700">Step 2: Shop Information</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-800">Shop Name</label>
                        <input type="text" name="shop_name" data-field="shop_name" placeholder="Enter shop name"
                            value="{{ old('shop_name') }}" required
                            class="input-check w-full mt-1 border border-gray-300 p-2 rounded">
                        <span id="shop_nameError" class="text-sm text-red-500"></span>
                        @error('shop_name')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Shop Description</label>
                        <textarea name="shop_description" placeholder="Describe your shop" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">{{ old('shop_description') }}</textarea>
                        @error('shop_description')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Country</label>
                        <select name="country_id" id="country" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">
                            <option value="">-- Select Country --</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Division</label>
                        <select id="division" name="division_id" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">
                            <option value="">-- Select Division --</option>
                        </select>
                        @error('division_id')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">District</label>
                        <select id="district" name="district_id" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">
                            <option value="">-- Select District --</option>
                        </select>
                        @error('district_id')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Shop Address</label>
                        <input type="text" name="shop_address" placeholder="Enter shop address" required
                            value="{{ old('shop_address') }}" class="w-full mt-1 border border-gray-300 p-2 rounded">
                        @error('shop_address')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Shop Logo</label>
                        <input type="file" name="shop_logo" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">
                        @error('shop_logo')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">Shop Banner</label>
                        <input type="file" name="shop_banner" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">
                        @error('shop_banner')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">NID Front Image</label>
                        <input type="file" name="nid_front_image" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">
                        @error('nid_front_image')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="text-gray-800">NID Back Image</label>
                        <input type="file" name="nid_back_image" required
                            class="w-full mt-1 border border-gray-300 p-2 rounded">
                        @error('nid_back_image')
                            <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="backToStep1()"
                        class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">Back</button>
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        function goToStep2() {
            document.getElementById('step1').classList.add('hidden');
            document.getElementById('step2').classList.remove('hidden');
        }

        function backToStep1() {
            document.getElementById('step2').classList.add('hidden');
            document.getElementById('step1').classList.remove('hidden');
        }

        // Unique field check
        document.querySelectorAll('.input-check').forEach((input) => {
            input.addEventListener('blur', function() {
                let field = this.getAttribute('data-field');
                let value = this.value.trim();

                document.getElementById(field + 'Error').innerText = '';

                if (value !== '') {
                    fetch("{{ route('seller.checkField') }}", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                field: field,
                                value: value
                            }),
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'error') {
                                document.getElementById(field + 'Error').innerText = data.message;
                            }
                        });
                }
            });
        });

        // Final validation before submit
        document.getElementById('sellerForm').addEventListener('submit', function(e) {
            let requiredFields = ['name', 'email', 'phone', 'shop_name'];
            let hasError = false;

            requiredFields.forEach((field) => {
                let input = document.querySelector(`[name="${field}"]`);
                let errorField = document.getElementById(field + 'Error');
                if (input.value.trim() === '') {
                    errorField.innerText = `${field.replace('_', ' ')} is required.`;
                    hasError = true;
                }
            });

            if (hasError) e.preventDefault();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#country').on('change', function() {
                var country_id = $(this).val();

                // যখন country চেঞ্জ হয়, তখন district গুলো clear করে দাও
                $('#district').empty();
                $('#district').append('<option value="">-- Select District --</option>');

                if (country_id) {
                    $.ajax({
                        url: "{{ route('get.division', ':id') }}".replace(':id', country_id),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#division').empty();
                            $('#division').append(
                                '<option value="">-- Select Division --</option>');

                            $.each(data, function(key, division) {
                                $('#division').append('<option value="' + division.id +
                                    '">' + division.name + '</option>');
                            });

                            // Optional: প্রথম division এর district অটো লোড করতে চাইলে নিচের কোড ব্যবহার করো
                            if (data.length > 0) {
                                let firstDivisionId = data[0].id;
                                loadDistricts(firstDivisionId);
                            }
                        }
                    });
                } else {
                    $('#division').empty();
                    $('#division').append('<option value="">-- Select Division --</option>');
                }
            });

            $('#division').on('change', function() {
                let division_id = $(this).val();
                loadDistricts(division_id);
            });

            function loadDistricts(division_id) {
                if (division_id) {
                    $.ajax({
                        url: "{{ route('get.district', ':id') }}".replace(':id', division_id),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#district').empty();
                            $('#district').append('<option value="">-- Select District --</option>');
                            $.each(data, function(key, district) {
                                $('#district').append('<option value="' + district.id + '">' +
                                    district.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#district').empty();
                    $('#district').append('<option value="">-- Select District --</option>');
                }
            }
        });
    </script>

</body>

</html>
