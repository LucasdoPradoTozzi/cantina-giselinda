<div class="max-w-2xl mx-auto bg-gray-800 rounded-lg shadow-xl p-6">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif
    
    <h2 class="text-2xl font-bold mb-6 text-white">Editar Perfil</h2>
    
    <form wire:submit.prevent="update" class="space-y-6">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Left Column - Personal Information -->
            <div class="flex-1 space-y-6">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Nome</label>
                    <input type="text" wire:model="name" id="name" 
                           class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                    <input type="email" wire:model="email" id="email" 
                           class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <!-- Current Password Field (required for password change) -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-300">Senha Atual (apenas se estiver alterando a senha)</label>
                    <input type="password" wire:model="current_password" id="current_password" 
                           class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('current_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <!-- New Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Nova Senha (deixe em branco para manter a atual)</label>
                    <input type="password" wire:model="password" id="password" 
                           class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirmar Nova Senha</label>
                    <input type="password" wire:model="password_confirmation" id="password_confirmation" 
                           class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
            
            <!-- Right Column - Photo Upload -->
            <div class="flex-1 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300">Foto de Perfil</label>
                    
                    <!-- Current Photo Preview -->
                    <div class="mt-2 flex items-center justify-center">
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="w-40 h-40 object-cover rounded-full border-4 border-gray-600">
                        @else
                            <img src="{{ Auth::user()->photo_path ? asset('storage/photos/' . Auth::user()->photo_path) : asset('images/noPhoto.jpg') }}" 
                                 class="w-40 h-40 object-cover rounded-full border-4 border-gray-600">
                        @endif
                    </div>
                    
                    <!-- Photo Upload -->
                    <div class="mt-4">
                        <label for="photo" class="block text-sm font-medium text-gray-300 mb-2">Alterar Foto</label>
                        <input type="file" wire:model="photo" id="photo" 
                               class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                        <div wire:loading wire:target="photo" class="mt-2 text-indigo-400 text-sm">Carregando...</div>
                        @error('photo') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>
