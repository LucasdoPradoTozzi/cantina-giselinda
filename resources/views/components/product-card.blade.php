@props(['product'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm">{{ $product->productType->name }}</div>

    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
            <a href="#" target="_blank">
                {{ $product->name }}
            </a>
        </h3>
        <p class="text-sm mt-4">{{ $product->value }}</p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            <img src="http://picsum.photos/seed/{{ $product->id }}/100" alt="{{$product->name}}" class="rounded-xl">
        </div>
    </div>
</x-panel>