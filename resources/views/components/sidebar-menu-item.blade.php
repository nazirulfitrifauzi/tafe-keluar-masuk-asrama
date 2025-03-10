@props([
    'href' => '#',
    'icon' => null,
    'label',
    'route' => null,
    'active' => false
])

<li class="relative px-6 py-3">
    @if($active)
        <span class="absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
    @endif
    <a
        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ $active ? 'text-red-600' : '' }}"
        href="{{ $route ? route($route) : $href }}"
    >
        @if($icon)
            <x-icon :name="$icon" class="w-5 h-5" />
        @endif
        <span class="ml-4">{{ $label }}</span>
    </a>
</li> 