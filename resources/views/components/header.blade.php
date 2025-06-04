<header class="bg-white/90 dark:bg-[#2A2A2A]/90 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-slate-100/80 dark:border-[#3A3A3A] transition-colors duration-300">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo with Animation -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                    <div class="relative">
                        <!-- Logo SVG with animation -->
                        <svg class="h-10 w-10 text-[#FFAA00] dark:text-[#FFD586] transform group-hover:rotate-12 transition-transform duration-300" viewBox="0 0 24 24" fill="none">
                            <path d="M16 8V4H8V8H4V16H8V20H16V16H20V8H16Z" fill="currentColor"/>
                            <path d="M14 14H10V10H14V14Z" fill="white"/>
                            <path d="M8 8H4V4H8V8Z" fill="#FFAAAA" opacity="0.8"/>
                            <path d="M20 8H16V4H20V8Z" fill="#FFAAAA" opacity="0.8"/>
                            <path d="M20 20H16V16H20V20Z" fill="#FFAAAA" opacity="0.8"/>
                            <path d="M8 20H4V16H8V20Z" fill="#FFAAAA" opacity="0.8"/>
                        </svg>
                        <!-- Ping effect on hover -->
                        <span class="absolute inset-0 rounded-full bg-[#FFD586]/30 dark:bg-[#FFAA00]/20 opacity-0 group-hover:opacity-100 group-hover:animate-ping transition-opacity duration-300"></span>
                    </div>
                    <span class="ml-3 text-2xl font-bold bg-gradient-to-r from-[#FFAA00] to-[#FFAAAA] bg-clip-text text-transparent dark:from-[#FFD586] dark:to-[#FF8F8F]">
                        VENTIX
                    </span>
                </a>
            </div>

            <!-- Navigation Links with Active Indicator -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-1">
                    <a href="#home" class="relative px-4 py-3 font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] group transition-colors duration-200">
                        Home
                        <span class="absolute bottom-0 left-0 h-0.5 w-0 bg-[#FFAA00] dark:bg-[#FFD586] group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#about" class="relative px-4 py-3 font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] group transition-colors duration-200">
                        About
                        <span class="absolute bottom-0 left-0 h-0.5 w-0 bg-[#FFAA00] dark:bg-[#FFD586] group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#features" class="relative px-4 py-3 font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] group transition-colors duration-200">
                        Features
                        <span class="absolute bottom-0 left-0 h-0.5 w-0 bg-[#FFAA00] dark:bg-[#FFD586] group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#steps" class="relative px-4 py-3 font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] group transition-colors duration-200">
                        How It Works
                        <span class="absolute bottom-0 left-0 h-0.5 w-0 bg-[#FFAA00] dark:bg-[#FFD586] group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#events" class="relative px-4 py-3 font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] group transition-colors duration-200">
                        Events
                        <span class="absolute bottom-0 left-0 h-0.5 w-0 bg-[#FFAA00] dark:bg-[#FFD586] group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                <a href="{{ route('dashboard') }}" class="relative px-5 py-2.5 font-medium group">
                    <span class="relative z-10 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 transition-transform duration-200 group-hover:scale-110 text-[#FFAA00] dark:text-[#FFD586]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span class="text-[#FFAA00] dark:text-[#FFD586] group-hover:text-[#E69500] dark:group-hover:text-[#E6C275] transition-colors duration-300">Dashboard</span>
                    </span>
                    <span class="absolute inset-0 bg-[#FFD586]/20 dark:bg-[#FFAA00]/10 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-500 scale-95 group-hover:scale-100"></span>
                </a>
                @else
                    <a href="{{ route('login') }}" class="relative px-5 py-2.5 font-medium text-[#FFAA00] dark:text-[#FFD586] group">
                        <span class="relative z-10">Login</span>
                        <span class="absolute inset-0 bg-[#FFD586]/20 dark:bg-[#FFAA00]/10 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                    <a href="{{ route('register') }}" class="relative px-6 py-3 font-medium text-white group">
                        <span class="relative z-10">Sign Up</span>
                        <span class="absolute inset-0 bg-gradient-to-r from-[#FFAA00] to-[#FFAAAA] dark:from-[#FFD586] dark:to-[#FF8F8F] rounded-full shadow-lg transform group-hover:scale-105 transition-all duration-300"></span>
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button with Animation -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-slate-600 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-slate-50 dark:hover:bg-[#3A3A3A] focus:outline-none transition duration-200">
                    <span class="sr-only">Open main menu</span>
                    <!-- Hamburger Icon -->
                    <svg class="block h-6 w-6 transform transition duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <!-- Close Icon (hidden by default) -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu (Dropdown) -->
    <div class="mobile-menu hidden md:hidden bg-white/95 dark:bg-[#2A2A2A]/95 backdrop-blur-lg border-t border-slate-100/80 dark:border-[#3A3A3A] transition-all duration-300">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="#home" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-[#FFD586]/10 dark:hover:bg-[#FFAA00]/10 transition">Home</a>
            <a href="#about" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-[#FFD586]/10 dark:hover:bg-[#FFAA00]/10 transition">About</a>
            <a href="#features" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-[#FFD586]/10 dark:hover:bg-[#FFAA00]/10 transition">Features</a>
            <a href="#steps" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-[#FFD586]/10 dark:hover:bg-[#FFAA00]/10 transition">How It Works</a>
            <a href="#events" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 dark:text-gray-300 hover:text-[#FFAA00] dark:hover:text-[#FFD586] hover:bg-[#FFD586]/10 dark:hover:bg-[#FFAA00]/10 transition">Events</a>
            <div class="pt-4 border-t border-slate-100/80 dark:border-[#3A3A3A]">
                <a href="{{ route('login') }}" class="block w-full px-4 py-3 text-center font-medium text-[#FFAA00] dark:text-[#FFD586] hover:bg-[#FFD586]/10 dark:hover:bg-[#FFAA00]/10 rounded-md transition">Login</a>
                <a href="{{ route('register') }}" class="block w-full px-4 py-3 mt-2 text-center font-medium text-white bg-gradient-to-r from-[#FFAA00] to-[#FFAAAA] dark:from-[#FFD586] dark:to-[#FF8F8F] rounded-md shadow hover:opacity-90 transition">Sign Up</a>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');
        const hamburgerIcon = mobileMenuButton.querySelector('svg:first-child');
        const closeIcon = mobileMenuButton.querySelector('svg:last-child');

        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = mobileMenu.classList.toggle('hidden');

            // Toggle icons
            hamburgerIcon.classList.toggle('hidden', !isExpanded);
            closeIcon.classList.toggle('hidden', isExpanded);

            // Animate the menu
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
    });
</script>

<style>
    /* Animation for navigation underline */@keyframes underlineGrow {
    from {
        width: 0;
        left: 10%;
    }
    to {
        width: 100%;
        left: 0;
    }
}

.nav-link:hover span {
    animation: underlineGrow 0.3s forwards;
    position: absolute;
    bottom: 0;
    left: 0;
    height: 2px; /* Adjust thickness */
    background-color: #FFAA00; /* Adjust color */
    width: 100%; /* Ensure it spans the full width */
}
</style>
