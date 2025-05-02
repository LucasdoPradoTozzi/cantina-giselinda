<div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Entrar na Conta</h2>

        @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 text-sm p-2 rounded mb-4">
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit.prevent="login" class="space-y-5">
            @error('authentication')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror

            <div>
                <label class="block mb-1 text-sm text-gray-800">Email</label>
                <input
                    type="email"
                    wire:model.lazy="email"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm text-gray-800">Senha</label>
                <input
                    type="password"
                    wire:model.lazy="password"
                    class="w-full text-black border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                @error('password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center">
                <input
                    id="remember"
                    type="checkbox"
                    wire:model="remember"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                <label for="remember" class="ml-2 block text-sm text-gray-800">
                    Mantenha-me conectado
                </label>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Entrar
            </button>
        </form>

        <a href="/register" class="text-black blue">Não é usuário? clique aqui para se registrar.</a>
    </div>
</div>