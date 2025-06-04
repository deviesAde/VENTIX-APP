<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-[#FFD586] dark:bg-[#E8C49C]
                border border-[#FFD586] dark:border-[#D4A05F] rounded-lg font-medium text-sm text-gray-900 dark:text-gray-100 uppercase tracking-wider
                shadow-sm hover:shadow-md
                hover:bg-[#FFE0A0] dark:hover:bg-[#F0D4A4]
                focus:outline-none focus:ring-2 focus:ring-[#FFD586]/50 dark:focus:ring-[#E8C49C]/50
                transition-all duration-200 ease-in-out
                relative overflow-hidden
                glow-effect'
]) }}>
    <span class="relative z-10 flex items-center gap-1.5">
        {{ $slot }}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </span>
</button>

<style>
    .glow-effect {
        position: relative;
    }
    .glow-effect::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, rgba(255,213,134,0) 0%, rgba(255,213,134,0.4) 50%, rgba(255,213,134,0) 100%);
        opacity: 0;
        transition: opacity 0.4s ease, transform 1s ease;
        transform: translateX(-100%);
    }
    .glow-effect:hover::after {
        opacity: 1;
        transform: translateX(100%);
    }
    .glow-effect:hover {
        box-shadow: 0 0 15px rgba(255, 213, 134, 0.6);
    }
</style>
