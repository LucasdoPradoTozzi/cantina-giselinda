@props(['product'])

<x-panel class="flex gap-x-6">
    <div>
        <img src="{{$product->photo_path ? asset('storage/photos/' . $product->photo_path) : asset('images/noPhoto.jpg') }}" alt="{{$product->name}}" class="w-32 h-32 rounded-xl">
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $product->productType->name }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="/products/{{$product->id}}">
                {{ $product->name }}
            </a>
        </h3>

        <p class="text-base mt-3"> {{ $product->description }} </p>

        <x-show-price>{{ $product->value_for_show }}</x-show-price>
    </div>

    <div>

    </div>
</x-panel>