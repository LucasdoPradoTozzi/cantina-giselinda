<x-layout>
    <div class="pt-4">
        <x-page-heading>Criar Novo Produto</x-page-heading>

        <x-forms.form method="POST" action="/products" enctype="multipart/form-data">
            <x-forms.input required label="Nome do Produto" name="name" />
            <x-forms.input-text required label="Descrição do Produto" name="description" />
            <x-forms.input-money required label="Valor do Produto" name="value" />
            <x-forms.input-money required label="Valor de Compra do Produto" name="buy_value" />
            <x-forms.input type="file" label="Foto do Produto" name="photo" />

            <x-forms.select required label="Tipo do Produto" name="product_type_id">
                @foreach($productTypes as $productType)
                <option value="{{$productType->id}}">
                    {{$productType->name}}
                </option>
                @endforeach
            </x-forms.select>

            <x-forms.input required label="Estoque Minimo" name="minimum_amount" />
            <x-forms.input required label="Estoque Máximo" name="maximum_amount" />

            <x-forms.divider />

            <x-forms.button>Criar</x-forms.button>

        </x-forms.form>
    </div>
</x-layout>