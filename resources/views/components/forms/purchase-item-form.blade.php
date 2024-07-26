<div class="form-group item-form p-4 m-4 rounded-lg bg-gray-800" id="item-form-{{ $index }}">
    <x-forms.select label="Produto" name="products[{{ $index }}][product_id]">
        @foreach($products as $product)
        <option value="{{$product->id}}">
            {{$product->name}}
        </option>
        @endforeach
    </x-forms.select>

    <x-forms.input required type="number" label="Quantidade" name="products[{{ $index }}][amount]" />
    <x-forms.input required type="number" step="0.01" label="Preço de cada produto" name="products[{{ $index }}][price_by_item]" />
</div>