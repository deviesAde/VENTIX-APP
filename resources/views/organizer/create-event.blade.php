@extends('layouts.organizer')

@section('title', 'Buat Event Baru')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 border-b-2 border-[#FF9898] pb-2">
            Buat Event Baru
        </h1>

        <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Judul Event -->
            <div class="space-y-2">
                <label for="title" class="block text-sm font-semibold text-gray-700">
                    Judul Event <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition duration-200"
                       id="title"
                       name="title"
                       placeholder="Masukkan judul event"
                       required>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-semibold text-gray-700">
                    Deskripsi
                </label>
                <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition duration-200 resize-vertical"
                          id="description"
                          name="description"
                          rows="4"
                          placeholder="Deskripsikan event Anda secara detail"></textarea>
            </div>

            <!-- Lokasi -->
            <div class="space-y-2">
                <label for="location" class="block text-sm font-semibold text-gray-700">
                    Lokasi <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition duration-200"
                       id="location"
                       name="location"
                       placeholder="Alamat lengkap lokasi event"
                       required>
            </div>

            <!-- Kategori -->
            <div class="space-y-2">
                <label for="category" class="block text-sm font-semibold text-gray-700">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition duration-200"
                        id="category"
                        name="category"
                        required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="music">🎵 Music</option>
                    <option value="seminar">📚 Seminar</option>
                    <option value="sports">⚽ Sports</option>
                    <option value="technology">💻 Technology</option>
                    <option value="art">🎨 Art</option>
                </select>
            </div>

            <!-- Banner Event -->
            <div class="space-y-2">
                <label for="banner" class="block text-sm font-semibold text-gray-700">
                    Banner Event
                </label>
                <div class="flex items-center justify-center w-full">
                    <label for="banner" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> banner event</p>
                            <p class="text-xs text-gray-500">PNG, JPG atau JPEG (MAX. 5MB)</p>
                        </div>
                        <input id="banner" name="banner" type="file" class="hidden" accept="image/*" />
                    </label>
                </div>
            </div>

            <!-- Waktu Event -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="start_time" class="block text-sm font-semibold text-gray-700">
                        Waktu Mulai <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition duration-200"
                           id="start_time"
                           name="start_time"
                           required>
                </div>

                <div class="space-y-2">
                    <label for="end_time" class="block text-sm font-semibold text-gray-700">
                        Waktu Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="datetime-local"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition duration-200"
                           id="end_time"
                           name="end_time"
                           required>
                </div>
            </div>

            <!-- Tipe Event -->
            <div class="space-y-2">
                <label for="event_type" class="block text-sm font-semibold text-gray-700">
                    Tipe Event <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-[#FF9898] transition duration-200">
                        <input type="radio" name="event_type" value="free" class="text-[#FF9898] focus:ring-[#FF9898]" required>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">🆓 Gratis</div>
                            <div class="text-xs text-gray-500">Event tanpa biaya masuk</div>
                        </div>
                    </label>
                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-[#FF9898] transition duration-200">
                        <input type="radio" name="event_type" value="paid" class="text-[#FF9898] focus:ring-[#FF9898]" required>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">💰 Berbayar</div>
                            <div class="text-xs text-gray-500">Event dengan tiket berbayar</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Detail Tiket (Hidden by default) -->
            <div id="ticket-section" class="hidden space-y-4 p-4 bg-gray-50 rounded-lg border-l-4 border-[#FF9898]">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Detail Tiket</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="ticket_quantity" class="block text-sm font-semibold text-gray-700">
                            Jumlah Tiket <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition duration-200"
                               name="ticket_quantity"
                               id="ticket_quantity"
                               min="1"
                               placeholder="100">
                    </div>

                    <div class="space-y-2">
                        <label for="ticket_price" class="block text-sm font-semibold text-gray-700">
                            Harga Tiket (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition duration-200"
                               name="ticket_price"
                               id="ticket_price"
                               step="1000"
                               min="0"
                               placeholder="50000">
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                <button type="submit"
                        name="draft"
                        value="1"
                        class="flex-1 sm:flex-none px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition duration-200 focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                    📄 Simpan Draft
                </button>
                <button type="submit"
                        name="publish"
                        value="1"
                        class="flex-1 px-6 py-3 bg-[#FF9898] text-white font-semibold rounded-lg hover:bg-[#ff7f7f] transition duration-200 focus:ring-2 focus:ring-[#FF9898] focus:ring-offset-2 shadow-lg">
                    🚀 Publikasikan Event
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Toggle ticket section based on event type
    document.addEventListener('DOMContentLoaded', function() {
        const eventTypeRadios = document.querySelectorAll('input[name="event_type"]');
        const ticketSection = document.getElementById('ticket-section');
        const ticketQuantity = document.getElementById('ticket_quantity');
        const ticketPrice = document.getElementById('ticket_price');

        eventTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'paid') {
                    ticketSection.classList.remove('hidden');
                    ticketQuantity.required = true;
                    ticketPrice.required = true;
                } else {
                    ticketSection.classList.add('hidden');
                    ticketQuantity.required = false;
                    ticketPrice.required = false;
                    ticketQuantity.value = '';
                    ticketPrice.value = '';
                }
            });
        });
    });

    // File upload preview (optional enhancement)
    document.getElementById('banner').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const label = e.target.parentElement;
            const fileName = file.name;
            label.querySelector('p').innerHTML = `<span class="font-semibold text-[#FF9898]">File selected:</span> ${fileName}`;
        }
    });
</script>
@endsection
