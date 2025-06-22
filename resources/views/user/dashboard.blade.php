@extends('layouts.user')

@section('title', 'Browse Events')

@section('content')
<!-- Banner Slider -->
<div class="relative mb-12 overflow-hidden rounded-2xl shadow-2xl">
    <div class="slider-container h-80 md:h-96">
        <!-- Slide 1 -->
        <div class="slide active absolute inset-0 transition-all duration-500 ease-in-out">
            <div class="relative h-full bg-gradient-to-r from-purple-600 via-pink-600 to-red-500">
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-8">
                    <div>
                        <h2 class="text-4xl md:text-6xl font-bold mb-4 animate-fadeInUp">Discover Amazing Events</h2>
                        <p class="text-xl md:text-2xl mb-8 animate-fadeInUp animation-delay-200">Join thousands of people in unforgettable experiences</p>
                        <button class="bg-white text-purple-600 px-8 py-3 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 animate-fadeInUp animation-delay-400">
                            Explore Now
                        </button>
                    </div>
                </div>
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black opacity-20"></div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide absolute inset-0 transition-all duration-500 ease-in-out opacity-0">
            <div class="relative h-full bg-gradient-to-r from-blue-600 via-teal-600 to-green-500">
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-8">
                    <div>
                        <h2 class="text-4xl md:text-6xl font-bold mb-4">Connect & Network</h2>
                        <p class="text-xl md:text-2xl mb-8">Meet like-minded people and build lasting connections</p>
                        <button class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300">
                            Join Community
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide absolute inset-0 transition-all duration-500 ease-in-out opacity-0">
            <div class="relative h-full bg-gradient-to-r from-orange-500 via-red-500 to-pink-600">
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                <div class="relative z-10 flex items-center justify-center h-full text-center text-white px-8">
                    <div>
                        <h2 class="text-4xl md:text-6xl font-bold mb-4">Create Memories</h2>
                        <p class="text-xl md:text-2xl mb-8">From concerts to conferences, find your perfect event</p>
                        <button class="bg-white text-orange-600 px-8 py-3 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300">
                            Book Tickets
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Arrows -->
    <button class="slider-btn prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-3 rounded-full backdrop-blur-sm transition-all duration-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button class="slider-btn next absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-3 rounded-full backdrop-blur-sm transition-all duration-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    <!-- Dots Indicator -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <div class="dot w-3 h-3 rounded-full bg-white bg-opacity-60 cursor-pointer transition-all duration-300 active"></div>
        <div class="dot w-3 h-3 rounded-full bg-white bg-opacity-40 cursor-pointer transition-all duration-300"></div>
        <div class="dot w-3 h-3 rounded-full bg-white bg-opacity-40 cursor-pointer transition-all duration-300"></div>
    </div>
</div>

<div class="mb-8">
    <h1 class="text-3xl font-bold mb-4">Upcoming Events</h1>
    <p class="text-gray-600">Discover amazing events around you</p>
</div>

<div class="mb-8">
    <div class="flex flex-wrap gap-4 mb-6">
        <button class="px-4 py-2 rounded-full bg-[#FF6B6B] text-white">All</button>
        @foreach(['music', 'seminar', 'sports', 'technology', 'art'] as $category)
            <button class="px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300 transition capitalize">
                {{ $category }}
            </button>
        @endforeach
    </div>


</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($events as $event)
        @include('components.event-card', [
            'event' => $event,
            'isRegistered' => false
        ])
    @endforeach
</div>

<div class="mt-8">
    {{ $events->links() }}
</div>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.8s ease-out forwards;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.dot.active {
    background-color: rgba(255, 255, 255, 0.9) !important;
    transform: scale(1.2);
}

.slide.active {
    opacity: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.slider-btn.prev');
    const nextBtn = document.querySelector('.slider-btn.next');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
            slide.style.opacity = i === index ? '1' : '0';
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // Auto-slide every 5 seconds
    setInterval(nextSlide, 5000);
});
</script>
@endsection
