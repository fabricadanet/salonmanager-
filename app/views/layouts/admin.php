<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SalonManager' ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-900 antialiased h-screen flex overflow-hidden">
    <!-- Sidebar for Admin Panel -->
    <?php if (isset($showSidebar) && $showSidebar): ?>
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="h-16 flex items-center justify-center border-b border-gray-800">
                <h1 class="text-xl font-bold">SalonManager</h1>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="/admin" class="block px-4 py-2 rounded text-gray-300 hover:bg-gray-800 hover:text-white">Dashboard</a>
                <a href="/admin/appointments" class="block px-4 py-2 rounded text-gray-300 hover:bg-gray-800 hover:text-white">Agendamentos</a>
                <a href="/admin/customers" class="block px-4 py-2 rounded text-gray-300 hover:bg-gray-800 hover:text-white">Clientes</a>
                <a href="/admin/services" class="block px-4 py-2 rounded text-gray-300 hover:bg-gray-800 hover:text-white">Serviços</a>
                <a href="/admin/sales/create" class="flex items-center px-4 py-3 <?= strpos($_SERVER['REQUEST_URI'], '/admin/sales/create') === 0 ? 'bg-fuchsia-600 font-bold' : 'hover:bg-gray-800' ?> transition-colors">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    PDV / Caixa
                </a>
                
                <a href="/admin/finance" class="flex items-center px-4 py-3 <?= strpos($_SERVER['REQUEST_URI'], '/admin/finance') === 0 ? 'bg-indigo-700 font-bold' : 'hover:bg-gray-800' ?> transition-colors">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Financeiro
                </a>

                <div class="px-4 py-2 mt-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Cadastros
                </div>
                <a href="/admin/stock" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    Estoque
                </a>
                <a href="/admin/professionals" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    Profissionais
                </a>
                <a href="/admin/content" class="block px-4 py-2 rounded text-gray-300 hover:bg-gray-800 hover:text-white">Site Público</a>
            </nav>
            <div class="p-4 border-t border-gray-800">
                <a href="/logout" class="block w-full text-center px-4 py-2 bg-red-600 rounded text-white hover:bg-red-700">Sair</a>
            </div>
        </aside>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-y-auto">
        <?php if (isset($showSidebar) && $showSidebar): ?>
        <header class="bg-white shadow h-16 flex items-center px-6 md:hidden">
            <!-- Mobile header -->
            <button class="text-gray-500 focus:outline-none focus:text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <h1 class="ml-4 text-xl font-semibold">SalonManager</h1>
        </header>
        <?php endif; ?>
        
        <main class="<?= isset($showSidebar) && $showSidebar ? 'p-6 flex-1' : '' ?>">
            <?= $content ?? '' ?>
        </main>
    </div>
</body>
</html>
