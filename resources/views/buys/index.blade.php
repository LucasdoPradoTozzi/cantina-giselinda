<x-layout>
    <div class="p-4">
        <x-link-button href="/buys/new">Criar Nova Compra</x-link-button>
    </div>
    @foreach($buys as $buy)
    <x-buys.buy-card :$buy />
    @endforeach
    {{$buys->links()}}
</x-layout>