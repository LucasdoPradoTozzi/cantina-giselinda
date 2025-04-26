<div>
    <x-page-heading>Criar Nova Venda</x-page-heading>

    <form wire:submit.prevent="submit">
        <div class="flex justify-center">
            <div class="bg-gray-800 rounded-lg p-6 text-white space-y-4 w-full max-w-xl">
                <div class="form-group">
                    <label for="product_id" class="block mb-2 font-semibold">Produto</label>
                    <select
                        wire:model="selectedProductId"
                        id="product_id"
                        class="rounded-xl bg-black/100 border border-white/10 px-5 py-4 w-full">
                        <option value="">Selecione um Produto</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} - R$ {{ $product->value_for_show }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity" class="block mb-2 font-semibold">Quantidade</label>
                    <input
                        type="number"
                        min="1"
                        wire:model="selectedQuantity"
                        id="quantity"
                        class="w-full px-4 py-3 rounded-lg bg-black border border-white/20 text-white"
                        placeholder="Quantidade" />
                </div>

                <button
                    type="button"
                    wire:click="addItem"
                    class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-lg text-white font-semibold w-full">
                    Adicionar ao Carrinho
                </button>
            </div>
        </div>

        <div class="fixed right-0 top-0 h-full w-80 bg-gray-900 text-white p-4 shadow-lg overflow-y-auto z-50">
            <h2 class="text-xl font-bold mb-4">Carrinho</h2>

            @forelse ($items as $index => $item)
            @php
            $product = $products->firstWhere('id', $item['product_id']);
            @endphp

            @if ($product)
            <div class="flex items-center mb-4 border-b border-gray-700 pb-2">
                <img src="{{ ($product->photo_path) ? asset('storage/photos/' . $product->photo_path) : 'https://via.placeholder.com/50' }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded mr-3">

                <div class="flex-1">
                    <div class="font-semibold">{{ $product->name }}</div>
                    <div class="text-sm text-gray-400">R$ {{ $product->getValueForShowAttribute() }}</div>

                    <div class="flex items-center mt-2">
                        <button type="button" wire:click="decreaseQuantity({{ $index }})" class="px-2 py-1 bg-red-600 rounded hover:bg-red-700">-</button>
                        <span class="mx-3">{{ $item['amount'] }}</span>
                        <button type="button" wire:click="increaseQuantity({{ $index }})" class="px-2 py-1 bg-green-600 rounded hover:bg-green-700">+</button>
                    </div>

                    <div class="text-sm mt-1">
                        Subtotal: R$ {{ $item['total_value_to_show'] }}
                    </div>
                </div>

                <button type="button" wire:click="removeItem({{ $index }})" class="text-red-400 hover:text-red-600 ml-3">✕</button>
            </div>
            @endif
            @empty
            <p class="text-gray-400">Seu carrinho está vazio.</p>
            @endforelse

            <div class="mt-6 font-semibold">
                Total: R$ {{ $totalToShow }}
            </div>
        </div>

    </form>
</div>