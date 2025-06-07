<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Dashboard - @yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Desktop Sidebar -->
        <x-organizer.sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="px-4 py-4 flex items-center justify-between">
                    <x-organizer.mobile-sidebar />

                    <h1 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>

                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600 hidden sm:inline">{{ auth()->user()->name }}</span>
                        <div class="w-10 h-10 rounded-full bg-[#FF9898] flex items-center justify-center text-white">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
