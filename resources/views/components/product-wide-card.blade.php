@props(['product'])

<x-panel class="flex gap-x-6">
    <div>
        <img src="{{ asset('storage/photos/' . $product->photo_path) }}" alt="{{$product->name}}" class="w-32 h-32 rounded-xl">
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $product->productType->name }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="/products/{{$product->id}}">
                {{ $product->name }}
            </a>
        </h3>

        <x-show-price>{{ $product->value }}</x-show-price>
    </div>

    <div>

    </div>
</x-panel>