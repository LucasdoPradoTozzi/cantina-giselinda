@section('title', 'Criar Nova Venda')
<div>

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
    </form>

    @if ($showPaymentModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-gray-800 rounded-xl p-6 w-full max-w-xl text-white space-y-4 shadow-lg relative">

            <h2 class="text-xl font-bold mb-4">Pagamento</h2>

            <!-- Forma de Pagamento -->
            <label for="paymentMethod" class="block mb-2 font-semibold">Forma de Pagamento</label>
            <select id="paymentMethod" wire:model="paymentMethod" class="rounded-xl bg-black border border-white/10 px-5 py-4 w-full">
                @foreach (\App\Enums\PaymentMethod::cases() as $method)
                <option value="{{ $method->value }}">{{ $method->label() }}</option>
                @endforeach
            </select>

            <!-- Fiado -->
            <div class="flex items-center mt-2">
                <input
                    id="isDeferredPayment"
                    type="checkbox"
                    wire:model.live="isDeferredPayment"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                <label for="isDeferredPayment" class="ml-2 block text-sm">
                    Fiado?
                </label>
            </div>

            <!-- Valor Pago (se fiado) -->
            @if ($isDeferredPayment)
            <div class="mb-4">
                <x-forms.input-money
                    wire:model.live="payingNow"
                    name="payingNow"
                    label="Está pagando algo agora?"
                    placeholder="Preencha apenas se for pagar algo agora." />
            </div>
            @endif

            <!-- Cliente -->
            <label for="customer_id" class="block mb-2 font-semibold">Cliente</label>
            <select
                wire:model.live="selectedCustomerId"
                id="customer_id"
                class="rounded-xl bg-black border border-white/10 px-5 py-4 w-full">
                <option value="">Selecione um Cliente</option>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>

            @if ($errors->has('selectedCustomerId'))
            <div class="bg-red-600 text-white p-2 mb-4 rounded">
                {{ $errors->first('selectedCustomerId') }}
            </div>
            @endif

            <!-- Cliente Selecionado Preview -->
            @if($selectedCustomerId && $selectedCustomer)
            <div class="bg-gray-900 p-4 rounded-lg mt-4 border border-white/10">
                <div class="flex items-center gap-4">
                    <img src="{{ $selectedCustomer->photo_path ? asset('storage/photos/' . $selectedCustomer->photo_path) : asset('images/noPhoto.jpg') }}"
                        alt="Foto do Cliente"
                        class="w-14 h-14 rounded-full border border-white/20 object-cover">
                    <div>
                        <div class="font-semibold">{{ $selectedCustomer->name }}</div>
                        <div class="text-sm">
                            <span class="font-semibold">Aniversário:</span>
                            {{ $selectedCustomerBirthday }} ({{ $selectedCustomerAge }} anos)
                        </div>
                    </div>
                </div>

                @if ($selectedCustomerIsBirthday)
                <div class="text-yellow-400 font-semibold mt-2">
                    🎉 É aniversário do cliente hoje! Que tal um desconto?
                </div>
                @elseif ($selectedCustomerDaysUntilBirthday !== null && $selectedCustomerDaysUntilBirthday <= 30)
                    <div class="text-green-400 mt-2">
                    🎂 Faltam {{ $selectedCustomerDaysUntilBirthday }} dias para o aniversário.
            </div>
            @endif
        </div>
        @endif

        <!-- Botões -->
        <div class="flex justify-between items-center pt-4 border-t border-white/10">
            <button
                type="button"
                wire:click="$set('showPaymentModal', false)"
                class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded text-white">
                Cancelar
            </button>
            <button
                type="button"
                wire:click="submitSell"
                class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-white font-semibold">
                Confirmar venda
            </button>
        </div>
    </div>
    @endif



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
                        <div class="text-sm text-gray-400">R$ {{ $product->getValueForShowAttribute() }}</div>
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

                    @if($product->stock->quantity < $item['amount'])
                        <div class="bg-red-600 text-white p-2 mt-2 rounded text-xs">
                        Estoque insuficiente para a quantidade desejada.
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

    <div class="mt-4 pt-4 border-t border-gray-700 font-semibold">
        Total: R$ {{ $totalToShow }}

        <button
            type="button"
            wire:click="$set('showPaymentModal', true)"
            class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-lg text-white font-semibold w-full">
            Ir para pagamento
        </button>

        @if ($errors->has('purchase'))
        <div class="bg-red-600 text-white p-2 mb-4 rounded">
            {{ $errors->first('purchase') }}
        </div>
        @endif
    </div>
</div>

</div>