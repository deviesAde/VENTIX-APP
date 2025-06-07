{{-- filepath: d:\project besar pweb\VENTIX-APP\resources\views\organizer\create-event.blade.php --}}
@extends('layouts.organizer')

@section('title', 'Buat Event Baru')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Buat Event Baru</h2>

    <form method="POST" action="{{ route('organizer.events.store') }}" enctype="multipart/form-data" class="space-y-6" id="event-form">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kolom Kiri -->
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-gray-700 font-medium mb-2">Nama Event</label>
                    <input type="text" id="title" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent" placeholder="Contoh: Konser Jazz Night" value="{{ old('title') }}" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi Event</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent" placeholder="Deskripsikan event Anda secara detail">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="banner" class="block text-gray-700 font-medium mb-2">Gambar Event</label>
                    <input type="file" id="banner" name="banner" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent" accept="image/*">
                    @error('banner')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-gray-700 font-medium mb-2">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="start_time" class="block text-gray-700 font-medium mb-2">Waktu Mulai</label>
                        <input type="time" id="start_time" name="start_time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent" value="{{ old('start_time', '19:00') }}" required>
                        @error('start_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="end_date" class="block text-gray-700 font-medium mb-2">Tanggal Berakhir</label>
                        <input type="date" id="end_date" name="end_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent" value="{{ old('end_date') }}" required>
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="end_time" class="block text-gray-700 font-medium mb-2">Waktu Berakhir</label>
                        <input type="time" id="end_time" name="end_time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent" value="{{ old('end_time', '22:00') }}" required>
                        @error('end_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <button type="submit" name="draft" value="1" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Simpan Draft
            </button>
            <button type="submit" name="publish" value="1" class="px-6 py-2 bg-[#FF9898] hover:bg-[#FF7A7A] text-white rounded-lg">
                Publikasikan Event
            </button>
        </div>
    </form>
</div>

@section('scripts')
<script>
    document.getElementById('event-form').addEventListener('submit', function(e) {
        const startDate = document.getElementById('start_date').value;
        const startTime = document.getElementById('start_time').value;
        const endDate = document.getElementById('end_date').value;
        const endTime = document.getElementById('end_time').value;

        // Gabungkan tanggal dan waktu
        // Gabungkan tanggal dan waktu dengan format Y-m-d H:i:s
        const startDateTimeInput = document.createElement('input');
        startDateTimeInput.type = 'hidden';
        startDateTimeInput.name = 'start_time';
        startDateTimeInput.value = `${startDate} ${startTime}:00`;
        this.appendChild(startDateTimeInput);


        const endDateTimeInput = document.createElement('input');
        endDateTimeInput.type = 'hidden';
        endDateTimeInput.name = 'end_time';
        endDateTimeInput.value = `${endDate} ${endTime}:00`;
        this.appendChild(endDateTimeInput);
    });
</script>
@endsection
@endsection
