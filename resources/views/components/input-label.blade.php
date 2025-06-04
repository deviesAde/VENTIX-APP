@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-white dark:text-white mb-1 transition-all duration-200 ease-in-out']) }}>
    {{ $value ?? $slot }}
    @if($required)
        <span class="text-red-500 dark:text-red-400 ml-1">*</span>
    @endif
</label>
