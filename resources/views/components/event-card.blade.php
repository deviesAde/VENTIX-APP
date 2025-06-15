<!-- resources/views/components/event-card.blade.php -->
<div class="group relative bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl hover:-translate-y-2 border border-gray-100 backdrop-blur-sm">
    <!-- Subtle background pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgba(0,0,0,0.15) 1px, transparent 0); background-size: 20px 20px;"></div>
    </div>

    <div class="relative overflow-hidden">
        @if($event->banner_path)
            <div class="relative overflow-hidden">
                <img src="{{ asset('storage/' . $event->banner_path) }}"
                     alt="{{ $event->title }}"
                     class="w-full h-52 object-cover transition-all duration-700 group-hover:scale-110 group-hover:brightness-110">
                <!-- Enhanced overlay with gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
            </div>
        @else
            <div class="w-full h-52 bg-gradient-to-br from-gray-50 via-gray-100 to-gray-150 flex items-center justify-center relative overflow-hidden">
                <!-- Animated background pattern -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/5 via-[#FFAA00]/5 to-[#FF6B6B]/10 animate-pulse"></div>
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-4 left-4 w-8 h-8 bg-[#FF6B6B]/20 rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                    <div class="absolute top-8 right-12 w-6 h-6 bg-[#FFAA00]/20 rounded-full animate-bounce" style="animation-delay: 0.5s;"></div>
                    <div class="absolute bottom-12 left-8 w-4 h-4 bg-[#FF6B6B]/20 rounded-full animate-bounce" style="animation-delay: 1s;"></div>
                </div>
                <div class="relative z-10 text-center transform group-hover:scale-105 transition-transform duration-300">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-[#FF6B6B] to-[#FFAA00] rounded-2xl flex items-center justify-center mb-3 shadow-xl">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-gray-600 text-sm font-semibold">No Image Available</span>
                    <p class="text-gray-400 text-xs mt-1">Event Preview</p>
                </div>
            </div>
        @endif

        @if($event->isFree)
            <span class="absolute top-4 right-4 bg-gradient-to-r from-[#FF6B6B] via-[#FF5252] to-[#e05555] text-white px-4 py-2 rounded-full text-xs font-bold shadow-2xl transform transition-all duration-300 hover:scale-110 animate-pulse">
                <span class="flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                    </svg>
                    FREE EVENT
                </span>
            </span>
        @endif

        <!-- Enhanced corner decoration -->
        <div class="absolute top-0 left-0 w-0 h-0 border-l-[25px] border-l-transparent border-t-[25px] border-t-[#FF6B6B]/10 group-hover:border-t-[#FF6B6B]/20 transition-colors duration-500"></div>
    </div>

    <div class="p-6 relative">
        <!-- Organizer Info with Enhanced Styling -->
        <div class="flex items-center mb-5 group/organizer cursor-pointer">
            <div class="relative">
                @if($event->organizer && $event->organizer->logo_path)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $event->organizer->logo_path) }}"
                             alt="Logo {{ $event->organizer->organization_name }}"
                             class="w-12 h-12 rounded-full object-cover shadow-lg ring-3 ring-white transform group-hover/organizer:scale-110 transition-all duration-400 hover:ring-[#FF6B6B]/30 hover:shadow-xl">
                        <!-- Subtle glow effect -->
                        <div class="absolute inset-0 w-12 h-12 rounded-full bg-gradient-to-br from-[#FF6B6B]/20 to-transparent opacity-0 group-hover/organizer:opacity-100 transition-opacity duration-400"></div>
                    </div>
                @else
                    <div class="relative">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#FFAA00] via-[#FF8C00] to-[#FF6B6B] flex items-center justify-center text-white font-bold shadow-xl ring-3 ring-white transform group-hover/organizer:scale-110 transition-all duration-400 hover:shadow-2xl">
                            {{ $event->organizer ? substr($event->organizer->organization_name, 0, 1) : 'O' }}
                        </div>
                        <!-- Animated ring -->
                        <div class="absolute inset-0 w-12 h-12 rounded-full border-2 border-[#FF6B6B]/30 opacity-0 group-hover/organizer:opacity-100 animate-ping transition-opacity duration-400"></div>
                    </div>
                @endif
                <!-- Enhanced online indicator -->
                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-3 border-white shadow-lg">
                    <div class="w-full h-full bg-green-400 rounded-full animate-pulse"></div>
                </div>
            </div>
            <div class="ml-4 flex-1 min-w-0">
                <div class="flex items-center">
                    <span class="text-sm font-semibold text-gray-800 group-hover/organizer:text-[#FF6B6B] transition-colors duration-300 truncate">
                        {{ $event->organizer->organization_name ?? 'Organizer' }}
                    </span>
                    <svg class="w-4 h-4 ml-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <span class="text-xs text-gray-500 font-medium">Verified Organizer</span>
            </div>
        </div>

        <!-- Event Title and Category with Better Spacing -->
        <div class="flex justify-between items-start mb-4">
            <h3 class="font-bold text-xl text-gray-900 leading-tight flex-1 mr-4 group-hover:text-[#FF6B6B] transition-colors duration-300 line-clamp-2">
                {{ $event->title }}
            </h3>
            <span class="bg-gradient-to-r from-[#ffd586] via-[#ffcc66] to-[#ffb366] text-gray-800 text-xs px-4 py-2 rounded-full capitalize font-semibold shadow-md whitespace-nowrap border border-yellow-200">
                {{ $event->category }}
            </span>
        </div>

        <!-- Enhanced Description -->
        <div class="relative mb-5">
            <p class="text-gray-600 text-sm line-clamp-3 leading-relaxed">
                {{ $event->description }}
            </p>
            <!-- Subtle fade effect at bottom -->
            <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-t from-white to-transparent"></div>
        </div>

        <!-- Location with Enhanced Icon -->
        <div class="flex items-center text-sm text-gray-700 mb-4 group/location">
            <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl mr-4 group-hover/location:from-[#FF6B6B]/10 group-hover/location:to-[#FF6B6B]/5 transition-all duration-300 shadow-sm">
                <svg class="w-5 h-5 text-gray-500 group-hover/location:text-[#FF6B6B] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <div>
                <span class="font-semibold text-gray-800">{{ $event->location }}</span>
                <p class="text-xs text-gray-500">Event Location</p>
            </div>
        </div>

        <!-- Date and Time with Enhanced Styling -->
        <div class="flex items-center text-sm text-gray-700 mb-6 group/time">
            <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl mr-4 group-hover/time:from-[#FF6B6B]/10 group-hover/time:to-[#FF6B6B]/5 transition-all duration-300 shadow-sm">
                <svg class="w-5 h-5 text-gray-500 group-hover/time:text-[#FF6B6B] transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <span class="font-semibold text-gray-800">{{ $event->start_time }} - {{ $event->end_time }}</span>
                <p class="text-xs text-gray-500">Event Schedule</p>
            </div>
        </div>

        <!-- Enhanced Price and Action Button -->
        <div class="flex justify-between items-center pt-5 border-t border-gray-200">
            <div class="flex flex-col">
                <span class="text-xs text-gray-500 mb-1 font-medium uppercase tracking-wide">Event Price</span>
                <span class="font-bold text-xl flex items-center" style="color: #FF6B6B">
                    @if($event->isFree)
                        <span class="flex items-center bg-gradient-to-r from-green-100 to-emerald-100 px-3 py-1 rounded-full">
                            <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-green-700 font-bold">FREE</span>
                        </span>
                    @else
                        <span class="flex items-center">
                            <span class="text-sm text-gray-500 mr-1">Rp</span>
                            {{ number_format($event->ticket_price, 0, ',', '.') }}
                        </span>
                    @endif
                </span>
            </div>
            <a href="{{ route('events.show', $event) }}"
               class="relative bg-gradient-to-r from-[#FF6B6B] via-[#FF5252] to-[#e05555] text-white px-8 py-3 rounded-xl text-sm font-bold hover:from-[#e05555] hover:to-[#d04848] transition-all duration-300 transform hover:scale-105 hover:shadow-xl active:scale-95 flex items-center group/button overflow-hidden">
                <!-- Button background animation -->
                <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 -translate-x-full group-hover/button:translate-x-full transition-transform duration-700"></div>
                <span class="relative z-10">{{ $isRegistered ? 'View Ticket' : 'View Details' }}</span>
                <svg class="relative z-10 w-4 h-4 ml-2 transform group-hover/button:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Subtle bottom accent -->
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#FF6B6B]/20 via-[#FFAA00]/20 to-[#FF6B6B]/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
</div>
