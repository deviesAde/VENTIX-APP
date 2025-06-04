<aside class="w-64 bg-[#FFD586] min-h-screen flex flex-col">
    <div class="p-4 border-b border-[#FFAAAA]">
        <h2 class="text-xl font-bold text-gray-800">Event Organizer</h2>
    </div>

    <nav class="flex-1 p-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('organizer.dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-[#FFAAAA] transition {{ request()->routeIs('organizer.dashboard') ? 'bg-[#FFAAAA] font-medium' : '' }}">
            Dashboard
        </a>

        <!-- Event Saya -->
        <a href="{{ route('organizer.events.index') }}" class="block px-4 py-2 rounded-lg hover:bg-[#FFAAAA] transition {{ request()->routeIs('organizer.events.*') && !request()->routeIs('organizer.events.create') ? 'bg-[#FFAAAA] font-medium' : '' }}">
            Event Saya
        </a>

        <!-- Buat Event Baru -->
        <a href="{{ route('organizer.events.create') }}" class="block px-4 py-2 rounded-lg hover:bg-[#FFAAAA] transition {{ request()->routeIs('organizer.events.create') ? 'bg-[#FFAAAA] font-medium' : '' }}">
            Buat Event Baru
        </a>

        <!-- Statistik Penjualan -->
        <a href="{{ route('organizer.statistics') }}" class="block px-4 py-2 rounded-lg hover:bg-[#FFAAAA] transition {{ request()->routeIs('organizer.statistics') ? 'bg-[#FFAAAA] font-medium' : '' }}">
            Statistik Penjualan
        </a>

        <!-- Profil Saya -->
        <a href="{{ route('organizer.profile') }}" class="block px-4 py-2 rounded-lg hover:bg-[#FFAAAA] transition {{ request()->routeIs('organizer.profile') ? 'bg-[#FFAAAA] font-medium' : '' }}">
            Profil Saya
        </a>
    </nav>

    <div class="p-4 border-t border-[#FFAAAA]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded-lg hover:bg-[#FFAAAA] transition flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
