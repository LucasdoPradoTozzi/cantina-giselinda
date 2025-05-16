@section('title', 'Listagem de Compras')
<div class="p-2.5">
    <div class="flex justify-between items-center flex-wrap gap-4 p-2.5">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Buscar compra por título..."
            class="border rounded-lg px-4 py-2 w-full max-w-md text-black" />
        <x-link-button href="/buys/new" wire:navigate>Criar Nova Compra</x-link-button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        @forelse($buys as $buy)
        <x-buys.buy-card :$buy />
        @empty
        <p class="col-span-full text-gray-500">Sem compras cadastradas até o momento</p>
        @endforelse
    </div>
    <div class="mt-6">
        {{$buys->links()}}
    </div>
</div>