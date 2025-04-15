<x-layout>
    <div class="pt-4">
        <x-page-heading>Criar Nova Venda</x-page-heading>

        <x-forms.form method="POST" action="/sells">
            <x-forms.input required label="Título da Venda" name="title" />
            <x-forms.select label="Cliente" id="customer" name="customer">
                @foreach($customers as $customer)
                <option value="{{$customer->id}}">
                    {{$customer->name}}
                </option>
                @endforeach
            </x-forms.select>
            <div id="items-container">
                <x-forms.sold-item-form :products="$products" :index="0" />
            </div>


            <button type="button" class="bg-green-800 hover:bg-green-600 rounded py-2 px-6 font-bold" onClick="addItem()" id="add-item-button">Adicionar Novo Item</button>

            <x-forms.button>Criar</x-forms.button>

        </x-forms.form>
    </div>
</x-layout>
<script>
    let itemIndex = 1;

    function addItem() {
        const itemContainer = document.getElementById('items-container');
        const newItem = document.createElement('div');
        newItem.classList.add('form-group', 'item-form', 'p-4', 'm-4', 'rounded-lg', 'bg-gray-800');
        newItem.innerHTML = `
            <x-forms.select label="Produto" class="product" id="product-${itemIndex}" name="products[${itemIndex}][product_id]">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </x-forms.select>
            <div id="stock-info-${itemIndex}" class="stock-info p-1"></div>
            <x-forms.input required type="number" label="Quantidade" name="products[${itemIndex}][amount]" />
        `;
        itemContainer.appendChild(newItem);

        $('#product-' + itemIndex).on('change', function() {
            let productId = $(this).val();
            let itemIndex = $(this).attr('id').replace('product-', '');
            let stockInfo = $('#stock-info-' + itemIndex);

            getStock(productId, itemIndex, stockInfo);
        });

        $('#product-' + itemIndex).trigger('change');
        itemIndex++;

    }

    function getStock(productId, itemIndex, stockInfo) {
        $.ajax({
            url: '/stock/' + productId,
            type: 'GET',
            success: function(response) {
                if (response != "Sem estoque desse produto") {
                    stockInfo.removeClass('text-red-500').addClass('text-green-500');
                    stockInfo.html("Quantidade em estoque " + response);
                } else {
                    stockInfo.removeClass('text-green-500').addClass('text-red-500');
                    stockInfo.html(response);
                }
            },
            error: function() {
                stockInfo.removeClass('text-green-500').addClass('text-red-500');
                stockInfo.html('Erro ao buscar estoque.');
            }
        });
    }

    $('.product').on('change', function() {
        let productId = $(this).val();
        let itemIndex = $(this).attr('id').replace('product-', '');
        let stockInfo = $('#stock-info-' + itemIndex);

        getStock(productId, itemIndex, stockInfo);
    });

    $(document).ready(function() {
        $('.product').trigger('change');
    });
</script>