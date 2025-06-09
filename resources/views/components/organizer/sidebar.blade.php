<aside class="w-64 bg-white shadow-md flex-shrink-0 hidden md:block">
    <div class="p-4 flex items-center space-x-3 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            @if(auth()->user()->organizer && auth()->user()->organizer->logo_path)
                <img src="{{ asset('storage/' . auth()->user()->organizer->logo_path) }}"
                     alt="Logo Organizer"
                     class="w-12 h-12 rounded-full object-cover shadow-md" />
            @else
                <div class="w-12 h-12 rounded-full bg-[#FFD586] flex items-center justify-center text-white font-bold text-xl">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            @endif
            <div>
                <p class="font-semibold">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-500">Organizer</p>
            </div>
        </div>
       
    </div>
    <nav class="p-4 space-y-2">
        <x-organizer.sidebar-item
            href="{{ route('organizer.dashboard') }}"
            icon="fas fa-tachometer-alt"
            :active="request()->routeIs('organizer.dashboard')">
            Dashboard
        </x-organizer.sidebar-item>

        <x-organizer.sidebar-item
            href="{{ route('organizer.events') }}"
            icon="fas fa-calendar-alt"
            :active="request()->routeIs('organizer.events')">
            Event Saya
        </x-organizer.sidebar-item>

        <x-organizer.sidebar-item
            href="{{ route('organizer.events.create') }}"
            icon="fas fa-plus-circle"
            :active="request()->routeIs('organizer.events.create')">
            Buat Event Baru
        </x-organizer.sidebar-item>

        <x-organizer.sidebar-item
            href="{{ route('organizer.statistics') }}"
            icon="fas fa-chart-bar"
            :active="request()->routeIs('organizer.statistics')">
            Statistik Penjualan
        </x-organizer.sidebar-item>


        <x-organizer.sidebar-item
            href="{{ route('organizer.profile') }}"
            icon="fas fa-user"
            :active="request()->routeIs('organizer.profile')">
            Profil Saya
        </x-organizer.sidebar-item>

        <div class="mt-8 border-t border-gray-200 pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-organizer.sidebar-item
                    href="{{ route('logout') }}"
                    icon="fas fa-sign-out-alt"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                </x-organizer.sidebar-item>
            </form>
        </div>
    </nav>
</aside>
