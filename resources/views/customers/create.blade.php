<x-layout>
    <div class="pt-4">
        <x-page-heading>Criar Novo Cliente</x-page-heading>

        <x-forms.form method="POST" action="/customers">
            <x-forms.input required label="Nome" name="name" />
            <x-forms.input label="CPF" name="doc1" />
            <x-forms.input label="RG" name="doc2" />
            <x-forms.input type="date" label="Data de Nascimento" name="birthday" />
            <x-forms.input type="email" label="Email" name="email" />

            <x-forms.button>Criar</x-forms.button>

        </x-forms.form>
    </div>
</x-layout>