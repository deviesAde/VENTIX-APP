@props(['disabled' => false, 'error' => false, 'icon' => null, 'type' => 'text'])

<div class="relative">
    @if($icon)
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            {{ $icon }}
        </div>
    @endif

    <input
        @disabled($disabled)
        {{ $attributes->merge([
            'class' => 'block w-full rounded-lg border
                       '.($error ? 'border-[#FFAAAA] dark:border-[#CC8888]' : 'border-[#FFD586] dark:border-[#FFD586]').'
                       bg-[#FFE8C3]/90 dark:bg-[#E8C49C]/90
                       text-gray-900 dark:text-gray-100
                       focus:outline-none focus:ring-2
                       '.($error ? 'focus:border-[#FFAAAA] dark:focus:border-[#CC8888] focus:ring-[#FFAAAA]/50 dark:focus:ring-[#CC8888]/50' : 'focus:border-[#FFD586] dark:focus:border-[#FFD586] focus:ring-[#FFD586]/50 dark:focus:ring-[#FFD586]/50').'
                       shadow-lg
                       transition-all duration-300 ease-in-out
                       disabled:opacity-70 disabled:cursor-not-allowed
                       placeholder-gray-400 dark:placeholder-gray-500
                       '.($icon ? 'pl-10' : 'pl-4').'
                       pr-10 py-3',
            'type' => $type
        ]) }}
    />

    <!-- Eye Icon for Password Toggle -->
    @if($attributes->get('type') === 'password')
        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none password-toggle">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"></path>
            </svg>
        </button>
    @endif

    @if($error && $attributes->has('name'))
        @error($attributes->get('name'))
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-[#FFAAAA] dark:text-[#CC8888]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
        @enderror
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('.password-toggle');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const input = button.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);

                // Change icon based on state
                button.innerHTML = type === 'password'
                    ? `<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"></path></svg>`
                    : `<svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"></path><path d="M12 15l-3-3m0 0l3-3m-3 3h12"></path></svg>`;
            });
        });
    });
</script>
