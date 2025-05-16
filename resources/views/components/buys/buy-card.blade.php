@props(['buy'])
<div class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 rounded-xl shadow-md p-4 flex flex-col gap-2 border border-gray-300 hover:shadow-lg transition-all duration-200 min-w-[220px] max-w-[320px] mx-auto">
    <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
        <span>{{ $buy->created_at->format('d/m/Y H:i') }}</span>
        <a href="/buys/{{$buy->id}}" class="text-gray-700 hover:underline font-semibold">Ver detalhes</a>
    </div>
    <div class="font-bold text-lg text-gray-900 truncate">{{ $buy->title }}</div>
    <div class="flex items-center justify-between mt-2">
        <span class="text-sm text-gray-700">Valor gasto:</span>
        <span class="font-semibold text-red-700">{{ $buy->purchase_item_sum_total_price_for_show }}</span>
    </div>
</div>