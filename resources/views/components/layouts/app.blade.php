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

<body class="bg-black text-white font-hanken-grotesk flex">
    <!-- Sidebar toggle button - positioned appropriately for all screen sizes -->
    <div id="toggle-button" class="fixed top-0 left-0 z-50 p-4 transition-all duration-300 ease-in-out">
        <button id="sidebar-toggle" class="text-white bg-gray-800 rounded-md p-2 focus:outline-none hover:bg-gray-700">
            <!-- Menu Icon (when sidebar is closed) -->
            <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <!-- X Icon (when sidebar is open) -->
            <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-white text-black w-64 min-h-screen fixed shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out z-40">
        <div class="p-4 border-b border-gray-200 flex items-center justify-center">
            <h1 class="text-xl font-bold">Cantina da Giselinda</h1>
        </div>

        @auth
        <div class="p-4 border-b border-gray-200">
            @livewire('user-options')
        </div>

        <nav class="py-4" aria-label="Main Navigation">
            <div class="flex flex-col space-y-2 px-4">
                <x-nav-link href="/" :active="request()->is('/')" class="py-2 px-4 rounded hover:bg-gray-100">Home</x-nav-link>

                <div class="py-2">
                    <x-dropdown :active="request()->is('product-types') || request()->is('products') || request()->is('stock')" class="w-full">
                        <x-slot name="trigger">Produtos</x-slot>
                        <x-slot name="content">
                            <x-dropdown-item href="/product-types" :active="request()->is('product-types')">Tipos de Produto</x-dropdown-item>
                            <x-dropdown-item href="/products" :active="request()->is('products')">Produtos</x-dropdown-item>
                            <x-dropdown-item href="/stock" :active="request()->is('stock')">Estoque</x-dropdown-item>
                        </x-slot>
                    </x-dropdown>
                </div>

                <x-nav-link href="/customers" :active="request()->is('customers')" class="py-2 px-4 rounded hover:bg-gray-100">Clientes</x-nav-link>

                <div class="py-2">
                    <x-dropdown :active="request()->is('buys') || request()->is('sells')" class="w-full">
                        <x-slot name="trigger">Transações</x-slot>
                        <x-slot name="content">
                            <x-dropdown-item href="/buys" :active="request()->is('buys')">Compras</x-dropdown-item>
                            <x-dropdown-item href="/sells" :active="request()->is('sells')">Vendas</x-dropdown-item>
                            <!-- <x-dropdown-item href="/wastes" :active="request()->is('wastes')">Desperdício</x-dropdown-item> -->
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </nav>
        @endauth

        @guest
        <nav class="py-4" aria-label="Auth Navigation">
            <div class="flex flex-col space-y-2 px-4">
                <x-nav-link href="/login" :active="request()->is('login')" class="py-2 px-4 rounded hover:bg-gray-100">Login</x-nav-link>
                <x-nav-link href="/register" :active="request()->is('register')" class="py-2 px-4 rounded hover:bg-gray-100">Registrar-se</x-nav-link>
            </div>
        </nav>
        @endguest
    </aside>
    <!-- Main Content -->
    <div id="main-content" class="flex-1 p-6 transition-all duration-300 ease-in-out">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-5xl font-extrabold text-center p-4">
                @yield('title', '')
            </h1>

            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>

</html>

<script>
    $(document).ready(function() {
        $('.moneyInput').mask('##0.00', {
            reverse: true
        });

        // Make dropdowns work on mobile/touch devices
        $('.group').on('touchstart', function() {
            $(this).find('.absolute').toggleClass('hidden');
        });

        // Set initial sidebar state (collapsed by default)
        var sidebarOpen = false;

        // Function to update layout based on sidebar state
        function updateLayout() {
            if (sidebarOpen) {
                $('#sidebar').removeClass('-translate-x-full');
                $('#main-content').addClass('ml-64');
                $('#toggle-button').addClass('left-64').removeClass('left-0');
                $('#menu-icon').addClass('hidden');
                $('#close-icon').removeClass('hidden');
            } else {
                $('#sidebar').addClass('-translate-x-full');
                $('#main-content').removeClass('ml-64');
                $('#toggle-button').removeClass('left-64').addClass('left-0');
                $('#menu-icon').removeClass('hidden');
                $('#close-icon').addClass('hidden');
            }
        }

        // Initialize layout
        updateLayout();

        // Sidebar toggle functionality
        $('#sidebar-toggle').on('click', function() {
            sidebarOpen = !sidebarOpen;
            updateLayout();
        });

        // Close sidebar when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#sidebar').length &&
                !$(e.target).closest('#sidebar-toggle').length) {
                if (sidebarOpen) {
                    sidebarOpen = false;
                    updateLayout();
                }
            }
        });
    });
</script>