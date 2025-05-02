<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Criar Conta</h2>

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
            <!-- Nome do Usuário -->
            <div>
                <label class="block mb-1 text-sm text-gray-800">Nome</label>
                <input
                    type="text"
                    id="name"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite seu nome"
                    wire:model="name" />
                @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-1 text-sm text-gray-800">E-mail</label>
                <input
                    type="email"
                    id="email"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite seu e-mail"
                    wire:model="email" />
                @error('email')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Senha -->
            <div>
                <label class="block mb-1 text-sm text-gray-800">Senha</label>
                <input
                    type="password"
                    id="password"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Digite sua senha"
                    wire:model="password" />
                @error('password')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirmar Senha -->
            <div>
                <label class="block mb-1 text-sm text-gray-800">Confirmar Senha</label>
                <input
                    type="password"
                    id="password_confirmation"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Confirme sua senha"
                    wire:model="password_confirmation" />
                @error('password_confirmation')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botão de Cadastro -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Criar Conta
            </button>
        </form>
    </div>
</div>