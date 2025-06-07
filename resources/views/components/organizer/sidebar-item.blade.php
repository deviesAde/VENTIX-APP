@props(['href' => '#', 'icon' => '', 'active' => false])

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => 'group relative flex items-center space-x-3 p-3 rounded-lg transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 hover:shadow-lg active:scale-95 ' . ($active ? 'bg-[#FF9898] text-white shadow-md scale-105' : 'text-gray-600 hover:bg-[#FFD586] hover:text-gray-800')]) }}>

    <!-- Icon dengan animasi -->
    <i class="{{ $icon }} w-5 text-center transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3"></i>

    <!-- Text dengan subtle animation -->
    <span class="transition-all duration-300 group-hover:font-medium">{{ $slot }}</span>

    <!-- Ripple effect overlay -->
    <div class="absolute inset-0 rounded-lg bg-white opacity-0 group-active:opacity-20 transition-opacity duration-150"></div>


</a>

<style>
    /* Tambahan CSS untuk efek yang lebih smooth */
    @keyframes subtle-bounce {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-2px); }
    }

    .group:hover {
        animation: subtle-bounce 0.6s ease-in-out;
    }

    /* Shadow yang lebih dramatic */
    .group:hover {
        box-shadow: 0 10px 25px -5px rgba(255, 152, 152, 0.4), 0 10px 10px -5px rgba(255, 152, 152, 0.04);
    }
</style>
