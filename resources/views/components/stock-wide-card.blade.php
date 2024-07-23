@props(['stockItem'])

<x-panel class="flex gap-x-6">
    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $stockItem->product->productType->name }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="#">
                {{ $stockItem->product->name }}
            </a>
        </h3>

        <x-show-price>{{ $stockItem->quantity }}</x-show-price>
    </div>

    <div>

    </div>
</x-panel>