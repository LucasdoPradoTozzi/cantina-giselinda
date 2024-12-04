<x-layout>
    <div class="p-4">
        <x-link-button href="/customers/new">Criar Novo Cliente</x-link-button>
    </div>
    <div>
        @foreach($customers as $customer)
        <x-customers.wide-card :$customer />
        @endforeach
    </div>

    <div>
        {{$customers->links()}}
    </div>
</x-layout>