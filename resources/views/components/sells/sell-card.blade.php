@props(['sell'])
<div class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 rounded-xl shadow-md p-3 flex flex-col gap-1 border border-gray-300 hover:shadow-lg transition-all duration-200 min-w-[220px] max-w-full w-full">
    <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
        <span>{{ $sell->created_at->format('d/m/Y H:i') }}</span>
        <a href="/sells/{{$sell->id}}" class="text-gray-700 hover:underline font-semibold">Ver detalhes</a>
    </div>
    <div class="flex items-center justify-between">
        <div class="font-bold text-lg text-gray-900 truncate">{{ $sell->title }}</div>
    </div>
    <div class="flex items-center justify-between mt-1">
        <span class="text-sm text-gray-700">Valor da venda:</span>
        <span class="font-semibold text-green-700">{{ $sell->sale_value_for_show }}</span>
    </div>
    <div class="flex items-center justify-between mt-1">
        <span class="text-sm text-gray-700">Valor recebido:</span>
        @if($sell->paid_value < $sell->sale_value)
            <span>
                <span class="font-semibold text-gray-900">{{ $sell->paid_value_for_show }}</span>
                <span class="text-xs text-red-700">({{ $sell->remaining_value_for_show }})</span>
            </span>
            @else
            <span class="font-semibold text-green-700">{{ $sell->paid_value_for_show }}</span>
            @endif
    </div>
</div>