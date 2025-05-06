@section('title', 'Criar Nova Compra')
<div>
    <form wire:submit.prevent="submit">
        <div class="flex justify-center">
            <div class="bg-gray-800 rounded-lg p-6 text-white space-y-4 w-full max-w-xl">

                <!-- Produto -->
                <div class="form-group">
                    <label for="product_id" class="block mb-2 font-semibold">Produto</label>
                    <select
                        wire:model="selectedProductId"
                        id="product_id"
                        class="rounded-xl bg-black/100 border border-white/10 px-5 py-4 w-full">
                        <option value="">Selecione um Produto</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} - R$ {{ $product->buy_value_for_show }}
                        </option>
                        @endforeach
                    </select>
                    @error('selectedProductId')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Quantidade -->
                <div class="form-group">
                    <label for="quantity" class="block mb-2 font-semibold">Quantidade</label>
                    <input
                        type="number"
                        min="1"
                        wire:model="selectedQuantity"
                        id="quantity"
                        class="w-full px-4 py-3 rounded-lg bg-black border border-white/20 text-white"
                        placeholder="Quantidade" />
                    @error('selectedQuantity')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Preço Alternativo -->
                <x-forms.input-money
                    wire:model="buyValueToday"
                    name="alternativeBuyValue"
                    label="Preço de cada produto"
                    placeholder="Preencha apenas caso o valor seja diferente" />
                @error('buyValueToday')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror

                <!-- Botão -->
                <button
                    type="button"
                    wire:click="addItem"
                    class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-lg text-white font-semibold w-full">
                    Adicionar ao Carrinho
                </button>

            </div>
        </div>

        <div class="fixed right-0 top-0 h-full w-80 bg-gray-900 text-white p-4 shadow-lg z-50 flex flex-col">
            <h2 class="text-xl font-bold mb-4">Carrinho</h2>

            <div class="flex-1 overflow-y-auto pr-2">
                @forelse ($items as $index => $item)
                @php
                $product = $products->firstWhere('id', $item['product_id']);
                @endphp

                @if ($product)
                <div class="flex flex-col mb-4 border border-gray-700 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center">
                        <img src="{{ $product->photo_path ? asset('storage/photos/' . $product->photo_path) : asset('images/noPhoto.jpg') }}"
                            alt="{{ $product->name }}"
                            class="w-16 h-16 object-cover rounded mr-4" />

                        <div class="flex flex-col">
                            <div class="font-semibold text-base">{{ $product->name }}</div>
                            <div class="text-sm text-gray-400">Preço padrão: R$ {{ $product->buy_value_for_show }}</div>
                            <div class="text-sm text-gray-400">Preço pago: R$ {{ $item['buy_value_for_show'] }}</div>
                        </div>

                        <button type="button" wire:click="removeItem({{ $index }})"
                            class="ml-auto text-red-400 hover:text-red-600 text-xl">
                            ✕
                        </button>
                    </div>

                    <div class="flex items-center mt-4">
                        <button type="button" wire:click="decreaseQuantity({{ $index }})"
                            class="px-2 py-1 bg-red-600 rounded hover:bg-red-700">-</button>
                        <span class="mx-3">{{ $item['amount'] }}</span>
                        <button type="button" wire:click="increaseQuantity({{ $index }})"
                            class="px-2 py-1 bg-green-600 rounded hover:bg-green-700">+</button>
                    </div>

                    <div class="flex flex-col mt-2">
                        <span class="{{ $product->stock->quantity >= $item['amount'] ? 'text-green-400' : 'text-red-400' }}">
                            Em Estoque: {{ $product->stock->quantity }}
                        </span>

                        @if($product->stock->quantity + $item['amount'] > $product->maximum_amount)
                        <div class="bg-red-600 text-white p-2 mt-2 rounded text-xs">
                            A quantidade vai exceder a quantidade máxima em estoque desejada.
                        </div>
                        @endif
                    </div>

                    <div class="text-sm mt-2">
                        Subtotal: R$ {{ $item['total_value_to_show'] }}
                    </div>

                    {{-- Exibe erros de validação, se existirem --}}
                    @error("items.$index.product_id")
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror

                    @error("items.$index.amount")
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
                @endif
                @empty
                <p class="text-gray-400">Seu carrinho está vazio.</p>
                @endforelse
            </div>

            <!-- Área fixa -->
            <div class="mt-4 pt-4 border-t border-gray-700 font-semibold">
                Total: R$ {{ $totalToShow }}

                <button
                    type="button"
                    wire:loading.attr="disabled"
                    wire:click="submitBuy"
                    class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-lg text-white font-semibold w-full disabled:opacity-50">
                    Finalizar compra
                </button>

                @if ($errors->has('buy'))
                <div class="bg-red-600 text-white p-2 mb-4 rounded">
                    {{ $errors->first('buy') }}
                </div>
                @endif
            </div>
        </div>
    </form>
</div>