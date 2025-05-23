@props(['active' => false])

<a wire:navigate class="{{ $active ? 'bg-gray-900 text-white' : 'text-black hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a>