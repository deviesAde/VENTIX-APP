@extends('layouts.admin')

@section('title', 'Event Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Event Details</h2>
        <a href="{{ route('admin.events.index') }}" class="text-[#FF6B6B] hover:text-[#e05555] flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Events
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Event Banner -->
        <div class="relative h-64 w-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
            @if($event->banner_path)
                <img src="{{ asset('storage/' . $event->banner_path) }}"
                     alt="{{ $event->title }}"
                     class="w-full h-full object-cover">
            @else
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            @endif
            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6">
                <h1 class="text-3xl font-bold text-white">{{ $event->title }}</h1>
                <div class="flex items-center mt-2">
                    <span class="bg-[#FF6B6B] text-white px-3 py-1 rounded-full text-xs font-bold">
                        {{ $event->category }}
                    </span>
                    @if($event->isFree)
                        <span class="ml-2 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                            FREE
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Organizer Info -->
                <div class="flex items-center mb-8">
                    @if($event->organizer && $event->organizer->logo_path)
                        <img src="{{ asset('storage/' . $event->organizer->logo_path) }}"
                             alt="{{ $event->organizer->organization_name }}"
                             class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-md">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#FFAA00] to-[#FF6B6B] flex items-center justify-center text-white font-bold text-2xl shadow-md border-2 border-white">
                            {{ $event->organizer ? substr($event->organizer->organization_name, 0, 1) : 'O' }}
                        </div>
                    @endif
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $event->organizer->organization_name ?? 'Organizer' }}</h3>
                        <p class="text-gray-600">Event Organizer</p>
                    </div>
                </div>

                <!-- Event Description -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">About This Event</h3>
                    <div class="prose max-w-none text-gray-600">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>

                <!-- Event Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-[#FF6B6B] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <h4 class="font-medium text-gray-800">Location</h4>
                        </div>
                        <p class="text-gray-600 ml-7">{{ $event->location }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-[#FF6B6B] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h4 class="font-medium text-gray-800">Date & Time</h4>
                        </div>
                        <p class="text-gray-600 ml-7">
                            {{ $event->start_date ? $event->start_date->format('l, F j, Y') : 'Date not set' }}<br>
                            {{ $event->start_time }} - {{ $event->end_time }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-[#FF6B6B] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h4 class="font-medium text-gray-800">Ticket Type</h4>
                        </div>
                        <p class="text-gray-600 ml-7">
                            @if($event->isFree)
                                Free Admission
                            @else
                                Paid - Rp {{ number_format($event->ticket_price, 0, ',', '.') }}
                            @endif
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center mb-2">
                            <svg class="w-5 h-5 text-[#FF6B6B] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <h4 class="font-medium text-gray-800">Capacity</h4>
                        </div>
                        <p class="text-gray-600 ml-7">
                            {{ $event->capacity ?? 'Unlimited' }} attendees
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-xl p-6 sticky top-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Event Summary</h3>

                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Organizer</h4>
                            <p class="text-gray-800">{{ $event->organizer->organization_name ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Date</h4>
                            <p class="text-gray-800">
                                {{ $event->start_date ? $event->start_date->format('F j, Y') : 'Date not set' }}
                            </p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Time</h4>
                            <p class="text-gray-800">{{ $event->start_time }} - {{ $event->end_time }}</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Location</h4>
                            <p class="text-gray-800">{{ $event->location }}</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Category</h4>
                            <p class="text-gray-800 capitalize">{{ $event->category }}</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Price</h4>
                            <p class="text-2xl font-bold" style="color: #FF6B6B">
                                @if($event->isFree)
                                    FREE
                                @else
                                    Rp {{ number_format($event->ticket_price, 0, ',', '.') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2.5 px-4 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center"
                                    onclick="return confirm('Are you sure you want to delete this event?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete Event
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
