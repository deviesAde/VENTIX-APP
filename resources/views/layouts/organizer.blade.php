<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Dashboard - @yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
</head>

<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50 font-sans antialiased">
    <!-- Alert Container -->
    <div id="alert-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    <div class="flex h-screen">
        <!-- Desktop Sidebar -->
        <x-organizer.sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-200/50 sticky top-0 z-40">
                <div class="px-4 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <x-organizer.mobile-sidebar />
                        <div>
                            <h1 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                @yield('title', 'Dashboard')
                            </h1>
                            <p class="text-sm text-gray-500 hidden sm:block">
                                Welcome back, manage your events efficiently
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-full transition-all duration-200">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute -top-1 -right-1 bg-red-400 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                        </button>

                        <!-- Settings -->
                        <button class="p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-full transition-all duration-200">
                            <i class="fas fa-cog text-lg"></i>
                        </button>

                        <!-- User Profile -->
                        <div class="flex items-center space-x-3">
                            <div class="hidden sm:block text-right">
                                <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">Event Organizer</p>
                            </div>
                            <div class="relative group">
                                @if(auth()->user()->organizer && auth()->user()->organizer->logo_path)
                                <img src="{{ asset('storage/' . auth()->user()->organizer->logo_path) }}"
                                     alt="Logo Organizer"
                                     class="w-10 h-10 rounded-full object-cover shadow-md ring-2 ring-white cursor-pointer transform hover:scale-105 transition-all duration-200">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#FF9898] to-[#FF7B7B] flex items-center justify-center text-white font-semibold shadow-md ring-2 ring-white cursor-pointer transform hover:scale-105 transition-all duration-200">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif


                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                                    <div class="py-1">
                                        <a href="{{ route('organizer.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                            <i class="fas fa-user-circle mr-3 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a href="{{ route('organizer.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                            <i class="fas fa-cog mr-3 text-gray-400"></i>
                                            Settings
                                        </a>
                                        <hr class="my-1">
                                        <a href="{{ route('logout') }}" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            <i class="fas fa-sign-out-alt mr-3 text-red-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Laravel Flash Messages -->
            @if(session('success') || session('error') || session('warning') || session('info'))
                <div class="px-6 pt-4">
                    @if(session('success'))
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 rounded-r-md shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-green-400 hover:text-green-600 transition-colors">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4 rounded-r-md shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-600 transition-colors">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4 rounded-r-md shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700 font-medium">{{ session('warning') }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-yellow-400 hover:text-yellow-600 transition-colors">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4 rounded-r-md shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700 font-medium">{{ session('info') }}</p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-blue-400 hover:text-blue-600 transition-colors">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Alert JavaScript Functions -->
    <script>
        // Alert System
        window.showAlert = function(type, message, duration = 5000) {
            const alertContainer = document.getElementById('alert-container');

            const alertColors = {
                success: {
                    bg: 'bg-green-50',
                    border: 'border-green-200',
                    icon: 'fas fa-check-circle text-green-400',
                    text: 'text-green-800'
                },
                error: {
                    bg: 'bg-red-50',
                    border: 'border-red-200',
                    icon: 'fas fa-exclamation-circle text-red-400',
                    text: 'text-red-800'
                },
                warning: {
                    bg: 'bg-yellow-50',
                    border: 'border-yellow-200',
                    icon: 'fas fa-exclamation-triangle text-yellow-400',
                    text: 'text-yellow-800'
                },
                info: {
                    bg: 'bg-blue-50',
                    border: 'border-blue-200',
                    icon: 'fas fa-info-circle text-blue-400',
                    text: 'text-blue-800'
                }
            };

            const colors = alertColors[type] || alertColors.info;

            const alertElement = document.createElement('div');
            alertElement.className = `${colors.bg} ${colors.border} border rounded-lg p-4 shadow-lg transform translate-x-full transition-all duration-300 ease-in-out max-w-sm`;

            alertElement.innerHTML = `
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="${colors.icon}"></i>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium ${colors.text}">${message}</p>
                    </div>
                    <div class="ml-4">
                        <button onclick="removeAlert(this)" class="${colors.text} hover:opacity-75 transition-opacity">
                            <i class="fas fa-times text-sm"></i>
                        </button>
                    </div>
                </div>
            `;

            alertContainer.appendChild(alertElement);

            // Animate in
            setTimeout(() => {
                alertElement.classList.remove('translate-x-full');
            }, 10);

            // Auto remove
            if (duration > 0) {
                setTimeout(() => {
                    removeAlert(alertElement.querySelector('button'));
                }, duration);
            }
        };

        window.removeAlert = function(button) {
            const alertElement = button.closest('div').parentElement.parentElement;
            alertElement.classList.add('translate-x-full');
            setTimeout(() => {
                if (alertElement.parentNode) {
                    alertElement.parentNode.removeChild(alertElement);
                }
            }, 300);
        };

        // Example usage functions (you can call these from your Blade templates or JavaScript)
        window.showSuccess = (message, duration) => showAlert('success', message, duration);
        window.showError = (message, duration) => showAlert('error', message, duration);
        window.showWarning = (message, duration) => showAlert('warning', message, duration);
        window.showInfo = (message, duration) => showAlert('info', message, duration);

        // Example: Auto-show alerts from Laravel flash messages
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showSuccess('{{ session('success') }}');
            @endif

            @if(session('error'))
                showError('{{ session('error') }}');
            @endif

            @if(session('warning'))
                showWarning('{{ session('warning') }}');
            @endif

            @if(session('info'))
                showInfo('{{ session('info') }}');
            @endif
        });
    </script>

    @stack('scripts')
</body>
</ht
