<x-panel class="flex gap-x-6 ">
    <h3 class="font-bold text-xl mt-3  group-hover:text-blue-800">
        <a href="{{ route('productTypes.edit', $productType) }}" wire:navigate>
            {{ $productType->name }}
        </a>
    </h3>
</x-panel>