<x-layout>
    <div class="pt-4">
        <x-page-heading>Criar Nova Compra</x-page-heading>

        <x-forms.form method="POST" action="/buys">
            <x-forms.input required label="Título da Compra" name="title" />
            <div id="items-container">
                <x-forms.purchase-item-form :products="$products" :index="0" />
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
            <x-forms.select label="Produto" name="products[${itemIndex}][product_id]">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </x-forms.select>
            <x-forms.input required type="number" label="Quantidade" name="products[${itemIndex}][amount]" />
            <x-forms.input required type="number" step="0.01" label="Preço de cada produto" name="products[${itemIndex}][price_by_item]" />
        `;
        itemContainer.appendChild(newItem);
        itemIndex++;
    }
</script>