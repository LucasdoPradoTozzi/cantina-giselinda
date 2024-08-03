<div class="form-group item-form p-4 m-4 rounded-lg bg-gray-800" id="item-form-{{ $index }}">
    <x-forms.select label="Produto" id="product-{{ $index }}" class="product" name="products[{{ $index }}][product_id]">
        @foreach($products as $product)
        <option value="{{$product->id}}">
            {{$product->name}}
        </option>
        @endforeach
    </x-forms.select>
    <div id="stock-info-{{ $index }}" class="stock-info p-1"></div>
    <x-forms.input required type="number" min="0" label="Quantidade" name="products[{{ $index }}][amount]" />
    <x-forms.input type="number" step="0.01" label="Preço cobrado" name="products[{{ $index }}][sold_price]" placeholder="Preencher apenas caso cobre um preço diferente" />
</div>