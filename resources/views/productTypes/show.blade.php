<x-layout>
    <div class="pt-4">
        <x-page-heading>Atualizar Tipo de Produto</x-page-heading>

        <x-forms.form id="update-form" method="POST" action="/product-type/{{$productType->id}}">
            <x-forms.input label="Nome do Produto" name="name" value="{{$productType->name}}" />
            <x-forms.divider />
            <div class="flex justify-between">
                <x-forms.button form="update-form">Atualizar</x-forms.button>
            </div>
        </x-forms.form>
    </div>
</x-layout>