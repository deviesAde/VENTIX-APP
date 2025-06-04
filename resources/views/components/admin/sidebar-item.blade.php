@props([
    'href' => '#',
    'icon' => 'fa-circle',
    'active' => false,
    'class' => ''
])

<a href="{{ $href }}"
   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-[#FF9898] hover:text-white group sidebar-item transition-all duration-200 ease-in-out {{ $active ? 'active-sidebar-item' : '' }} {{ $class }}">
    <i class="fas {{ $icon }} w-5 h-5 text-[#FF9898] group-hover:text-white {{ $active ? 'text-white' : '' }}"></i>
    <span class="ml-3">{{ $slot }}</span>
    <i class="fas fa-chevron-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
</a>
