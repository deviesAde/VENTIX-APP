@extends('layouts.organizer')

@section('title', 'Dashboard Organizer')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Total Events</p>
                    <h3 class="text-3xl font-bold">8</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#FF9898] bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-calendar text-[#FF9898]"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Tickets Sold</p>
                    <h3 class="text-3xl font-bold">1,024</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#FFD586] bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-ticket-alt text-[#FFD586]"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Total Revenue</p>
                    <h3 class="text-3xl font-bold">Rp 18.750.000</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-green-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Event Mendatang</h2>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach([
                ['name' => 'Konser Jazz Night', 'date' => '15 Juli 2023', 'location' => 'Jakarta', 'tickets' => '450/500', 'revenue' => 'Rp 9.000.000'],
                ['name' => 'Tech Conference 2023', 'date' => '22 Agustus 2023', 'location' => 'Bandung', 'tickets' => '320/500', 'revenue' => 'Rp 6.400.000'],
                ['name' => 'Food Festival', 'date' => '5 September 2023', 'location' => 'Surabaya', 'tickets' => '180/300', 'revenue' => 'Rp 3.600.000']
            ] as $event)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $event['name'] }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-calendar-alt mr-1"></i> {{ $event['date'] }}
                            <i class="fas fa-map-marker-alt ml-3 mr-1"></i> {{ $event['location'] }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Tiket Terjual</p>
                        <p class="font-medium">{{ $event['tickets'] }}</p>
                        <p class="text-sm text-gray-500 mt-1">Pendapatan</p>
                        <p class="font-medium">{{ $event['revenue'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
