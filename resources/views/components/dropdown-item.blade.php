@props(['active' => false])

<a wire:navigate {{ $attributes }} class="{{ $active ? 'bg-gray-100 text-gray-900' : 'text-gray-700' }} block px-4 py-2 text-sm hover:bg-gray-100">
    {{ $slot }}
</a>
