<header class="bg-white/90 dark:bg-[#2A2A2A]/90 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-slate-100/80 dark:border-[#3A3A3A] transition-colors duration-300">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <div class="relative">
                        <svg class="h-10 w-10 text-[#FFAA00] dark:text-[#FFD586] transform group-hover:rotate-12 transition-transform duration-300" viewBox="0 0 24 24" fill="none">
                            <path d="M16 8V4H8V8H4V16H8V20H16V16H20V8H16Z" fill="currentColor"/>
                            <path d="M14 14H10V10H14V14Z" fill="white"/>
                            <path d="M8 8H4V4H8V8Z" fill="#FFAAAA" opacity="0.8"/>
                            <path d="M20 8H16V4H20V8Z" fill="#FFAAAA" opacity="0.8"/>
                            <path d="M20 20H16V16H20V20Z" fill="#FFAAAA" opacity="0.8"/>
                            <path d="M8 20H4V16H8V20Z" fill="#FFAAAA" opacity="0.8"/>
                        </svg>
                        <span class="absolute inset-0 rounded-full bg-[#FFD586]/30 dark:bg-[#FFAA00]/20 opacity-0 group-hover:opacity-100 group-hover:animate-ping transition-opacity duration-300"></span>
                    </div>
                    <span class="ml-3 text-2xl font-bold bg-gradient-to-r from-[#FFAA00] to-[#FFAAAA] bg-clip-text text-transparent dark:from-[#FFD586] dark:to-[#FF8F8F]">
                        VENTIX
                    </span>
                </a>
            </div>

            <!-- Search Bar (Center) -->
            <div class="flex-1 max-w-xl mx-4 hidden md:block">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-[#3A3A3A] rounded-full bg-white/50 dark:bg-[#3A3A3A]/50 focus:outline-none focus:ring-2 focus:ring-[#FFAA00] dark:focus:ring-[#FFD586] focus:border-transparent transition-all duration-200" placeholder="Cari event...">
                </div>
            </div>

            <!-- User Navigation -->
          
                <!-- User Profile Dropdown -->
                <div class="relative ml-4" id="profile-dropdown">
                    <div id="profile-toggle" class="flex items-center space-x-2 cursor-pointer group">
                        <div class="h-9 w-9 rounded-full bg-gradient-to-r from-[#FFAA00] to-[#FFAAAA] dark:from-[#FFD586] dark:to-[#FF8F8F] flex items-center justify-center text-white font-semibold">
                            @auth
                                {{ substr(Auth::user()->name, 0, 1) }}
                            @else
                                G
                            @endauth
                        </div>
                        <span class="hidden md:inline text-gray-700 dark:text-gray-300 group-hover:text-[#FFAA00] dark:group-hover:text-[#FFD586] transition-colors">
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                Guest
                            @endauth
                        </span>
                        <!-- Dropdown arrow SVG -->
                    </div>

                    <!-- Dropdown Menu -->
                    <div id="profile-menu" class="hidden absolute right-0 mt-2 w-56 origin-top-right bg-white dark:bg-[#3A3A3A] rounded-md shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 dark:divide-[#4A4A4A] focus:outline-none z-50 transition-all duration-200 transform opacity-0 scale-95">
                        @auth
                        <div class="px-4 py-3">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-[#4A4A4A] transition">Dashboard</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-[#4A4A4A] transition">Tiket Saya</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-[#4A3A3A] transition">Favorit</a>
                        </div>
                        <div class="py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-[#4A4A4A] transition flex items-center">
                                    <!-- Logout SVG -->
                                    Keluar
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="py-1">
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-[#4A4A4A] transition">Login</a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-[#4A4A4A] transition">Register</a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>

                <!-- Create Event Button -->

            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-slate-600 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-slate-50 dark:hover:bg-[#3A3A3A] focus:outline-none transition duration-200">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6 transform transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu (Dropdown) -->
    <div class="mobile-menu hidden md:hidden bg-white/95 dark:bg-[#2A2A2A]/95 backdrop-blur-lg border-t border-slate-100/80 dark:border-[#3A3A3A] transition-all duration-300">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <!-- Mobile Search -->
            <div class="px-2 py-3">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-[#3A3A3A] rounded-full bg-white/50 dark:bg-[#3A3A3A]/50 focus:outline-none focus:ring-2 focus:ring-[#FFAA00] dark:focus:ring-[#FFD586] focus:border-transparent transition-all duration-200" placeholder="Cari event...">
                </div>
            </div>

            <!-- Mobile Navigation Links -->
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-gray-50 dark:hover:bg-[#3A3A3A] transition">Dashboard</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-gray-50 dark:hover:bg-[#3A3A3A] transition">Tiket Saya</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-gray-50 dark:hover:bg-[#3A3A3A] transition">Favorit</a>


            <!-- Mobile Logout -->
            <form method="POST" action="{{ route('logout') }}" class="pt-4 border-t border-slate-100/80 dark:border-[#3A3A3A]">
                @csrf
                <button type="submit" class="block w-full px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] rounded-md transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = mobileMenu.classList.toggle('hidden');

            if (!isExpanded) {
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    mobileMenu.style.opacity = '1';
                    mobileMenu.style.transform = 'translateY(0)';
                    mobileMenu.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                }, 10);
            }
        });

        // Profile dropdown toggle
        const profileToggle = document.getElementById('profile-toggle');
        const profileMenu = document.getElementById('profile-menu');

        profileToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = profileMenu.classList.contains('opacity-0');

            if (isOpen) {
                profileMenu.classList.remove('hidden', 'opacity-0', 'scale-95');
                profileMenu.classList.add('opacity-100', 'scale-100');
            } else {
                profileMenu.classList.add('opacity-0', 'scale-95');
                profileMenu.classList.remove('opacity-100', 'scale-100');
                setTimeout(() => {
                    profileMenu.classList.add('hidden');
                }, 200);
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileMenu.contains(e.target) && !profileToggle.contains(e.target)) {
                profileMenu.classList.add('opacity-0', 'scale-95');
                profileMenu.classList.remove('opacity-100', 'scale-100');
                setTimeout(() => {
                    profileMenu.classList.add('hidden');
                }, 200);
            }
        });
    });
</script>
