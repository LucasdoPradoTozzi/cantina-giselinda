@section('title', 'Criar Novo Cliente')
<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">
        <form wire:submit.prevent="create" class="space-y-5">

            <div class="mb-4 flex flex-col items-center justify-center">
                @if ($photo)
                <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg mb-2">
                @else
                <img src="{{ asset('images/personWithoutPhoto.png') }}" alt="Foto padrão" class="w-24 h-24 object-cover rounded-lg mb-2">
                @endif

                <div>
                    <input type="file" id="photo" wire:model="photo" class="hidden">

                    <label for="photo"
                        class="inline-block cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                        Selecionar foto
                    </label>

                    @error('photo')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-800">Nome</label>
                <input
                    type="text"
                    id="name"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite seu nome"
                    wire:model="name"
                    maxlength="255" />
                @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-800">Data de Nascimento</label>
                <input
                    type="date"
                    id="birthday"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite o aniversário do cliente"
                    wire:model="birthday" />
                @error('birthday')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-800">RG</label>
                <input
                    type="text"
                    id="doc1"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite o documento do cliente"
                    wire:model="doc1"
                    maxlength="255" />
                @error('doc1')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-800">CPF</label>
                <input
                    type="text"
                    id="doc2"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite o documento do cliente"
                    wire:model="doc2"
                    maxlength="255" />
                @error('doc2')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>


            <div>
                <label class="block mb-1 text-sm text-gray-800">E-mail</label>
                <input
                    type="email"
                    id="email"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite o e-mail do cliente"
                    wire:model="email" />
                @error('email')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-800">Telefone/Celular</label>
                <input
                    type="text"
                    id="phone"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite o telefone do cliente"
                    wire:model="phone" />
                @error('phone')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Criar Cliente
            </button>
        </form>
    </div>
</div>