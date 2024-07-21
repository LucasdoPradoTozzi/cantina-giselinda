<x-layout>
    <div class="p-4">
        <x-link-button href="/products/new">Criar Novo Produto</x-link-button>
    </div>
    <div>
        @foreach($products as $product)
        <x-product-wide-card :$product />
        @endforeach
    </div>

    <div>
        {{$products->links()}}
    </div>
</x-layout>