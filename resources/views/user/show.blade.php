@extends('layouts.user')

@section('title', $event->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative">
            @if($event->banner_path)
                <img src="{{ asset('storage/' . $event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-64 md:h-96 object-cover">
            @else
                <div class="w-full h-64 md:h-96 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No banner</span>
                </div>
            @endif

            @if($event->isFree)
                <span class="absolute top-4 right-4 bg-[#FF6B6B] text-white px-4 py-1 rounded-full text-sm font-semibold">FREE</span>
            @endif
        </div>

        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-6">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold mb-2">{{ $event->title }}</h1>
                    <div class="flex items-center space-x-4 mb-4">
                        <span class="bg-[#ffd586e6] text-sm px-3 py-1 rounded-full capitalize">{{ $event->category }}</span>
                        <span class="text-gray-600 text-sm">{{ $event->start_time }}</span>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg mb-4 md:mb-0">
                    <div class="text-xl font-bold mb-2" style="color: #FF6B6B">
                        {{ $event->isFree ? 'FREE' : 'Rp ' . number_format($event->ticket_price, 0, ',', '.') }}
                    </div>
                    @if($isRegistered)
                        <a href="{{ route('events.ticket', auth()->user()->registrations->where('event_id', $event->id)->first()->id) }}"
                           class="block bg-[#FF6B6B] text-white text-center px-6 py-2 rounded-md font-medium hover:bg-[#e05555] transition">
                            View Ticket
                        </a>
                    @else
                        <form action="{{ route('events.register', $event) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-[#FF6B6B] text-white text-center px-6 py-2 rounded-md font-medium hover:bg-[#e05555] transition">
                                Register Now
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0 text-[#FF6B6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">Location</h3>
                        <p class="text-gray-600">{{ $event->location }}</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0 text-[#FF6B6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">Date & Time</h3>
                        <p class="text-gray-600">
                            @php
                                $start = \Carbon\Carbon::parse($event->start_time);
                                $end = \Carbon\Carbon::parse($event->end_time);
                            @endphp

                            @if($start->isSameDay($end))
                                {{ $start->format('l, F j, Y') }}<br>
                                {{ $start->format('g:i A') }} - {{ $end->format('g:i A') }}
                            @else
                                {{ $start->format('l, F j, Y g:i A') }}<br>
                                to<br>
                                {{ $end->format('l, F j, Y g:i A') }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0 text-[#FF6B6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">Penyelenggara</h3>
                        <p class="text-gray-600">
                            {{ $event->organizer->organization_name ?? 'Belum ada penyelenggara' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-bold mb-4">About This Event</h2>
                <p class="text-gray-700 leading-relaxed">{{ $event->description }}</p>
            </div>

            @if($isRegistered)
                @php
                    $registration = auth()->user()->registrations->where('event_id', $event->id)->first();
                @endphp
                <div class="border-t pt-6">
                    <h2 class="text-xl font-bold mb-4">Your Ticket</h2>
                    <div class="bg-[#ffd586e6] bg-opacity-20 p-6 rounded-lg border border-[#ffd586e6]">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-lg">{{ $event->title }}</h3>
                                <p class="text-gray-600">{{ $event->formatted_date }} • {{ $event->formatted_time }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Ticket ID</p>
                                <p class="font-mono font-bold">{{ $registration->ticket_number }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <p class="text-sm text-gray-500">Attendee</p>
                                <p class="font-medium">{{ auth()->user()->name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Status</p>
                                <p class="font-medium capitalize">{{ $registration->status }}</p>
                            </div>
                        </div>

                        <div class="flex justify-center mb-4">
                            <div class="bg-white p-4 rounded">
                                <!-- QR Code -->
                                <div class="w-32 h-32 flex items-center justify-center">
                                    {!! $registration->generateQrCode() !!}
                                </div>
                            </div>
                        </div>

                        @if($registration->status === 'pending')
                        <div class="text-center py-4 bg-yellow-50 rounded mb-4">
                            <p class="text-yellow-700">Your payment is still pending. Please complete the payment to confirm your registration.</p>
                            @if($registration->payment)
                                <a href="{{ route('payment.retry', $registration->payment->id) }}"
                                   class="mt-2 inline-block bg-[#FF6B6B] text-white px-4 py-2 rounded-md font-medium hover:bg-[#e05555] transition">
                                    Complete Payment
                                </a>
                            @endif
                        </div>
                        @endif

                        <div class="text-center">
                            <p class="text-sm text-gray-600">Show this ticket at the entrance</p>
                            <button class="text-[#FF6B6B] font-medium hover:underline mt-2" id="download-ticket">Download Ticket</button>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('download-ticket').addEventListener('click', function(e) {
                        e.preventDefault();
                        // Implement download functionality here
                        // You can use html2canvas or similar library to capture the ticket as image
                        alert('Download functionality will be implemented here');
                    });
                </script>
            @endif
        </div>
    </div>
</div>
@endsection
