@section('title', 'Motivos de Descarte')
<div class="p-2.5">
    <div class="flex justify-between items-center flex-wrap gap-4 p-2.5">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Buscar motivo de descarte..."
            class="border rounded-lg px-4 py-2 w-full max-w-md text-black" />

        <a
            href="/waste-reasons/new"
            wire:navigate
            class="h-full py-2 px-4 min-h-[42px] bg-gray-800 hover:bg-gray-600 rounded font-bold">
            Criar Novo Motivo
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        @forelse($wasteReasons as $wasteReason)
        <livewire:waste-reason-card :wasteReason="$wasteReason" wire:key="waste-reason-{{ $wasteReason->id }}" />
        @empty
        <p class="col-span-full text-gray-500">Nenhum motivo de descarte encontrado.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{$wasteReasons->appends(['search' => request('search')])->links()}}
    </div>
</div>