{{-- filepath: d:\project besar pweb\VENTIX-APP\resources\views\components\textarea.blade.php --}}
@props(['disabled' => false, 'error' => false, 'label' => null, 'placeholder' => '', 'rows' => 3])

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

    <!-- Textarea Field -->
    <textarea
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
                       px-4 py-3 text-sm leading-tight
                       focus:shadow-lg',
            'rows' => $rows,
            'placeholder' => $placeholder
        ]) }}
    >{{ old($attributes->get('name')) }}</textarea>

    <!-- Error Message -->
    @if($error && $attributes->has('name'))
        @error($attributes->get('name'))
            <p class="mt-1 text-xs text-[#FF6B6B] dark:text-[#FF8F8F] transition-colors duration-300">
                {{ $message }}
            </p>
        @enderror
    @endif
</div>
