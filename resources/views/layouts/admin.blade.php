<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans antialiased" x-data="{ mobileSidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Desktop Sidebar -->
        <x-admin.sidebar :activeRoute="request()->route()->getName()" />

        <!-- Mobile Sidebar -->
        <x-admin.mobile-sidebar :activeRoute="request()->route()->getName()" />

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <div class="flex items-center justify-between h-16 px-4 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <!-- Mobile menu button -->
                    <button @click="mobileSidebarOpen = true" class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="ml-4 text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas @yield('icon', 'fa-cog') mr-2 text-[#FF9898]"></i>
                        @yield('title')
                    </h1>
                </div>

                <!-- Top navigation items -->
                <div class="flex items-center space-x-4">
                    <!-- Notification bell -->
                    <button class="p-1 text-gray-600 hover:text-[#FF9898] relative focus:outline-none">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- User dropdown -->
                    <div class="relative ml-3" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-sm rounded-full focus:outline-none">
                            <span class="sr-only">Open user menu</span>
                            <div class="w-8 h-8 rounded-full bg-[#FF9898] flex items-center justify-center text-white font-semibold shadow-md hover:transform hover:scale-110 transition-transform">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="open"
                             @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-30 border border-gray-100">

                             <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2 text-[#FF9898]"></i> Your Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2 text-[#FF9898]"></i> Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6 bg-gray-50">
                <!-- Breadcrumbs -->
                <nav class="flex mb-4 md:mb-6" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#FF9898]">
                                <i class="fas fa-home mr-2"></i>
                                Home
                            </a>
                        </li>
                        @yield('breadcrumbs')
                    </ol>
                </nav>

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
