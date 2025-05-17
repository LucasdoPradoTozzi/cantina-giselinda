@props(['active' => false])

<div class="relative group">
    <button class="{{ $active ? 'bg-gray-900 text-white' : 'text-black hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium flex items-center gap-1">
        {{ $trigger }}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <!-- This empty div creates a "bridge" between the button and dropdown content -->
    <div class="absolute inset-x-0 h-2 -bottom-2"></div>
    <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block z-10">
        <div class="py-1">
            {{ $content }}
        </div>
    </div>
</div>
