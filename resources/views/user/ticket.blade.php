@extends('layouts.user')

@section('title', 'My Ticket')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6 md:p-8">
            <!-- Header with download button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Your Ticket</h1>
                <button onclick="downloadTicket()" class="text-[#FF6B6B] font-medium hover:underline flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Download Ticket
                </button>
            </div>

            <!-- Ticket Card -->
            <div class="bg-[#ffd586e6] bg-opacity-20 p-6 rounded-lg border border-[#ffd586e6]">
                <!-- Event Info -->
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-bold text-lg">{{ $registration->event->title }}</h3>
                        <p class="text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $registration->event->formatted_date }}
                        </p>
                        <p class="text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $registration->event->formatted_time }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Ticket ID</p>
                        <p class="font-mono font-bold">{{ $registration->ticket_number }}</p>
                    </div>
                </div>

                <!-- Attendee Info -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Attendee</p>
                        <p class="font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $registration->user->name }}
                        </p>
                    </div>
                    <!-- Status section removed -->
                </div>

                <!-- QR Code Section - Always shown -->
                <div class="flex flex-col items-center mb-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm border mb-2">
                        <div class="w-32 h-32 flex items-center justify-center">
                            {!! QrCode::size(200)->generate($registration->ticket_number) !!}
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 text-center">Scan this QR code at event entrance</p>
                </div>

                <!-- Event Location -->
                <div class="text-center mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm font-medium text-gray-700 mb-1">Event Location</p>
                    <p class="text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $registration->event->location }}
                    </p>
                </div>

                <!-- Back button -->
                <div class="text-center mt-6">
                    <a href="{{ route('events.show', $registration->event->id) }}"
                       class="inline-flex items-center bg-gray-200 text-gray-800 px-4 py-2 rounded-md font-medium hover:bg-gray-300 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Event
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function downloadTicket() {
    // Load html2canvas dynamically if not already loaded
    if (typeof html2canvas !== 'function') {
        const script = document.createElement('script');
        script.src = 'https://html2canvas.hertzen.com/dist/html2canvas.min.js';
        script.onload = function() {
            captureTicket();
        };
        document.head.appendChild(script);
    } else {
        captureTicket();
    }

    function captureTicket() {
        const ticketElement = document.querySelector('.bg-\\[\\#ffd586e6\\]');
        html2canvas(ticketElement).then(canvas => {
            const link = document.createElement('a');
            link.download = 'ticket-{{ $registration->ticket_number }}.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    }
}
</script>

<style>
.bg-\[\#ffd586e6\] {
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffd586' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
}
</style>
@endsection
