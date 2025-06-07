@extends('layouts.organizer')

@section('title', 'Statistik Penjualan')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Statistik Penjualan</h2>
        <div class="flex space-x-2">
            <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#FF9898] focus:border-transparent">
                <option>Semua Event</option>
                <option>Konser Jazz Night</option>
                <option>Tech Conference 2023</option>
                <option>Food Festival</option>
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
                    <p class="text-gray-500">Total Penjualan</p>
                    <h3 class="text-3xl font-bold">1,245</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#FF9898] bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-ticket-alt text-[#FF9898]"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-500">Naik <span class="text-green-500">12%</span> dari bulan lalu</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Total Pendapatan</p>
                    <h3 class="text-3xl font-bold">Rp 25.750.000</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#FFD586] bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-[#FFD586]"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-500">Naik <span class="text-green-500">8%</span> dari bulan lalu</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Rata-rata Harga Tiket</p>
                    <h3 class="text-3xl font-bold">Rp 20.682</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-tag text-purple-500"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <p class="text-sm text-gray-500">Turun <span class="text-red-500">3%</span> dari bulan lalu</p>
            </div>
        </div>
    </div>

    <!-- Grafik Statistik -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Grafik Penjualan</h3>
        <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
            <p class="text-gray-500">Grafik penjualan akan ditampilkan disini</p>
        </div>
    </div>

    <!-- Daftar Tiket Terjual -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Detail Penjualan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Tiket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terjual</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach([
                        ['name' => 'Early Bird', 'price' => 'Rp 75.000', 'sold' => '350', 'revenue' => 'Rp 26.250.000'],
                        ['name' => 'Reguler', 'price' => 'Rp 100.000', 'sold' => '520', 'revenue' => 'Rp 52.000.000'],
                        ['name' => 'VIP', 'price' => 'Rp 250.000', 'sold' => '120', 'revenue' => 'Rp 30.000.000'],
                        ['name' => 'VVIP', 'price' => 'Rp 500.000', 'sold' => '50', 'revenue' => 'Rp 25.000.000']
                    ] as $ticket)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $ticket['name'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $ticket['price'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $ticket['sold'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-[#FF9898]">{{ $ticket['revenue'] }}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
