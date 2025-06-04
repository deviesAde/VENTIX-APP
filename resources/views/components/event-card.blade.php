<div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <!-- Event Image -->
    <div class="relative">
      <img class="h-48 w-full object-cover" src="{{ $event->image_url }}" alt="{{ $event->name }}">
      <div class="absolute top-2 right-2">
        <button class="p-2 bg-white rounded-full shadow-md hover:bg-secondary hover:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Event Details -->
    <div class="p-4">
      <div class="flex justify-between items-start">
        <div>
          <h3 class="font-bold text-lg text-gray-800 mb-1">{{ $event->name }}</h3>
          <p class="text-gray-600 text-sm mb-2">{{ $event->location }}</p>
        </div>
        <span class="bg-primary text-white text-xs font-semibold px-2 py-1 rounded">{{ $event->category }}</span>
      </div>

      <div class="mt-3 flex items-center text-gray-500 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        {{ $event->date->format('d M Y, H:i') }}
      </div>

      <div class="mt-4 flex justify-between items-center">
        <span class="font-bold text-secondary">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
        <button class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition-colors">
          Buy Ticket
        </button>
      </div>
    </div>
  </div>
