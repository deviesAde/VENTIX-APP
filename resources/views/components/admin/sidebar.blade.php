@props(['activeRoute' => null])

<aside class="hidden md:flex md:flex-shrink-0 transition-all duration-300 ease-in-out transform hover:shadow-xl">
    <div class="flex flex-col w-64 bg-gradient-to-b from-[#FFD586] via-[#ffd586e6] to-[#ffd586cc] border-r border-[#FF9898]/50 shadow-2xl backdrop-blur-sm">
        <!-- Sidebar Header with improved styling -->
        <div class="flex items-center justify-center h-20 px-4 bg-gradient-to-r from-[#FF9898] to-[#ff7a7a] shadow-lg">
            <span class="text-white font-bold text-2xl flex items-center space-x-3">
                <i class="fas fa-crown text-yellow-300 drop-shadow-md"></i>
                <span class="tracking-wider">Admin Panel</span>
            </span>
        </div>

        <!-- Sidebar Navigation with better spacing -->
        <div class="flex flex-col flex-grow pt-6 pb-4 overflow-y-auto custom-scrollbar">
            <div class="flex-1 px-4 space-y-3">
                <!-- Dashboard Link -->
                <x-admin.sidebar-item
                    href="{{ route('admin.dashboard') }}"
                    icon="fa-tachometer-alt"
                    :active="$activeRoute === 'admin.dashboard'">
                    Dashboard
                </x-admin.sidebar-item>

                <!-- User Management Link -->
                <x-admin.sidebar-item
                    href="{{ route('admin.users.index') }}"
                    icon="fa-users"
                    :active="str_starts_with($activeRoute, 'admin.users')">
                    User Management
                </x-admin.sidebar-item>

                <!-- Event Management Link -->
                <x-admin.sidebar-item
                    href="{{ route('admin.events.index') }}"
                    icon="fa-calendar-alt"
                    :active="str_starts_with($activeRoute, 'admin.events')">
                    Event Management
                </x-admin.sidebar-item>

                <!-- Organizer Management Link -->
                <x-admin.sidebar-item
                    href="{{ route('admin.organizers.index') }}"
                    icon="fa-building"
                    :active="str_starts_with($activeRoute, 'admin.organizers')">
                    Organizer Management
                </x-admin.sidebar-item>

                <!-- Additional decorative element -->
                <div class="relative py-3">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-[#FF9898]/30"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-2 text-xs font-medium text-[#FF9898] bg-[#ffd58680] rounded-full">
                            Quick Access
                        </span>
                    </div>
                </div>

               
            </div>
        </div>

        <!-- Enhanced Sidebar Footer -->
        <div class="p-4 border-t border-[#FF9898]/30 bg-[#ffd58699] backdrop-blur-sm">
            <div class="flex items-center p-3 bg-white/30 rounded-lg shadow-sm hover:bg-white/50 transition-all duration-300 group">
                <div class="relative">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#FF9898] to-[#ff7a7a] flex items-center justify-center text-white font-bold shadow-lg group-hover:scale-110 transition-transform">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
                    </div>
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-600 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="mt-4 space-y-2">
                <a href="#" class="flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-[#FF9898]/20 hover:text-[#ff7a7a] transition-all">
                    <i class="fas fa-cog mr-2 text-[#FF9898]"></i>
                    Settings
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-[#FF9898]/30 hover:text-[#ff7a7a] group transition-all">
                        <i class="fas fa-sign-out-alt mr-2 text-[#FF9898] transform group-hover:translate-x-1 transition-transform"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 152, 152, 0.1);
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(255, 152, 152, 0.4);
        border-radius: 4px;
    }
</style>
