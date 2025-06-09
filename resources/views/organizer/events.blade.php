@extends('layouts.organizer')

@section('title', 'Event Saya')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Header Section with Gradient Background -->
    <div class="bg-gradient-to-r from-[#FF9898] to-[#FFB5B5] rounded-2xl p-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">Daftar Event</h2>
                <p class="text-white/80">Kelola semua event Anda dengan mudah</p>
            </div>
            <a href="{{ route('organizer.events.create') }}"
               class="bg-white hover:bg-gray-50 text-[#FF9898] px-6 py-3 rounded-xl flex items-center font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 group">
                <i class="fas fa-plus mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                Buat Event Baru
            </a>
        </div>
    </div>

    <!-- Enhanced Table Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Event</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tiket</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Publikasi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($events as $event)
                    <tr class="hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 transition-all duration-200 group">
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    @if ($event->banner_path)
                                        <img src="{{ asset('storage/' . $event->banner_path) }}"
                                             alt="Banner {{ $event->title }}"
                                             class="w-24 h-16 object-cover rounded-xl shadow-md border-2 border-white group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-24 h-16 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center text-gray-400 rounded-xl shadow-md group-hover:scale-105 transition-transform duration-300">
                                            <i class="fas fa-image text-xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-base font-bold text-gray-900 group-hover:text-[#FF9898] transition-colors duration-200">{{ $event->title }}</div>
                                    <div class="text-sm text-gray-500 flex items-center mt-1">
                                        <i class="fas {{ $event->event_type === 'paid' ? 'fa-dollar-sign' : 'fa-gift' }} mr-1 text-xs"></i>
                                        {{ $event->event_type === 'paid' ? 'Berbayar' : 'Gratis' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-calendar-alt mr-2 text-[#FF9898]"></i>
                                {{ date('d M Y', strtotime($event->start_time)) }}
                            </div>
                            <div class="text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded-lg mt-1">
                                {{ date('d M Y', strtotime($event->start_time)) }} - {{ date('d M Y', strtotime($event->end_time)) }}
                            </div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm text-gray-900 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-[#FF9898]"></i>
                                {{ $event->location }}
                            </div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            @if($event->event_type === 'paid')
                                <div class="text-sm font-bold text-gray-900 flex items-center">
                                    <i class="fas fa-ticket-alt mr-2 text-[#FF9898]"></i>
                                    {{ $event->ticket_quantity }}
                                </div>
                                <div class="text-sm font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-lg mt-1">
                                    Rp {{ number_format($event->ticket_price, 0, ',', '.') }}
                                </div>
                            @else
                                <div class="text-sm font-bold text-emerald-600 bg-emerald-50 px-3 py-2 rounded-lg flex items-center">
                                    <i class="fas fa-gift mr-2"></i>
                                    Gratis
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @php
                                    $categories = [
                                        'music' => ['name' => 'Musik', 'icon' => 'fa-music', 'color' => 'purple'],
                                        'seminar' => ['name' => 'Seminar', 'icon' => 'fa-chalkboard-teacher', 'color' => 'blue'],
                                        'sports' => ['name' => 'Olahraga', 'icon' => 'fa-running', 'color' => 'orange'],
                                        'technology' => ['name' => 'Teknologi', 'icon' => 'fa-laptop-code', 'color' => 'indigo'],
                                        'art' => ['name' => 'Seni', 'icon' => 'fa-palette', 'color' => 'pink']
                                    ];
                                    $cat = $categories[$event->category] ?? ['name' => $event->category, 'icon' => 'fa-tag', 'color' => 'gray'];
                                @endphp
                                <span class="bg-{{ $cat['color'] }}-50 text-{{ $cat['color'] }}-700 px-3 py-2 rounded-lg text-xs font-semibold flex items-center w-fit">
                                    <i class="fas {{ $cat['icon'] }} mr-2"></i>
                                    {{ $cat['name'] }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-5 whitespace-nowrap">
                            @php
                                $status = 'Draft';
                                $color = 'yellow';
                                $icon = 'fa-edit';
                                $now = now();

                                if ($event->start_time <= $now && $event->end_time >= $now) {
                                    $status = 'Berlangsung';
                                    $color = 'green';
                                    $icon = 'fa-play-circle';
                                } elseif ($event->end_time < $now) {
                                    $status = 'Selesai';
                                    $color = 'blue';
                                    $icon = 'fa-check-circle';
                                } elseif ($event->start_time > $now) {
                                    $status = 'Akan Datang';
                                    $color = 'purple';
                                    $icon = 'fa-clock';
                                }
                            @endphp
                            <span class="px-3 py-2 inline-flex text-xs leading-5 font-bold rounded-xl bg-{{ $color }}-100 text-{{ $color }}-800 border border-{{ $color }}-200">
                                <i class="fas {{ $icon }} mr-2"></i>
                                {{ $status }}
                            </span>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            @php
                                $statusColor = $event->status === 'published' ? 'green' : 'yellow';
                                $statusIcon = $event->status === 'published' ? 'fa-globe' : 'fa-eye-slash';
                            @endphp
                            <span class="px-3 py-2 inline-flex text-xs leading-5 font-bold rounded-xl bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800 border border-{{ $statusColor }}-200">
                                <i class="fas {{ $statusIcon }} mr-2"></i>
                                {{ ucfirst($event->status) }}
                            </span>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex space-x-2">
                                <button onclick="openEditModal({{ json_encode($event) }})"
                                        class="bg-[#FF9898] hover:bg-[#FF7A7A] text-white p-2 rounded-lg hover:shadow-lg transform hover:scale-110 transition-all duration-200 group">
                                    <i class="fas fa-edit group-hover:rotate-12 transition-transform duration-200"></i>
                                </button>
                                <form action="{{ route('organizer.events.destroy', $event->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg hover:shadow-lg transform hover:scale-110 transition-all duration-200 group"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                        <i class="fas fa-trash group-hover:rotate-12 transition-transform duration-200"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Enhanced Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
    <div class="relative mx-auto p-6 border-0 w-full max-w-2xl shadow-2xl rounded-2xl bg-white transform transition-all duration-300 scale-95 hover:scale-100 m-4">
        <div class="text-center">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-[#FF9898] to-[#FFB5B5] -mx-6 -mt-6 mb-6 p-6 rounded-t-2xl">
                <h3 class="text-2xl font-bold text-white flex items-center justify-center">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Event
                </h3>
            </div>

            <form id="editForm" method="POST" class="text-left">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="edit_title" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-heading mr-2 text-[#FF9898]"></i>Judul Event
                        </label>
                        <input type="text" name="title" id="edit_title"
                               class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898]">
                    </div>

                    <div>
                        <label for="edit_start_time" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-play mr-2 text-[#FF9898]"></i>Waktu Mulai
                        </label>
                        <input type="datetime-local" name="start_time" id="edit_start_time"
                               class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898]">
                    </div>

                    <div>
                        <label for="edit_end_time" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-stop mr-2 text-[#FF9898]"></i>Waktu Selesai
                        </label>
                        <input type="datetime-local" name="end_time" id="edit_end_time"
                               class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898]">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="edit_location" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-[#FF9898]"></i>Lokasi
                        </label>
                        <input type="text" name="location" id="edit_location"
                               class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898]">
                    </div>

                    <div>
                        <label for="edit_event_type" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2 text-[#FF9898]"></i>Tipe Event
                        </label>
                        <select name="event_type" id="edit_event_type"
                                class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898]">
                            <option value="free">Gratis</option>
                            <option value="paid">Berbayar</option>
                        </select>
                    </div>

                    <div>
                        <label for="edit_category" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-list mr-2 text-[#FF9898]"></i>Kategori
                        </label>
                        <select name="category" id="edit_category"
                                class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898]">
                            <option value="music">Musik</option>
                            <option value="seminar">Seminar</option>
                            <option value="sports">Olahraga</option>
                            <option value="technology">Teknologi</option>
                            <option value="art">Seni</option>
                        </select>
                    </div>

                    <div>
                        <label for="edit_status" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-toggle-on mr-2 text-[#FF9898]"></i>Status
                        </label>
                        <select name="status" id="edit_status"
                                class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898]">
                            <option value="draft">Draft</option>
                            <option value="published">Dipublikasikan</option>
                        </select>
                    </div>

                    <div id="ticket_quantity_field" class="hidden">
                        <label for="edit_ticket_quantity" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-ticket-alt mr-2 text-[#FF9898]"></i>Jumlah Tiket
                        </label>
                        <input type="number" name="ticket_quantity" id="edit_ticket_quantity"
                               class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898]">
                    </div>

                    <div id="ticket_price_field" class="hidden">
                        <label for="edit_ticket_price" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-dollar-sign mr-2 text-[#FF9898]"></i>Harga Tiket (Rp)
                        </label>
                        <input type="number" name="ticket_price" id="edit_ticket_price"
                               class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898]">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="edit_description" class="block text-sm font-bold text-gray-700 mb-2">
                            <i class="fas fa-align-left mr-2 text-[#FF9898]"></i>Deskripsi
                        </label>
                        <textarea name="description" id="edit_description" rows="4"
                                  class="block w-full border-2 border-gray-200 rounded-xl shadow-sm py-3 px-4 focus:outline-none focus:ring-2 focus:ring-[#FF9898] focus:border-[#FF9898] transition-all duration-200 hover:border-[#FF9898] resize-none"></textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button" onclick="closeEditModal()"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-6 py-3 rounded-xl font-semibold transition-all duration-200 hover:shadow-lg transform hover:scale-105">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="submit"
                            class="bg-gradient-to-r from-[#FF9898] to-[#FF7A7A] hover:from-[#FF7A7A] hover:to-[#FF5C5C] text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

/* Custom scrollbar for modal */
#editModal {
    scrollbar-width: thin;
    scrollbar-color: #FF9898 transparent;
}

#editModal::-webkit-scrollbar {
    width: 6px;
}

#editModal::-webkit-scrollbar-track {
    background: transparent;
}

#editModal::-webkit-scrollbar-thumb {
    background-color: #FF9898;
    border-radius: 3px;
}

/* Smooth transitions for all interactive elements */
* {
    transition-property: transform, box-shadow, background-color, border-color;
    transition-duration: 0.2s;
    transition-timing-function: ease-in-out;
}
</style>

<script>
    // Create Modal Functions
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
}

// Edit Modal Functions
function openEditModal(event) {
    // Set form action
    document.getElementById('editForm').action = `/organizer/events/${event.id}`;

    // Fill form with event data
    document.getElementById('edit_title').value = event.title;
    document.getElementById('edit_description').value = event.description || '';
    document.getElementById('edit_location').value = event.location;

    // Format dates for datetime-local input
    const startTime = new Date(event.start_time);
    const endTime = new Date(event.end_time);

    document.getElementById('edit_start_time').value = startTime.toISOString().slice(0, 16);
    document.getElementById('edit_end_time').value = endTime.toISOString().slice(0, 16);

    document.getElementById('edit_event_type').value = event.event_type;
    document.getElementById('edit_category').value = event.category;

    // Handle ticket fields based on event type
    if (event.event_type === 'paid') {
        document.getElementById('edit_ticket_quantity').value = event.ticket_quantity;
        document.getElementById('edit_ticket_price').value = event.ticket_price;
        document.getElementById('ticket_quantity_field').classList.remove('hidden');
        document.getElementById('ticket_price_field').classList.remove('hidden');
    } else {
        document.getElementById('ticket_quantity_field').classList.add('hidden');
        document.getElementById('ticket_price_field').classList.add('hidden');
    }
    document.getElementById('edit_status').value = event.status;

    // Show modal with animation
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.relative').classList.remove('scale-95');
        modal.querySelector('.relative').classList.add('scale-100');
    }, 10);
}

function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.querySelector('.relative').classList.remove('scale-100');
    modal.querySelector('.relative').classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 200);
}

// Toggle ticket fields based on event type
document.getElementById('edit_event_type').addEventListener('change', function() {
    const isPaid = this.value === 'paid';
    const quantityField = document.getElementById('ticket_quantity_field');
    const priceField = document.getElementById('ticket_price_field');

    if (isPaid) {
        quantityField.classList.remove('hidden');
        priceField.classList.remove('hidden');
        // Add a subtle animation
        setTimeout(() => {
            quantityField.style.opacity = '1';
            priceField.style.opacity = '1';
        }, 100);
    } else {
        quantityField.classList.add('hidden');
        priceField.classList.add('hidden');
    }
});

// Close modals when clicking outside
window.onclick = function(event) {
    if (event.target === document.getElementById('createModal')) {
        closeCreateModal();
    }
    if (event.target === document.getElementById('editModal')) {
        closeEditModal();
    }
}

// Add keyboard navigation
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        if (!document.getElementById('editModal').classList.contains('hidden')) {
            closeEditModal();
        }
        if (!document.getElementById('createModal').classList.contains('hidden')) {
            closeCreateModal();
        }
    }
});
</script>
@endsection
