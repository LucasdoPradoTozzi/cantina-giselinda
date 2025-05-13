@props(['sell'])

<x-panel class="flex gap-x-6">
    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $sell->created_at->format('d/m/Y H:i:s') }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="/sells/{{$sell->id}}">
                {{ $sell->title }}
            </a>
        </h3>
        <x-show-price label="Valor recebido"> {{ $sell->sale_value_for_show }}</x-show-price>
    </div>
    <div>
    </div>
</x-panel>