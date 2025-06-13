<!-- resources/views/components/event-card.blade.php -->
<div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:-translate-y-1 border border-gray-100">
    <div class="relative overflow-hidden">
        @if($event->banner_path)
            <img src="{{ asset('storage/' . $event->banner_path) }}"
                 alt="{{ $event->title }}"
                 class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
        @else
            <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-[#FF6B6B]/10 to-[#FFAA00]/10"></div>
                <div class="relative z-10 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-gray-500 text-sm font-medium">No Image Available</span>
                </div>
            </div>
        @endif

        <!-- Overlay gradient for better text readability -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

        @if($event->isFree)
            <span class="absolute top-3 right-3 bg-gradient-to-r from-[#FF6B6B] to-[#e05555] text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg transform transition-all duration-200 hover:scale-105">
                <span class="flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                    </svg>
                    FREE
                </span>
            </span>
        @endif
    </div>

    <div class="p-5">
        <!-- Organizer Info with Logo - Enhanced -->
        <div class="flex items-center mb-4 group/organizer">
            <div class="relative">
                @if($event->organizer && $event->organizer->logo_path)
                    <img src="{{ asset('storage/' . $event->organizer->logo_path) }}"
                         alt="Logo {{ $event->organizer->organization_name }}"
                         class="w-11 h-11 rounded-full object-cover shadow-md ring-2 ring-white cursor-pointer transform group-hover/organizer:scale-110 transition-all duration-300 hover:ring-[#FF6B6B]/50">
                @else
                    <div class="w-11 h-11 rounded-full bg-gradient-to-br from-[#FFAA00] to-[#FF6B6B] flex items-center justify-center text-white font-bold shadow-lg ring-2 ring-white cursor-pointer transform group-hover/organizer:scale-110 transition-all duration-300 hover:ring-[#FF6B6B]/50 hover:shadow-xl">
                        {{ $event->organizer ? substr($event->organizer->organization_name, 0, 1) : 'O' }}
                    </div>
                @endif
                <!-- Online indicator dot -->
                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-400 rounded-full border-2 border-white shadow-sm"></div>
            </div>
            <div class="ml-3 flex-1 min-w-0">
                <span class="text-sm font-medium text-gray-700 group-hover/organizer:text-[#FF6B6B] transition-colors duration-200 truncate block">
                    {{ $event->organizer->organization_name ?? 'Organizer' }}
                </span>
                <span class="text-xs text-gray-500">Event Organizer</span>
            </div>
        </div>

        <!-- Event Title and Category -->
        <div class="flex justify-between items-start mb-3">
            <h3 class="font-bold text-lg text-gray-900 leading-tight flex-1 mr-3 group-hover:text-[#FF6B6B] transition-colors duration-200">
                {{ $event->title }}
            </h3>
            <span class="bg-gradient-to-r from-[#ffd586] to-[#ffcc66] text-gray-800 text-xs px-3 py-1.5 rounded-full capitalize font-medium shadow-sm whitespace-nowrap">
                {{ $event->category }}
            </span>
        </div>

        <!-- Description -->
        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
            {{ $event->description }}
        </p>

        <!-- Location -->
        <div class="flex items-center text-sm text-gray-600 mb-3 group/location">
            <div class="flex items-center justify-center w-8 h-8 bg-gray-50 rounded-lg mr-3 group-hover/location:bg-[#FF6B6B]/10 transition-colors duration-200">
                <svg class="w-4 h-4 text-gray-500 group-hover/location:text-[#FF6B6B] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <span class="font-medium">{{ $event->location }}</span>
        </div>

        <!-- Date and Time -->
        <div class="flex items-center text-sm text-gray-600 mb-5 group/time">
            <div class="flex items-center justify-center w-8 h-8 bg-gray-50 rounded-lg mr-3 group-hover/time:bg-[#FF6B6B]/10 transition-colors duration-200">
                <svg class="w-4 h-4 text-gray-500 group-hover/time:text-[#FF6B6B] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <span class="font-medium">{{ $event->start_time }} - {{ $event->end_time }}</span>
        </div>

        <!-- Price and Action Button -->
        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
            <div class="flex flex-col">
                <span class="text-xs text-gray-500 mb-1">Price</span>
                <span class="font-bold text-lg" style="color: #FF6B6B">
                    @if($event->isFree)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                            </svg>
                            FREE
                        </span>
                    @else
                        Rp {{ number_format($event->ticket_price, 0, ',', '.') }}
                    @endif
                </span>
            </div>
            <a href="{{ route('events.show', $event) }}"
               class="bg-gradient-to-r from-[#FF6B6B] to-[#e05555] text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:from-[#e05555] hover:to-[#d04848] transition-all duration-200 transform hover:scale-105 hover:shadow-lg active:scale-95 flex items-center group/button">
                <span>{{ $isRegistered ? 'View Ticket' : 'Detail' }}</span>
                <svg class="w-4 h-4 ml-2 transform group-hover/button:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
