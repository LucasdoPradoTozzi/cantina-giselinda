@section('title', $customer->name)
<div>
    <div class="flex flex-col items-center p-2 m-8 bg-black w-full max-w-screen-lg mx-auto">
        <div x-data="{ tab: 'sold-itens-tab' }" class="w-full">
            <div class="flex space-x-8 mb-6 justify-center">

                <button
                    class="px-6 py-3 text-lg rounded-lg transition duration-200"
                    :class="tab === 'personal-data-tab' 
            ? 'bg-blue-500 text-white' 
            : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
                    @click="tab = 'personal-data-tab'">
                    Dados Pessoais
                </button>

                <button
                    class="px-6 py-3 text-lg rounded-lg transition duration-200"
                    :class="tab === 'sells-tab' 
            ? 'bg-blue-500 text-white' 
            : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
                    @click="tab = 'sells-tab'">
                    Compras
                </button>

                <button
                    class="px-6 py-3 text-lg rounded-lg transition duration-200"
                    :class="tab === 'bonus-tab' 
            ? 'bg-blue-500 text-white' 
            : 'bg-gray-700 text-gray-300 hover:bg-gray-600'"
                    @click="tab = 'bonus-tab'">
                    Produtos favoritos
                </button>
            </div>


            <div class="mt-6 w-full">
                <div x-show="tab === 'personal-data-tab'" x-cloak>
                    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">
                        <form wire:submit.prevent="update" class="space-y-5">

                            <div class="mb-4 flex flex-col items-center justify-center">
                                @if ($photoUpdate)
                                <img src="{{ $photoUpdate->temporaryUrl() }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg mb-2">
                                @elseif ($customer->photo_path)
                                <img src="{{ asset('storage/photos/' . $customer->photo_path) }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg mb-2">
                                @else
                                <img src="{{ asset('images/personWithoutPhoto.png') }}" alt="Foto padrão" class="w-24 h-24 object-cover rounded-lg mb-2">
                                @endif

                                <div>
                                    <input type="file" id="photoUpdate" wire:model="photoUpdate" class="hidden">

                                    <label for="photoUpdate"
                                        class="inline-block cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                                        Selecionar nova foto
                                    </label>

                                    @error('photoUpdate')
                                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block mb-1 text-sm text-gray-800">Nome</label>
                                <input
                                    type="text"
                                    id="nameUpdate"
                                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="Digite seu nome"
                                    wire:model="nameUpdate"
                                    maxlength="255" />
                                @error('nameUpdate')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-1 text-sm text-gray-800">Data de Nascimento</label>
                                <input
                                    type="date"
                                    id="birthdayUpdate"
                                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="Digite o aniversário do cliente"
                                    wire:model="birthdayUpdate" />
                                @error('birthdayUpdate')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-1 text-sm text-gray-800">RG</label>
                                <input
                                    type="text"
                                    id="doc1Update"
                                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="Digite o documento do cliente"
                                    wire:model="doc1Update"
                                    maxlength="255" />
                                @error('doc1Update')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-1 text-sm text-gray-800">CPF</label>
                                <input
                                    type="text"
                                    id="doc2Update"
                                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="Digite o documento do cliente"
                                    wire:model="doc2Update"
                                    maxlength="255" />
                                @error('doc2Update')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <div>
                                <label class="block mb-1 text-sm text-gray-800">E-mail</label>
                                <input
                                    type="email"
                                    id="emailUpdate"
                                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="Digite o e-mail do cliente"
                                    wire:model="emailUpdate" />
                                @error('emailUpdate')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-1 text-sm text-gray-800">Telefone/Celular</label>
                                <input
                                    type="text"
                                    id="phoneUpdate"
                                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    placeholder="Digite o telefone do cliente"
                                    wire:model="phoneUpdate" />
                                @error('phoneUpdate')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                                Atualizar Cliente
                            </button>
                        </form>
                    </div>
                </div>

                <div x-show="tab === 'sells-tab'" x-cloak>
                    @foreach($sells as $sell)
                    <x-sells.sell-card :$sell />
                    @endforeach

                    <div class="mt-4">
                        {{ $sells->links() }}
                    </div>

                </div>

                <div x-show="tab === 'bonus-tab'" x-cloak>


                    <div class="overflow-x-auto mt-6">
                        <table class="w-full text-sm text-left text-gray-200 bg-gray-900 rounded-lg overflow-hidden">
                            <thead class="text-xs uppercase bg-gray-800 text-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-4">Produto</th>
                                    <th scope="col" class="px-6 py-4">Quantidade Comprada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($favoriteProducts as $favoriteProduct)
                                <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                                    <td class="px-6 py-4 font-medium text-white">{{ $favoriteProduct->product->name }}</td>
                                    <td class="px-6 py-4">{{ $favoriteProduct->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>