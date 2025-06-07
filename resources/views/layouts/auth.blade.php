<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EVENTIX') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-1deg); }
            50% { transform: translateY(-8px) rotate(1deg); }
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
        .animate-pulse-slow {
            animation: pulse 3s ease-in-out infinite;
        }
        .glass-container {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }
        .dark .glass-container {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .password-toggle {
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .bg-custom-primary {
            background-color: #FFD586;
        }
        .bg-custom-secondary {
            background-color: #FFAAAA;
        }
        .text-custom-primary {
            color: #FFD586;
        }
        .text-custom-secondary {
            color: #FFAAAA;
        }
        .border-custom-primary {
            border-color: #FFD586;
        }
        .border-custom-secondary {
            border-color: #FFAAAA;
        }
        .auth-container {
            min-height: 100vh;
        }
        .auth-image {
            background-image: url('/images/login.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .auth-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(255, 213, 134, 0.3), rgba(255, 170, 170, 0.2));
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-[#FFF5E6] via-[#FFFFFF] to-[#FFEEEE] dark:from-[#2A2A2A] dark:via-[#3A3A3A] dark:to-[#4A2A2A] text-gray-900 dark:text-gray-100 overflow-x-hidden">
    <!-- Main Container -->
    <!-- Main Container -->

         @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert">
                <span class="text-green-700">&times;</span>
            </button>
        </div>
    @endif

    <div class="auth-container flex flex-col md:flex-row">
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert">
                <span class="text-green-700">&times;</span>
            </button>
        </div>
    @endif
        <!-- Image Section -->
        <div class="auth-image hidden md:block md:w-1/2 lg:w-3/5 relative">
            <div class="absolute bottom-10 left-10 z-10 text-white">
                <h2 class="text-4xl font-bold mb-2 drop-shadow-lg">Discover Amazing Events</h2>
                <p class="text-lg opacity-90 drop-shadow-md">Join thousands of events happening around you</p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="w-full md:w-1/2 lg:w-2/5 flex items-center justify-center p-6 sm:p-8 md:p-12">
            <div class="w-full max-w-md">
                <!-- Animated Logo Container -->
                <div class="text-center mb-8 animate-float">
                    <a href="/" class="inline-flex items-center gap-3 hover:scale-105 transition-transform duration-300">
                        <x-application-logo class="w-12 h-12 sm:w-16 sm:h-16 fill-current text-[#FFAA00] dark:text-[#FFD586] drop-shadow-lg" />
                        <span class="text-2xl font-bold text-gray-800 dark:text-white drop-shadow-sm">VENTIX</span>
                    </a>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 animate-pulse-slow">
                        Platform booking tiket terdepan
                    </p>
                </div>

                <!-- Glassmorphism Card -->
                <div class="w-full glass-container shadow-xl rounded-2xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-1">
                    <div class="p-6 sm:p-8">
                        {{ $slot }}
                    </div>
                </div>


                <!-- Additional Links -->
                <div class="mt-6 text-center text-sm text-gray-700 dark:text-gray-300">
                    @if (Route::has('register'))
                        <p class="hover:scale-105 transition-transform inline-block">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-[#FFAA00] dark:text-[#FFD586] hover:text-[#E69500] dark:hover:text-[#E6C275] transition-colors underline decoration-wavy">
                                Daftar sekarang
                            </a>
                        </p>
                    @endif
                    <div>
                        <a href="{{ route('register.organizer') }}" class="inline-block text-[#FFAA00] dark:text-[#FFD586] hover:text-[#E69500] dark:hover:text-[#E6C275] transition-colors underline hover:scale-105">
                            {{ __('Register as Organizer') }}
                        </a>
                    </div>

                    <!-- Back to Home -->
                    <div>
                        <a href="/" class="inline-block text-[#FFAA00] dark:text-[#FFD586] hover:text-[#E69500] dark:hover:text-[#E6C275] transition-colors underline hover:scale-105">
                            {{ __('Back to Home') }}
                        </a>
                    </div>
                </div>

                <!-- Register as Organizer -->

            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
