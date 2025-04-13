<x-layout>
    <div class="pt-4">
        <x-page-heading>Criar Novo Produto</x-page-heading>

        <x-forms.form method="POST" action="/product-type" enctype="multipart/form-data">
            <x-forms.input label="Nome do Tipo de Produto" name="name" />
            <x-forms.divider />
            <x-forms.button>Criar</x-forms.button>
        </x-forms.form>
    </div>
</x-layout>