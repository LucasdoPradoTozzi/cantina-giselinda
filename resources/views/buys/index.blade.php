<x-layout>
    <div class="p-4">
        <x-link-button href="/buys/new">Criar Nova Compra</x-link-button>
    </div>
    @foreach($buys as $buy)
    <x-buys.buy-card :$buy />
    @endforeach
    @if($buys->isEmpty())
    <h1 class="text-center text-white-600 text-2xl mt-8">Sem compras cadastradas até o momento</h1>
    @endif
    {{$buys->links()}}
</x-layout>