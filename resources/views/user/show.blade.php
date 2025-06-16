@extends('layouts.user')

@section('title', $event->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Event Banner -->
        <div class="relative">
            @if($event->banner_path)
                <img src="{{ asset('storage/' . $event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-64 md:h-96 object-cover">
            @else
                <div class="w-full h-64 md:h-96 bg-gradient-to-r from-[#FF6B6B] to-[#ffd586e6] flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">{{ $event->title }}</span>
                </div>
            @endif

            @if($event->isFree)
                <span class="absolute top-4 right-4 bg-white text-[#FF6B6B] px-4 py-1 rounded-full text-sm font-semibold shadow-md">FREE EVENT</span>
            @endif
        </div>

        <!-- Event Content -->
        <div class="p-6 md:p-8">
            <!-- Event Header -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6 mb-8">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-[#ffd586e6] text-sm px-3 py-1 rounded-full capitalize">{{ $event->category }}</span>
                        <span class="text-gray-500 text-sm">• {{ $event->start_time->diffForHumans() }}</span>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $event->title }}</h1>
                    <p class="text-gray-600 mb-4">{{ $event->short_description }}</p>
                </div>

                <!-- Ticket Box -->
                <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 w-full md:w-64 flex-shrink-0">
                    <div class="text-2xl font-bold mb-4 text-[#FF6B6B] text-center">
                        {{ $event->isFree ? 'FREE' : 'Rp ' . number_format($event->ticket_price, 0, ',', '.') }}
                    </div>
                    @if($isRegistered)
                        <a href="{{ route('events.ticket', auth()->user()->registrations->where('event_id', $event->id)->first()->id) }}"
                           class="block bg-[#FF6B6B] text-white text-center px-6 py-3 rounded-lg font-medium hover:bg-[#e05555] transition shadow-md hover:shadow-lg">
                            View Your Ticket
                        </a>
                    @else
                        <form action="{{ route('events.register', $event) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-[#FF6B6B] text-white text-center px-6 py-3 rounded-lg font-medium hover:bg-[#e05555] transition shadow-md hover:shadow-lg">
                                Register Now
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Event Details -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Location -->
                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                    <div class="p-2 bg-[#FF6B6B] bg-opacity-10 rounded-full">
                        <svg class="w-5 h-5 text-[#FF6B6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Location</h3>
                        <p class="text-gray-600">{{ $event->location }}</p>
                        @if($event->location_link)
                            <a href="{{ $event->location_link }}" target="_blank" class="text-[#FF6B6B] text-sm hover:underline mt-1 block">View on map</a>
                        @endif
                    </div>
                </div>

                <!-- Date & Time -->
                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                    <div class="p-2 bg-[#FF6B6B] bg-opacity-10 rounded-full">
                        <svg class="w-5 h-5 text-[#FF6B6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Date & Time</h3>
                        <p class="text-gray-600">
                            {{ $event->start_time->format('l, F j, Y') }}<br>
                            {{ $event->start_time->format('g:i A') }} - {{ $event->end_time->format('g:i A') }}
                        </p>
                    </div>
                </div>

                <!-- Organizer -->
                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                    <div class="p-2 bg-[#FF6B6B] bg-opacity-10 rounded-full">
                        <svg class="w-5 h-5 text-[#FF6B6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Organizer</h3>
                        <p class="text-gray-600">{{ $event->organizer->organization_name ?? 'Event Organizer' }}</p>
                        @if($event->organizer && $event->organizer->website)
                            <a href="{{ $event->organizer->website }}" target="_blank" class="text-[#FF6B6B] text-sm hover:underline mt-1 block">Visit website</a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Event Description -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">About This Event</h2>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            @if($isRegistered)
                @php
                    $registration = auth()->user()->registrations->where('event_id', $event->id)->first();
                @endphp

                <!-- Ticket Section -->
                <div class="border-t border-gray-200 pt-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Your Ticket</h2>
                    <div class="bg-gradient-to-br from-[#ffd586e6] to-[#FF6B6B] p-1 rounded-2xl shadow-lg">
                        <div class="bg-white rounded-xl p-6">
                            <div class="flex flex-col md:flex-row md:justify-between gap-6 mb-6">
                                <div>
                                    <h3 class="font-bold text-xl text-gray-800">{{ $event->title }}</h3>
                                    <p class="text-gray-600 mt-1">
                                        {{ $event->start_time->format('l, F j, Y') }} • {{ $event->start_time->format('g:i A') }}
                                    </p>
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-500">Attendee</p>
                                        <p class="font-medium text-gray-800">{{ auth()->user()->name }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-col items-end">
                                    <div class="text-right mb-4">
                                        <p class="text-sm text-gray-500">Ticket ID</p>
                                        <p class="font-mono font-bold text-gray-800">{{ $registration->ticket_number }}</p>
                                    </div>
                                    <div class="bg-white border-2 border-dashed border-gray-200 p-2 rounded-lg">
                                        <div class="w-32 h-32 flex items-center justify-center">
                                            {!! $registration->generateQrCode() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-4 mt-4">
                                <p class="text-sm text-center text-gray-500">Present this QR code at the event entrance</p>
                                <div class="flex justify-center mt-4">
                                    <button onclick="downloadTicket()" class="flex items-center gap-2 text-[#FF6B6B] font-medium hover:text-[#e05555] transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Download Ticket
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function downloadTicket() {
                        // Implement download functionality here
                        // You can use html2canvas or similar library to capture the ticket as image
                        alert('Ticket download will be implemented here');
                    }
                </script>
            @endif
        </div>
    </div>
</div>
@endsection
