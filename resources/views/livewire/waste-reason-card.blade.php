<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 hover:shadow-lg transition-shadow">
    <a href="{{ route('waste-reasons.edit', $wasteReason) }}" wire:navigate class="block">
        <div class="flex flex-col space-y-2">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $wasteReason->name }}</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $wasteReason->description }}</p>
            <div class="flex justify-between items-center mt-4">
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    Criado: {{ $wasteReason->created_at->format('d/m/Y') }}
                </span>
                <span class="text-xs text-blue-500 hover:text-blue-700">
                    Editar
                </span>
            </div>
        </div>
    </a>
</div>