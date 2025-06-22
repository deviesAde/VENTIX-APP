@extends('layouts.user')

@section('title', $event->title)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Event Banner -->
            <div class="relative overflow-hidden">
                @if($event->banner_path)
                    <img src="{{ asset('storage/' . $event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-72 md:h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                @else
                    <div class="w-full h-72 md:h-[500px] bg-gradient-to-br from-[#FF6B6B] via-[#FF8E8E] to-[#ffd586e6] flex items-center justify-center relative overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full"></div>
                            <div class="absolute top-32 right-20 w-20 h-20 bg-white rounded-full"></div>
                            <div class="absolute bottom-20 left-32 w-24 h-24 bg-white rounded-full"></div>
                        </div>
                        <span class="text-white text-3xl md:text-4xl font-bold text-center px-6 relative z-10">{{ $event->title }}</span>
                    </div>
                @endif

                @if($event->isFree)
                    <div class="absolute top-6 right-6">
                        <div class="bg-white/95 backdrop-blur-sm text-[#FF6B6B] px-6 py-2 rounded-full text-sm font-bold shadow-xl border border-white/20 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            FREE EVENT
                        </div>
                    </div>
                @endif

                <!-- Floating back button -->
                <div class="absolute top-6 left-6">
                    <button onclick="history.back()" class="bg-white/95 backdrop-blur-sm p-3 rounded-full shadow-xl border border-white/20 hover:bg-white transition-all duration-200 group">
                        <svg class="w-5 h-5 text-gray-700 group-hover:text-gray-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Event Content -->
            <div class="p-6 md:p-10">
                <!-- Event Header -->
                <div class="flex flex-col xl:flex-row xl:justify-between xl:items-start gap-8 mb-10">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="bg-gradient-to-r from-[#ffd586e6] to-[#FFE4A3] text-gray-800 text-sm font-semibold px-4 py-2 rounded-full capitalize shadow-sm">
                                {{ $event->category }}
                            </span>
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $event->start_time->diffForHumans() }}
                            </div>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $event->title }}</h1>
                        <p class="text-lg text-gray-600 leading-relaxed">{{ $event->short_description }}</p>
                    </div>

                    <!-- Enhanced Ticket Box -->
                    <div class="bg-gradient-to-br from-white to-gray-50 p-8 rounded-2xl border-2 border-gray-100 shadow-xl w-full xl:w-80 flex-shrink-0 relative overflow-hidden">
                        <!-- Background decoration -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#FF6B6B]/10 to-transparent rounded-full -mr-16 -mt-16"></div>

                        <div class="relative z-10">
                            <div class="text-center mb-6">
                                <p class="text-sm font-medium text-gray-500 mb-2">Ticket Price</p>
                                <div class="text-4xl font-bold text-[#FF6B6B] mb-1">
                                    {{ $event->isFree ? 'FREE' : 'Rp ' . number_format($event->ticket_price, 0, ',', '.') }}
                                </div>
                                @if(!$event->isFree)
                                    <p class="text-sm text-gray-500">per person</p>
                                @endif
                            </div>

                            @if($isRegistered)
                                <a href="{{ route('events.ticket', auth()->user()->registrations->where('event_id', $event->id)->first()->id) }}"
                                   class="block bg-gradient-to-r from-green-500 to-green-600 text-white text-center px-8 py-4 rounded-xl font-semibold hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a1 1 0 001 1h1a1 1 0 011-1V5a2 2 0 00-2-2H5zM5 14a2 2 0 00-2 2v3a1 1 0 001 1h1a1 1 0 011-1v-3a2 2 0 00-2-2H5z"></path>
                                        </svg>
                                        View Your Ticket
                                    </div>
                                </a>
                            @else
                                <form action="{{ route('events.register', $event) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-gradient-to-r from-[#FF6B6B] to-[#FF8E8E] text-white text-center px-8 py-4 rounded-xl font-semibold hover:from-[#e05555] hover:to-[#e07575] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        <div class="flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Register Now
                                        </div>
                                    </button>
                                </form>
                            @endif

                            <div class="mt-4 text-center">
                                <p class="text-xs text-gray-500">Secure registration</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Event Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <!-- Location -->
                    <div class="group hover:shadow-lg transition-all duration-200 p-6 bg-gradient-to-br from-white to-red-50 rounded-xl border border-red-100">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gradient-to-br from-[#FF6B6B] to-[#FF8E8E] rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 mb-2 text-lg">Location</h3>
                                <p class="text-gray-600 mb-2">{{ $event->location }}</p>
                                @if($event->location_link)
                                    <a href="{{ $event->location_link }}" target="_blank" class="inline-flex items-center text-[#FF6B6B] font-medium hover:text-[#e05555] transition-colors text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        View on map
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Date & Time -->
                    <div class="group hover:shadow-lg transition-all duration-200 p-6 bg-gradient-to-br from-white to-blue-50 rounded-xl border border-blue-100">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2 text-lg">Date & Time</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ $event->start_time->format('l, F j, Y') }}<br>
                                    <span class="font-medium">{{ $event->start_time->format('g:i A') }} - {{ $event->end_time->format('g:i A') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Organizer -->
                    <div class="group hover:shadow-lg transition-all duration-200 p-6 bg-gradient-to-br from-white to-purple-50 rounded-xl border border-purple-100">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-200">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2 text-lg">Organizer</h3>
                                <p class="text-gray-600 mb-2">{{ $event->organizer->organization_name ?? 'Event Organizer' }}</p>
                                @if($event->organizer && $event->organizer->website)
                                    <a href="{{ $event->organizer->website }}" target="_blank" class="inline-flex items-center text-purple-600 font-medium hover:text-purple-700 transition-colors text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        Visit website
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Event Description -->
                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-gradient-to-r from-[#FF6B6B] to-[#FF8E8E] rounded-lg mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">About This Event</h2>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-white p-8 rounded-2xl border border-gray-100">
                        <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>
                </div>

                @if($isRegistered)
                    @php
                        $registration = auth()->user()->registrations->where('event_id', $event->id)->first();
                    @endphp

                    <!-- Enhanced Ticket Section -->
                    <div class="border-t-2 border-gray-100 pt-10">
                        <div class="flex items-center mb-8">
                            <div class="p-2 bg-gradient-to-r from-green-500 to-green-600 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a1 1 0 001 1h1a1 1 0 011-1V5a2 2 0 00-2-2H5zM5 14a2 2 0 00-2 2v3a1 1 0 001 1h1a1 1 0 011-1v-3a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Your Ticket</h2>
                        </div>

                        <div class="relative">
                            <!-- Ticket background with gradient -->
                            <div class="bg-gradient-to-br from-[#ffd586e6] via-[#FFE4A3] to-[#FF6B6B] p-1.5 rounded-3xl shadow-2xl">
                                <div class="bg-white rounded-2xl p-8 relative overflow-hidden">
                                    <!-- Background pattern -->
                                    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[#FF6B6B]/5 to-transparent rounded-full -mr-32 -mt-32"></div>
                                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-[#ffd586e6]/10 to-transparent rounded-full -ml-24 -mb-24"></div>

                                    <div class="relative z-10">
                                        <div class="flex flex-col lg:flex-row lg:justify-between gap-8 mb-8">
                                            <div class="flex-1">
                                                <div class="flex items-center mb-4">
                                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                                                    <span class="text-sm font-semibold text-green-600 uppercase tracking-wide">Registered</span>
                                                </div>
                                                <h3 class="font-bold text-2xl text-gray-800 mb-2">{{ $event->title }}</h3>
                                                <div class="flex items-center text-gray-600 mb-6">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span>{{ $event->start_time->format('l, F j, Y') }} • {{ $event->start_time->format('g:i A') }}</span>
                                                </div>
                                                <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-xl border border-gray-200">
                                                    <p class="text-sm font-medium text-gray-500 mb-1">Attendee</p>
                                                    <p class="font-bold text-lg text-gray-800">{{ auth()->user()->name }}</p>
                                                </div>
                                            </div>

                                            <div class="flex flex-col items-center lg:items-end">
                                                <div class="text-center lg:text-right mb-6">
                                                    <p class="text-sm font-medium text-gray-500 mb-2">Ticket ID</p>
                                                    <p class="font-mono font-bold text-xl text-gray-800 tracking-wider">{{ $registration->ticket_number }}</p>
                                                </div>
                                                <div class="bg-white border-4 border-dashed border-gray-300 p-4 rounded-2xl shadow-inner">
                                                    <div class="w-40 h-40 flex items-center justify-center">
                                                        {!! $registration->generateQrCode() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-t-2 border-dashed border-gray-200 pt-6">
                                            <div class="text-center mb-6">
                                                <div class="inline-flex items-center bg-gradient-to-r from-blue-50 to-purple-50 px-6 py-3 rounded-full border border-blue-200">
                                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                                    </svg>
                                                    <span class="text-sm font-semibold text-blue-800">Present this QR code at the event entrance</span>
                                                </div>
                                            </div>
                                            <div class="flex justify-center">
                                                <button onclick="downloadTicket()" class="inline-flex items-center gap-3 bg-gradient-to-r from-[#FF6B6B] to-[#FF8E8E] text-white font-semibold px-8 py-3 rounded-xl hover:from-[#e05555] hover:to-[#e07575] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
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
</div>
@endsection
