<x-layout>
    <div class="pt-4">
        <x-page-heading>Atualizar Produto</x-page-heading>

        <x-forms.form id="update-form" method="POST" action="/products/{{$product->id}}" enctype="multipart/form-data">
            <x-forms.input label="Nome do Produto" name="name" value="{{$product->name}}" />
            <x-forms.input-text label="Descrição do Produto" name="description" textContent="{{$product->description}}" />
            <x-forms.input label="Valor do Produto" name="value" value="{{$product->value}}" />
            <x-forms.input label="Valor de Compra do Produto" name="buy_value" value="{{$product->buy_value}}" />
            <x-forms.input type="file" label="Foto do Produto" name="photo" />

            <x-forms.select label="Tipo do Produto" name="product_type_id">
                @foreach($productTypes as $productType)
                <option value="{{$productType->id}}" {{ $productType->id == $product->productType->id  ? 'selected' : ''}}>
                    {{$productType->name}}
                </option>
                @endforeach
            </x-forms.select>

            <x-forms.input label="Estoque Minimo" name="minimum_amount" value="{{$product->minimum_amount}}" />
            <x-forms.input label="Estoque Máximo" name="maximum_amount" value="{{$product->maximum_amount}}" />

            <x-forms.divider />

            <div class="flex justify-between">
                <x-forms.delete-button form="form-delete">Deletar</x-forms.delete-button>
                <x-forms.button form="update-form">Atualizar</x-forms.button>
            </div>
        </x-forms.form>
        <x-forms.form id="form-delete" class="hidden" method="POST" action="/products/{{$product->id}}/delete"> </x-forms.form>
    </div>
</x-layout>