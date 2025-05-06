@section('title', 'Estoque de Produtos')
<div class="p-4">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700 bg-black">
            <thead class="bg-gray-800">
                <tr>
                    <x-table-header>Produto</x-table-header>
                    <x-table-header>Tipo do produto</x-table-header>
                    <x-table-header>Quantidade em estoque</x-table-header>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach ($stock as $item)
                <tr class="bg-black">
                    <x-table-data-href href="/products/{{$item->product->id}}">{{ $item->product->name }}</x-table-data-href>
                    <x-table-data>{{ $item->product->productType->name  }}</x-table-data>
                    <x-table-data-comparisson :minQuantity="$item->product->minimum_amount" :maxQuantity="$item->product->maximum_amount">
                        {{ $item->quantity }}</x-table-data-comparisson>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="mt-4 text-white">
        {{$stock->links()}}
    </div>
</div>