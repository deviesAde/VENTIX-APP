<section id="home" class="relative bg-gradient-to-br from-[#FFD586] via-[#f8c272] to-[#DA6C6C] py-24 md:py-32 overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden opacity-15">
        <div class="absolute top-1/4 -left-20 w-80 h-80 rounded-full bg-white/10 animate-float animation-delay-2000"></div>
        <div class="absolute bottom-1/3 -right-20 w-96 h-96 rounded-full bg-white/10 animate-float animation-delay-3000"></div>
        <div class="absolute top-1/2 left-1/4 w-64 h-64 rounded-full bg-white/10 animate-float"></div>
    </div>

    <!-- Floating Ticket Decoration -->
    <div class="absolute top-20 left-10 w-24 h-36 bg-white/90 backdrop-blur-sm rounded-lg shadow-xl rotate-12 animate-float animation-delay-1000 z-0 hidden md:block">
        <div class="absolute inset-0 border-2 border-dashed border-primary/30 m-2 rounded"></div>
        <div class="p-2">
            <div class="h-3 w-3/4 bg-primary rounded-full mx-auto"></div>
            <div class="text-center mt-3 text-xs font-bold text-dark">VIP ACCESS</div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Text Content -->
            <div class="space-y-6 text-white text-center lg:text-left">
                <!-- Tagline Badge -->
                <div class="inline-flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                    <span class="text-sm font-semibold">🎟️ Platform Tiket No.1 di Indonesia</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                    <span class="text-white">Temukan & Nikmati</span>
                    <span class="relative inline-block">
                        <span class="relative z-10">Event Terbaik</span>
                        <span class="absolute bottom-2 left-0 w-full h-3 bg-accent/70 z-0"></span>
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-white/90 max-w-2xl mx-auto lg:mx-0">
                    Dari konser musik, festival kuliner, hingga workshop eksklusif - semua ada di VENTIX!
                </p>

                <!-- Search Bar -->


                <!-- Trust Badges -->
                <div class="flex flex-wrap justify-center lg:justify-start items-center gap-4 pt-6">
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                        <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                        <span class="text-sm">100% Verified Events</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-300" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-sm">4.9/5 (10K+ Reviews)</span>
                    </div>
                  


                </div>
            </div>

            <!-- Image Content -->
            <div class="relative">
                <!-- Main Image with Floating Effect -->
                <div class="relative z-10 transform transition-all duration-500 hover:rotate-1 hover:scale-105">
                    <div class="absolute -inset-4 bg-white/20 backdrop-blur-lg rounded-3xl rotate-3 animate-float animation-delay-2000"></div>
                    <img
                        src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        alt="Happy concert crowd"
                        class="relative z-20 rounded-2xl shadow-2xl border-4 border-white/20"
                    >
                </div>

                <!-- Floating Stats Cards -->
                <div class="absolute -bottom-6 -left-6 bg-white rounded-xl p-4 shadow-2xl z-30 animate-float animation-delay-1000">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-primary">50K+</p>
                        <p class="text-sm text-dark">Tiket Terjual</p>
                    </div>
                </div>

                <div class="absolute -top-6 -right-6 bg-accent rounded-xl p-4 shadow-2xl z-30 animate-float">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-white">500+</p>
                        <p class="text-sm text-white">Event Partner</p>
                    </div>
                </div>


                <div class="absolute top-10 -left-10 w-16 h-10 bg-accent/90 backdrop-blur-sm rounded-lg shadow-md -rotate-6 animate-float animation-delay-2500 z-20 hidden md:block"></div>
            </div>
        </div>
    </div>
</section>

<style>
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animation-delay-1000 {
        animation-delay: 1s;
    }
    .animation-delay-1500 {
        animation-delay: 1.5s;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-2500 {
        animation-delay: 2.5s;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
</style>
