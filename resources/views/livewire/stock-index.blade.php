@section('title', 'Estoque de Produtos')

<div class="p-4">
    <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-700">
        <table class="min-w-full divide-y divide-gray-700 bg-gray-900 text-white">
            <thead class="bg-gray-800 text-sm uppercase text-gray-300">
                <tr>
                    <x-table-header>Produto</x-table-header>
                    <x-table-header>Tipo do produto</x-table-header>
                    <x-table-header>Qtd. atual</x-table-header>
                    <x-table-header>Qtd. mínima</x-table-header>
                    <x-table-header>Qtd. máxima</x-table-header>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach ($stock as $item)
                <tr class="odd:bg-gray-900 even:bg-gray-800">
                    <x-table-data-href href="/products/{{$item->product->id}}">
                        {{ $item->product->name }}
                    </x-table-data-href>

                    <x-table-data>
                        {{ $item->product->productType->name }}
                    </x-table-data>

                    <x-table-data-comparisson
                        :minQuantity="$item->product->minimum_amount"
                        :maxQuantity="$item->product->maximum_amount">
                        {{ $item->quantity }}
                    </x-table-data-comparisson>

                    <x-table-data>
                        {{ $item->product->minimum_amount }}
                    </x-table-data>

                    <x-table-data>
                        {{ $item->product->maximum_amount }}
                    </x-table-data>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-white">
        {{ $stock->links() }}
    </div>
</div>