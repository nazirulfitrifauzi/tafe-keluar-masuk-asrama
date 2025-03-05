@props([
    'href' => '#',
    'icon' => null,
    'label',
    'route' => null,
    'active' => false
])

<li class="relative px-6 py-3 {{ $active ? 'bg-teal-500' : '' }}">
    @if($active)
        <span class="absolute inset-y-0 left-0 w-2 bg-teal-600" aria-hidden="true"></span>
    @endif
    <a
        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150  {{ $active ? 'text-white' : 'text-gray-300 hover:text-white' }}"
        href="{{ $route ? route($route) : $href }}"
    >
        @if($icon)
            <x-icon :name="$icon" class="w-5 h-5" />
        @endif
        <span class="ml-4">{{ $label }}</span>
    </a>
</li> 