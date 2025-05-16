@extends('admin.layouts.app')
@section('title', 'Sub Slider')
@section('content')

    <div class="bg-white w-full h-full flex flex-col gap-3">
        <!-- Page Heading -->
        <div class="px-4 pt-6 flex flex-col gap-1">
            <h1 class="text-2xl font-semibold text-gray-800">Slider Management</h1>
            <p class="text-sm text-gray-500">Track, filter, and manage all main sliders.</p>
        </div>

        <div class="flex justify-start px-4 flex-wrap mb-1">
            <a href="{{ route('slider.sub.create') }}"
                class="bg-teal-500 flex items-center justify-center text-white px-4 py-2 rounded text-sm font-medium hover:bg-teal-600 transition h-10 w-full md:w-auto">
                Add New Sub Slider
            </a>
        </div>

        <!-- Data Table with Scroll -->
        <div class="data overflow-x-auto">
            <div class="table-container overflow-x-auto max-h-[500px]">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-2 text-gray-800 text-xs uppercase">ID</th>
                            <th class="px-6 py-2 text-gray-800 text-xs uppercase">Author</th>
                            <th class="px-6 py-2 text-gray-800 text-xs uppercase">Image</th>
                            <th class="px-6 py-2 text-gray-800 text-xs uppercase">Role</th>
                            <th class="px-6 py-2 text-gray-800 text-xs uppercase text-center">Status</th>
                            <th class="px-6 py-2 text-gray-800 text-xs uppercase text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $slider->id }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $slider->author?->name ?? 'Unknown' }}</td>
                                <td class="px-6 py-3">
                                    <a href="{{ $slider->link }}" class="block">
                                        <img src="{{ asset('storage/' . $slider->images) }}" alt="Slider Image"
                                            class="w-24 h-16 object-cover rounded" />
                                    </a>
                                </td>
                                <td class="px-6 py-3 text-sm text-gray-700">{{ $slider->author_type }}</td>
                                <td class="px-6 py-3 text-sm text-gray-700 text-center">
                                    @if ($slider->status == 1)
                                        <span
                                            class="bg-green-600 text-white px-2 py-1 rounded text-xs font-semibold">Active</span>
                                    @else
                                        <span
                                            class="bg-red-600 text-white px-2 py-1 rounded text-xs font-semibold">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-2 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a onclick="return confirm('Edit unavailable access?')" href=""
                                            class="inline-block text-gray-600 text-[19px]"><i
                                                class="ri-edit-box-line"></i></a>
                                        <a onclick="return confirm('Are you sure?')"
                                            href="{{ route('slider.main.image.delete', ['slider' => $slider->id]) }}"
                                            class="inline-block text-gray-600 text-[19px]">
                                            <i class="ri-delete-bin-6-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 text-sm">
                                    No main sliders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4 flex justify-end">
                {{ $sliders->links() }}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "{{ session('success') }}",
                icon: "success",
                draggable: true
            });
        </script>
    @endif
@endpush
