<x-layout>

    //add new products
    //list of the products
    //clicking an item redirect to the item update

    @foreach($products as $product)
    <x-product-card :$product />
    <x-product-wide-card :$product />
    @endforeach




</x-layout>