<div class="p-2.5">
    <div class="flex justify-between items-center flex-wrap gap-4 p-2.5">

        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Buscar produto por nome..."
            class="border rounded-lg px-4 py-2 w-full max-w-md text-black" />

        <a
            href="/products/new"
            class="h-full py-2 px-4 min-h-[42px] bg-gray-800 hover:bg-gray-600 rounded font-bold">
            Criar Novo Produto
        </a>


    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
        <x-product-wide-card :$product />
        @empty
        <p class="col-span-full text-gray-500">Nenhum produto encontrado.</p>
        @endforelse
    </div>

    {{-- Paginação --}}
    <div class="mt-6">
        {{ $products->appends(['search' => request('search')])->links() }}
    </div>

</div>