<x-layout>
    <div class="p-4">
        <x-link-button href="/product-type/new">Criar Novo Produto</x-link-button>
    </div>
    <div>
        @foreach($productTypes as $productType)
        <x-product-type-wide-card :$productType />
        @endforeach
    </div>

    <div>
        {{$productTypes->links()}}
    </div>
</x-layout>