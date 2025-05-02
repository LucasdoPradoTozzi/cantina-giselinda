<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cantina da Giselinda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    @livewireStyles

</head>
<header class="bg-white">
    @auth
    <div class="flex items-center justify-between space-x-4 py-4 px-6 lg:py-2 lg:px-8">
        <div class="flex items-center">
            @livewire('user-options')
        </div>
        <nav class="flex-1 flex items-center justify-center" aria-label="Global">
            <div class="hidden lg:flex lg:gap-x-12">
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="/product-types" :active="request()->is('product-types')">Tipos de Produto</x-nav-link>
                <x-nav-link href="/products" :active="request()->is('products')">Produtos</x-nav-link>
                <x-nav-link href="/stock" :active="request()->is('stock')">Estoque</x-nav-link>
                <x-nav-link href="/buys" :active="request()->is('buys')">Compras</x-nav-link>
                <x-nav-link href="/sells" :active="request()->is('sells')">Vendas</x-nav-link>
                <x-nav-link href="/wastes" :active="request()->is('wastes')">Desperdício</x-nav-link>
            </div>
        </nav>
    </div>
    @endauth

    @guest
    <nav class="mx-auto flex max-w-7xl items-center justify-center py-4 px-6 lg:py-2 lg:px-8" aria-label="Global">
        <div class="hidden lg:flex lg:gap-x-12">
            <x-nav-link href="/login" :active="request()->is('login')">Login</x-nav-link>
            <x-nav-link href="/register" :active="request()->is('register')">Registrar-se</x-nav-link>
        </div>
    </nav>
    @endguest
</header>


<body class="bg-black text-white font-hanken-grotesk pb-20">

    {{ $slot }}

    @livewireScripts
</body>

</html>

<script>
    $(document).ready(function() {
        $('.moneyInput').mask('##0.00', {
            reverse: true
        });
    });
</script>