@extends('admin.layouts.app')
@section('title', 'Edit Country')
@section('content')
    <div class="w-full h-full flex flex-col gap-4">
        <!-- Header Section -->
        <div class="flex flex-col bg-white shadow rounded md:p-6 p-4 md:gap-1 gap-3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Country</h2>
                <a href="{{ route('country.index') }}"
                    class="block md:hidden bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Country
                </a>
            </div>
            <div class="flex justify-between items-center text-gray-600 text-sm">
                <p>
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Home</a> / Country / Edit
                </p>
                <a href="{{ route('country.index') }}"
                    class="hidden md:block bg-teal-500 text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition">
                    All Country
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="w-full bg-white rounded md:px-6 px-3">
            <form action="{{ route('country.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $country->id }}">
                <!-- Country Name -->
                <div class="mb-6 mt-6">
                    <label for="country_name" class="block text-gray-700 font-medium">Country Name<span
                            class="text-red-400"> *</span></label>
                    <input type="text" name="country_name" id="country_name" placeholder="Country Name"
                        class="w-full mt-2 p-2 border rounded border-gray-300 text-gray-700" value="{{ $country->name }}">
                    @error('country_name')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mb-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ route('get.subcategories', ':id') }}".replace(':id', category_id),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#subcategory').empty();
                            $('#subcategory').append(
                                '<option value="">-- Select Subcategory --</option>');
                            $.each(data, function(key, subcategory) {
                                $('#subcategory').append('<option value="' + subcategory
                                    .id + '">' + subcategory.subcategory_name +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategory').empty();
                    $('#subcategory').append('<option value="">-- Select Subcategory --</option>');
                }
            });
        });
    </script>
@endpush
