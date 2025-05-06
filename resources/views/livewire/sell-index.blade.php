@section('title', 'Listagem de Vendas')
<div>
    <div class="p-4">
        <x-link-button href="/sells/new" wire:navigate>Criar Nova Venda</x-link-button>
    </div>
    <div class="p-4">
        @foreach($sells as $sell)
        <x-sells.sell-card :$sell />
        @endforeach
        @if($sells->isEmpty())
        <h1 class="text-center text-white-600 text-2xl mt-8">Sem vendas cadastradas até o momento</h1>
        @endif
    </div>
    {{$sells->links()}}
</div>