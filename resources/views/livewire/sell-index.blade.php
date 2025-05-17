@section('title', 'Listagem de Vendas')
<div class="p-2">
    <div class="flex justify-between items-center flex-wrap gap-4 p-2">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Buscar venda por título..."
            class="border rounded-lg px-4 py-2 w-full max-w-md text-black" />
        <x-link-button href="/sells/new" wire:navigate>Criar Nova Venda</x-link-button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-4">
        @forelse($sells as $sell)
        <x-sells.sell-card :$sell />
        @empty
        <p class="col-span-full text-gray-500">Sem vendas cadastradas até o momento</p>
        @endforelse
    </div>
    <div class="mt-6">
        {{$sells->links()}}
    </div>
</div>