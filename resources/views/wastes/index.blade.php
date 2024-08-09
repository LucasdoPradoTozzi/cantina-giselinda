<x-layout>
    <div class="p-4">
        <x-link-button href="/wastes/new">Criar Nova Desperdício</x-link-button>
    </div>
    @foreach($wastes as $waste)
    <x-wastes.waste-card :$waste />
    @endforeach
    @if($wastes->isEmpty())
    <h1 class="text-center text-white-600 text-2xl mt-8">Sem desperdícios cadastradas até o momento</h1>
    @endif
    {{$wastes->links()}}

</x-layout>