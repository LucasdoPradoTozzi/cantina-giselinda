<x-layout>
    <div class="p-4">
        <x-link-button href="/sells/new">Criar Nova Venda</x-link-button>
    </div>
    @foreach($sells as $sell)
    <x-sells.sell-card :$sell />
    @endforeach
    @if($sells->isEmpty())
    <h1 class="text-center text-white-600 text-2xl mt-8">Sem vendas cadastradas até o momento</h1>
    @endif
    {{$sells->links()}}
</x-layout>