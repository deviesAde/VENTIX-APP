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
                    <h3 class="text-3xl font-bold">{{ $totalEvents }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#FF9898] bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-calendar text-[#FF9898]"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Paid Events</p>
                    <h3 class="text-3xl font-bold">{{ $upcomingEvents->where('type', 'paid')->count() }}</h3>
                </div>
                <div class="w-12 h-12 rounded-full bg-[#FFD586] bg-opacity-20 flex items-center justify-center">
                    <i class="fas fa-ticket-alt text-[#FFD586]"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500">Estimated Revenue</p>
                    <h3 class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
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
            <h2 class="text-xl font-semibold text-gray-800">Upcoming Events (Next 30 Days)</h2>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($upcomingEvents as $event)
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $event['name'] }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-calendar-alt mr-1"></i> {{ $event['date'] }}
                            <i class="fas fa-clock ml-3 mr-1"></i> {{ $event['time'] }}
                            <i class="fas fa-map-marker-alt ml-3 mr-1"></i> {{ $event['location'] }}
                            <span class="ml-3 px-2 py-1 text-xs rounded-full
                                @if($event['type'] === 'paid') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($event['type']) }}
                            </span>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Tickets</p>
                        <p class="font-medium">{{ $event['tickets'] }}</p>
                        @if($event['type'] === 'paid')
                        <p class="text-sm text-gray-500 mt-1">Potential Revenue</p>
                        <p class="font-medium">{{ $event['revenue'] }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="p-6 text-center text-gray-500">
                No upcoming events in the next 30 days
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
