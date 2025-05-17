<div class="relative flex flex-col items-center" x-data="{ open: false }">
    <!-- User photo with improved appearance -->
    <div class="relative">
        <img 
            @click="open = !open"
            src="{{ Auth::user()->photo_path ? asset('storage/photos/' . Auth::user()->photo_path) : asset('images/noPhoto.jpg') }}"
            alt="{{ Auth::user()->name }}" 
            class="w-16 h-16 rounded-full object-cover shadow-md border-2 border-gray-200 hover:border-gray-400 transition-all duration-200 cursor-pointer">
        
        <!-- Status indicator dot - can be dynamic based on user status if needed -->
        <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
    </div>

    <!-- User name with hover effect -->
    <div 
        @click="open = !open"
        class="mt-2 flex items-center space-x-1 text-black font-medium cursor-pointer">
        <span class="text-sm">{{ Auth::user()->name }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
    
    <!-- Dropdown container with click behavior -->
    <div 
        x-show="open"
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute top-full left-0 right-0 pt-2 z-50">
        <div class="w-48 mx-auto rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
            <div class="py-1">
                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Meu Perfil</a>
                <button wire:click="logout" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">Sair</button>
            </div>
        </div>
    </div>
</div>