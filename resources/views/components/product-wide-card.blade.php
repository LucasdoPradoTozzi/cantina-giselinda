@props(['product'])

<x-panel class="flex gap-x-6">
    <div>
        <img src="http://picsum.photos/seed/{{ $product->id }}/100" alt="{{$product->name}}" class="rounded-xl">
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $product->productType->name }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="#" target="_blank">
                {{ $product->name }}
            </a>
        </h3>

        <p class="text-sm text-gray-400 mt-auto">{{ $product->value }}</p>
    </div>

    <div>

    </div>
</x-panel>