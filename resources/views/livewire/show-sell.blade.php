@section('title', 'Relatório de Venda')
<div>
    <div class="flex flex-col items-center p-2 m-8 bg-black w-full max-w-screen-lg mx-auto">
        <h1 class="text-3xl font-bold text-white m-2 p-2">
            {{$sell->title}}
        </h1>
        @if($sell->isFullyPaid())
        <p class="md-2 p-2 text-green-400">Total ganho R$ {{ $sell->sale_value_for_show}}</p>
        @else
        <p class="md-2 p-2 text-green-400">Valor total da venda R$ {{ $sell->sale_value_for_show}}</p>
        <p class="md-2 p-2 text-green-300">Valor recebido até o momento R$ {{ $sell->paid_value_for_show}}</p>
        <p class="md-2 p-2 text-red-400">Valor a receber R$ {{ $sell->debt_value}}</p>
        @endif

        <div x-data="{ tab: 'sold-itens-tab' }" class="w-full">
            <div class="flex space-x-8 mb-6 justify-center">

                <button
                    class="px-6 py-3 text-lg rounded-lg transition duration-200"
                    :class="tab === 'sold-itens-tab' 
            ? 'bg-blue-500 text-white' 
            : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
                    @click="tab = 'sold-itens-tab'">
                    Produtos Vendidos na Compra
                </button>

                <button
                    class="px-6 py-3 text-lg rounded-lg transition duration-200"
                    :class="tab === 'payments-tab' 
            ? 'bg-blue-500 text-white' 
            : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
                    @click="tab = 'payments-tab'">
                    Pagamentos
                </button>

                <button
                    class="px-6 py-3 text-lg rounded-lg transition duration-200"
                    :class="tab === 'customer-tab' 
            ? 'bg-blue-500 text-white' 
            : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
                    @click="tab = 'customer-tab'">
                    Cliente
                </button>

                @if(!$sell->isFullyPaid())

                <button
                    class="px-6 py-3 text-lg rounded-lg transition duration-200"
                    :class="tab === 'new-payment-tab' 
            ? 'bg-blue-500 text-white' 
            : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
                    @click="tab = 'new-payment-tab'">
                    Adicionar Pagamento
                </button>

                @endif
            </div>


            <div class="mt-6 w-full">
                <div x-show="tab === 'sold-itens-tab'" x-cloak>
                    @foreach($sell->soldItem as $item)
                    <div class="overflow-x-auto mt-6">
                        <table class="w-full text-sm text-left text-gray-200 bg-gray-900 rounded-lg overflow-hidden">
                            <thead class="text-xs uppercase bg-gray-800 text-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Produto</th>
                                    <th scope="col" class="px-6 py-4">Quantidade</th>
                                    <th scope="col" class="px-6 py-4">Preço por item</th>
                                    <th scope="col" class="px-6 py-4">Total do item</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sell->soldItem as $item)
                                <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                                    <td class="px-6 py-4 font-medium text-white">{{ $item->product->name }}</td>
                                    <td class="px-6 py-4">{{ $item->amount }}</td>
                                    <td class="px-6 py-4 font-mono text-green-400">{{ $item->price_by_item_for_show }}</td>
                                    <td class="px-6 py-4 font-mono text-green-400">{{ $item->sold_price_for_show }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                </div>

                <div x-show="tab === 'payments-tab'" x-cloak>

                    <div class="overflow-x-auto mt-6">
                        <table class="w-full text-sm text-left text-gray-200 bg-gray-900 rounded-lg overflow-hidden">
                            <thead class="text-xs uppercase bg-gray-800 text-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-4 w-1/2">Tipo de Pagamento</th>
                                    <th scope="col" class="px-6 py-4 w-1/2">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sell->salesPayment as $payment)
                                <tr class="border-b border-gray-700 hover:bg-gray-800 transition">

                                    <td class="px-6 py-4 font-medium text-white">{{ $payment->payment_method->label() }}</td>
                                    <td class="px-6 py-4 font-mono text-green-400">{{ $payment->value_for_show }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <div x-show="tab === 'customer-tab'" x-cloak>
                    @if($sell->customer)
                    <h1>{{ $sell->customer->name }}</h1>
                    <span>em breve, atualizações</span>
                    @else
                    <h1>Venda realizada sem cliente.</h1>
                    @endif
                </div>

                @if(!$sell->isFullyPaid())
                <div x-show="tab === 'new-payment-tab'" x-cloak>
                    <label for="paymentMethod" class="block mb-2 font-semibold">Forma de Pagamento</label>
                    <select id="paymentMethod" wire:model="paymentMethod" class="rounded-xl bg-black/100 border border-white/10 px-5 py-4 w-full">
                        @foreach (\App\Enums\PaymentMethod::cases() as $method)
                        <option value="{{ $method->value }}">{{ $method->label() }}</option>
                        @endforeach
                    </select>
                    <x-forms.input-money wire:model.live.debounce.300ms="newPaymentValue" label="Valor do Novo Pagamento" name="newPaymentValue" />
                    <button
                        type="button"
                        wire:loading.attr="disabled"
                        wire:click="addNewPayment"
                        class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-lg text-white font-semibold w-full disabled:opacity-50">
                        Adicionar Pagamento
                    </button>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>