@extends('layouts.organizer')

@section('title', 'Statistik Penjualan')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Statistik Penjualan</h2>
        <div class="flex space-x-2">
            <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                <option>Semua Event</option>
                @foreach($events as $event)
                <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>
            <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                <option>Bulan Ini</option>
                <option>Minggu Ini</option>
                <option>Hari Ini</option>
                <option>Kustom</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Total Event</p>
                    <h3 class="text-3xl font-bold">{{ number_format($totalEvents) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#FF9898] bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-calendar text-[#FF9898]"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-500">Total event berbayar</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Total Tiket Tersedia</p>
                    <h3 class="text-3xl font-bold">{{ number_format($totalTickets) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#FFD586] bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-ticket-alt text-[#FFD586]"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-500">Total kuota tiket</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Pendapatan Potensial</p>
                    <h3 class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-purple-500"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-500">Jika semua tiket terjual</p>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Grafik Penjualan</h3>
        <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
            @if($chartData->count() > 0)
                <canvas id="salesChart"></canvas>
                <script>
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    const chartData = @json($chartData);

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: chartData.map(item => item.month),
                            datasets: [{
                                label: 'Tiket Tersedia',
                                data: chartData.map(item => item.tickets),
                                backgroundColor: 'rgba(255, 152, 152, 0.2)',
                                borderColor: 'rgba(255, 152, 152, 1)',
                                borderWidth: 2,
                                tension: 0.1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            @else
                <p class="text-gray-500">Tidak ada data penjualan</p>
            @endif
        </div>
    </div>

    <!-- Daftar Event -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Event</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Tiket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kuota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($events as $event)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($event->event_type === 'paid')
                                    Rp {{ number_format($event->ticket_price, 0, ',', '.') }}
                                @else
                                    Gratis
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($event->event_type === 'paid')
                                    {{ number_format($event->ticket_quantity) }}
                                @else
                                    Unlimited
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-[#FF9898]">
                                @if($event->event_type === 'paid')
                                    Rp {{ number_format($event->ticket_quantity * $event->ticket_price, 0, ',', '.') }}
                                @else
                                    Rp 0
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                            Belum ada event berbayar
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@endsection
