<div x-data="{ open: @entangle('showOptions') }" class="flex flex-col items-center space-y-1 mt-4 mx-2">

    <img src="{{ Auth::user()->photo_path ? asset('storage/photos/' . Auth::user()->photo_path) : asset('images/noPhoto.jpg') }}"
        alt="{{ Auth::user()->name }}" class="w-16 h-16 rounded-full object-cover shadow">


    <button @click="open = !open" class="flex items-center space-x-1 text-sm text-black font-medium hover:underline focus:outline-none">
        <span>{{ Auth::user()->firstName }}</span>
        <svg :class="open ? 'transform rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open" x-transition class="w-full mt-2 bg-white shadow rounded-md text-sm overflow-hidden">
        <ul class="flex flex-col text-center divide-y divide-gray-200">

            <li>
                <button wire:click="logout" class="w-full py-2 text-red-600 hover:bg-red-100">Sair</button>
            </li>
        </ul>
    </div>
</div>