@props(['activeRoute' => null])

<!-- Overlay -->
<div id="mobileSidebarOverlay"
     class="fixed inset-0 z-20 bg-black bg-opacity-50"
     x-show="mobileSidebarOpen"
     x-transition.opacity
     x-cloak
     @click="mobileSidebarOpen = false">
</div>

<!-- Mobile Sidebar -->
<div id="mobileSidebar"
     class="fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-b from-[#FFD586] to-[#ffd586d8] shadow-lg transform transition-transform duration-300 ease-in-out"
     x-show="mobileSidebarOpen"
     x-cloak
     x-transition:enter="transition ease-in-out duration-300"
     x-transition:enter-start="-translate-x-full"
     x-transition:enter-end="translate-x-0"
     x-transition:leave="transition ease-in-out duration-300"
     x-transition:leave-start="translate-x-0"
     x-transition:leave-end="-translate-x-full">

    <!-- Header -->
    <div class="flex items-center justify-between h-16 px-4 bg-[#FF9898] shadow-md">
        <span class="text-white font-bold text-xl flex items-center">
            <i class="fas fa-crown mr-2"></i> Admin Panel
        </span>
        <!-- Close Button -->
        <button @click="mobileSidebarOpen = false" class="text-white text-xl">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation -->
    <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
        <div class="flex-1 px-4 space-y-2">
            <x-admin.sidebar-item
                href="{{ route('admin.dashboard') }}"
                icon="fa-tachometer-alt"
                :active="$activeRoute === 'admin.dashboard'">
                Dashboard
            </x-admin.sidebar-item>

            <x-admin.sidebar-item
                href="{{ route('admin.users.index') }}"
                icon="fa-users"
                :active="str_starts_with($activeRoute, 'admin.users')">
                User Management
            </x-admin.sidebar-item>

            <x-admin.sidebar-item
                href="{{ route('admin.events.index') }}"
                icon="fa-calendar-alt"
                :active="str_starts_with($activeRoute, 'admin.events')">
                Event Management
            </x-admin.sidebar-item>

            <x-admin.sidebar-item
                href="{{ route('admin.organizers.index') }}"
                icon="fa-building"
                :active="str_starts_with($activeRoute, 'admin.organizers')">
                Organizer Management
            </x-admin.sidebar-item>
        </div>
    </div>

    <!-- Footer -->
    <div class="p-4 border-t border-[#FF9898] bg-[#ffd586b3]">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full bg-[#FF9898] flex items-center justify-center text-white font-semibold shadow-md mr-3">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                <p class="text-xs font-medium text-gray-600">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <x-admin.sidebar-item
            href="{{ route('logout') }}"
            icon="fa-sign-out-alt"
            class="mt-4">
            Logout
        </x-admin.sidebar-item>
    </div>
</div>
