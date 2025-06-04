@props(['activeRoute' => null])

<aside class="hidden md:flex md:flex-shrink-0 transition-all duration-300 ease-in-out">
    <div class="flex flex-col w-64 bg-gradient-to-b from-[#FFD586] to-[#ffd586d8] border-r border-[#FF9898] shadow-lg">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-center h-16 px-4 bg-[#FF9898] shadow-md">
            <span class="text-white font-bold text-xl flex items-center">
                <i class="fas fa-crown mr-2"></i> Admin Panel
            </span>
        </div>

        <!-- Sidebar Navigation -->
        <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-4 space-y-2">
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
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-[#FF9898] bg-[#ffd586b3]">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-[#FF9898] flex items-center justify-center text-white font-semibold shadow-md mr-3 hover:transform hover:scale-110 transition-transform">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs font-medium text-gray-600">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-[#FF9898] hover:text-white group">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
