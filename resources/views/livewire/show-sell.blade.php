@section('title', 'Relatório de Venda')
<div>
    <div class="flex flex-col items-center p-2 m-2 bg-black">
        <h1 class="text-3xl font-bold text-white m-2 p-2">
            {{$sell->title}}
        </h1>
        <p class="md-2 p-2">Total ganho R$ {{ $sell->sold_item_sum_sold_price}}</p>
        @foreach($sell->soldItem as $item)
        <table class="min-w-full divide-y divide-gray-700 bg-black">
            <thead class="bg-gray-800">
                <tr>
                    <x-table-header class="w-1/4">Produto</x-table-header>
                    <x-table-header class="w-1/4">Quantidade Vendida</x-table-header>
                    <x-table-header class="w-1/4">Preço por item</x-table-header>
                    <x-table-header class="w-1/4">Preço total do item</x-table-header>
                    <x-table-header class="w-1/4">Feito Oferta?</x-table-header>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                <tr class="bg-black">
                    <x-table-data class="w-1/4">{{ $item->product->name  }}</x-table-data>
                    <x-table-data class="w-1/4">{{ $item->amount  }}</x-table-data>
                    <x-table-data class="w-1/4">{{ $item->price_by_item  }}</x-table-data>
                    <x-table-data class="w-1/4">{{ $item->sold_price  }}</x-table-data>
                    <x-table-data class="w-1/4">{{ ($item->was_a_offer == 1) ? "Sim" : "Não"  }}</x-table-data>
                </tr>
            </tbody>
        </table>
        @endforeach
    </div>
</div>