<div id="mobile-sidebar" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 md:hidden">
    <div class="w-3/4 h-full bg-white transform transition-transform duration-300 ease-in-out">
        <div class="p-4 flex items-center justify-between border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-[#FFD586] flex items-center justify-center text-white font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">Organizer</p>
                </div>
            </div>
            <button id="close-mobile-menu" class="text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="p-4">
            <!-- Gunakan komponen sidebar-item yang sama -->
            <x-organizer.sidebar-item
                href="{{ route('organizer.dashboard') }}"
                icon="fas fa-tachometer-alt"
                :active="request()->routeIs('organizer.dashboard')">
                Dashboard
            </x-organizer.sidebar-item>

            <!-- Item lainnya sama seperti sidebar desktop -->

            <div class="mt-8 border-t border-gray-200 pt-4">
                <x-organizer.sidebar-item
                    href="{{ route('logout') }}"
                    icon="fas fa-sign-out-alt"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </x-organizer.sidebar-item>
            </div>
        </nav>
    </div>

    <script>
        document.getElementById('close-mobile-menu').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.add('hidden');
        });
    </script>
</div>
