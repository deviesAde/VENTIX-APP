@props(['disabled' => false, 'error' => false, 'icon' => null, 'type' => 'text', 'label' => null])

<div class="relative space-y-1 w-full">
    <!-- Label -->
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors duration-300">
            {{ $label }}
            @if($attributes->get('required'))
                <span class="text-[#FFAAAA]">*</span>
            @endif
        </label>
    @endif

    <!-- Input Field -->
    <div class="relative">
        @if($icon)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-[#FFAA00] dark:text-[#FFD586] transition-colors duration-300">
                {{ $icon }}
            </div>
        @endif

        <input
            @disabled($disabled)
            {{ $attributes->merge([
                'class' => 'block w-full rounded-xl border-2
                           '.($error ? 'border-[#FF6B6B] dark:border-[#FF8F8F]' : 'border-[#FFD586] dark:border-[#FFAA00]/70').'
                           bg-[#FFF5E6] dark:bg-[#2A2A2A]
                           text-gray-800 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-opacity-50
                           '.($error ? 'focus:border-[#FF6B6B] focus:ring-[#FF6B6B]' : 'focus:border-[#FFAA00] focus:ring-[#FFAA00]').'
                           shadow-sm hover:shadow-md
                           transition-all duration-300 ease-in-out
                           disabled:opacity-60 disabled:cursor-not-allowed disabled:bg-gray-100 dark:disabled:bg-gray-700
                           placeholder-gray-500/70 dark:placeholder-gray-400/60
                           '.($icon ? 'pl-10' : 'pl-4').'
                           pr-10 py-3 text-sm leading-tight
                           focus:shadow-lg',
                'type' => $type
            ]) }}
        />

        <!-- Password Toggle or Error Icon -->
        @if($attributes->get('type') === 'password')
            <button
                type="button"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-[#FFAA00] dark:hover:text-[#FFD586] focus:outline-none transition-colors duration-300 password-toggle"
                aria-label="Toggle password visibility"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        @elseif($error && $attributes->has('name'))
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-[#FF6B6B] dark:text-[#FF8F8F]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
        @endif
    </div>

    <!-- Error Message -->
    @if($error && $attributes->has('name'))
        @error($attributes->get('name'))
            <p class="mt-1 text-xs text-[#FF6B6B] dark:text-[#FF8F8F] transition-colors duration-300">
                {{ $message }}
            </p>
        @enderror
    @endif
</div>

<!-- Password Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('.password-toggle');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const input = this.parentElement.querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);

                this.innerHTML = type === 'password'
                    ? `<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                       </svg>`
                    : `<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                       </svg>`;
            });
        });
    });
</script>
