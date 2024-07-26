@props(['buy'])

<x-panel class="flex gap-x-6">
    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $buy->created_at->format('d/m/Y H:i:s') }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="/buys/{{$buy->id}}">
                {{ $buy->title }}
            </a>
        </h3>
        <x-show-price>{{ $buy->purchase_item_sum_total_price }}</x-show-price>
    </div>
    <div>
    </div>
</x-panel>