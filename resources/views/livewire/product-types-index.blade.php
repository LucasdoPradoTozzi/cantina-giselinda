@section('title', 'Lista de Tipos de Produto')
<div class="p-2.5">
    <div class="flex justify-between items-center flex-wrap gap-4 p-2.5">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Buscar tipo de produto por nome..."
            class="border rounded-lg px-4 py-2 w-full max-w-md text-black" />

        <a
            href="/product-type/new"
            wire:navigate
            class="h-full py-2 px-4 min-h-[42px] bg-gray-800 hover:bg-gray-600 rounded font-bold">
            Criar Novo Tipo
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        @forelse($productTypes as $productType)
        <x-product-type-wide-card :$productType />
        @empty
        <p class="col-span-full text-gray-500">Nenhum tipo de produto encontrado.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{$productTypes->appends(['search' => request('search')])->links()}}
    </div>
</div>