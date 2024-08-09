<x-panel class="flex gap-x-6">
    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $waste->created_at->format('d/m/Y H:i:s') }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="/wastes/{{$waste->id}}">
                {{ $waste->title }}
            </a>
        </h3>
        <br>
        <x-show-price label="Valor perdido"> {{ $waste->waste_item_sum_total_price }}</x-show-price>
    </div>
    <div>
    </div>
</x-panel>