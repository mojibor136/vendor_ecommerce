@extends('seller.layouts.app')

@section('title', 'Sales Location Tracking')

@section('content')
    <div class="bg-white w-full h-full flex flex-col md:flex-row px-2 py-2 gap-2">
        <!-- Left Sidebar -->
        <div class="md:w-[300px] w-full border border-gray-200 rounded shadow-sm flex flex-col">
            <div class="w-full border-b bg-gray-50 p-2 flex flex-col gap-2">
                <!-- Country Dropdown -->
                <div class="w-full">
                    <label for="country" class="text-sm font-medium text-gray-700">Country</label>
                    <select id="country" name="country_id"
                        class="mt-1 w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                        <option selected disabled>Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Division Dropdown -->
                <div class="w-full">
                    <label for="division" class="text-sm font-medium text-gray-700">Division</label>
                    <select id="division" name="division_id"
                        class="mt-1 w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                        <option selected disabled>Select Division</option>
                    </select>
                </div>
            </div>

            <div class="flex-grow w-full bg-white rounded">
                <div class="border-b p-2">
                    <span class="text-sm text-green-600">Location Tracking</span>
                </div>
                <div class="flex flex-col">
                    <ul id="salesCounts" class="text-sm"></ul>
                </div>
            </div>
        </div>

        <div class="flex-grow w-full border border-gray-200 rounded shadow-sm bg-white">
            <div id="bangladeshMap" class="w-full h-[500px] rounded"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        $(document).ready(function() {
            function updateDivisionList(divisions) {
                $('#division').html('<option selected disabled>Select Division</option>');
                $.each(divisions, function(index, division) {
                    $('#division').append(`<option value="${division.id}">${division.name}</option>`);
                });
            }

            function updateShippingList(targetId, data) {
                $('#' + targetId).empty(); // Clear the existing list
                if (data && data.length > 0) {
                    $.each(data, function(index, item) {
                        $('#' + targetId).append(
                            `<div class="flex justify-between border-b p-2">
                    <li>${item.name}</li>
                    <li>${item.sales}</li>
                </div>`
                        );
                    });
                } else {
                    $('#' + targetId).append('<li>No sales data available.</li>');
                }
            }


            function loadCountryData(country_id) {
                if (country_id) {
                    $.ajax({
                        url: "{{ route('get.seller.sales.location') }}",
                        type: "GET",
                        data: {
                            country_id: country_id
                        },
                        dataType: "json",
                        success: function(response) {
                            updateDivisionList(response.divisions);
                            updateShippingList('salesCounts', response.Data);
                            loadDivisionMarkers(response.Data);
                        },
                        error: function() {
                            alert("Something went wrong!");
                        }
                    });
                }
            }

            function loadDivisionData(division_id) {
                if (division_id) {
                    $.ajax({
                        url: "{{ route('get.seller.sales.location') }}",
                        type: "GET",
                        data: {
                            division_id: division_id
                        },
                        dataType: "json",
                        success: function(response) {
                            updateShippingList('salesCounts', response.Data);
                            loadDivisionMarkers(response.Data);
                        },
                        error: function() {
                            alert("Something went wrong!");
                        }
                    });
                }
            }

            $('#country').on('change', function() {
                const country_id = $(this).val();
                loadCountryData(country_id);
            });

            $('#division').on('change', function() {
                const division_id = $(this).val();
                loadDivisionData(division_id);
            });

            const defaultCountryId = $('#country').val();
            loadCountryData(defaultCountryId);
        });

        function loadDistrictMarkers(data) {
            if (window.salesMarkers) {
                window.salesMarkers.forEach(marker => map.removeLayer(marker));
            }
            window.salesMarkers = [];

            data.forEach(item => {
                if (item.lat && item.lng) {
                    const marker = L.marker([item.lat, item.lng]).addTo(map);

                    marker.bindTooltip(`
                <strong>${item.name}</strong> 
                <span style="font-weight: bold; color: #FF5733;">${item.sales}</span>`, {
                        permanent: true,
                        direction: 'top',
                        offset: [0, -10]
                    });

                    window.salesMarkers.push(marker);
                }
            });
        }

        function loadDivisionMarkers(data) {
            loadDistrictMarkers(data);
        }


        const map = L.map('bangladeshMap').setView([23.6850, 90.3563], 7); // ✅ Move this here

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        window.map = map;
    </script>
@endpush
