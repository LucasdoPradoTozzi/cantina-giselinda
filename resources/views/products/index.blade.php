<x-layout>
    <div>
        <div class="p-4">
            <x-link-button href="/products/new">Criar Novo Produto</x-link-button>
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
</x-layout>