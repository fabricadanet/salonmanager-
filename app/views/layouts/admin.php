<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    require_once __DIR__ . '/../../models/WebsiteContent.php';
    $contentModel = new WebsiteContent();
    $globalConfig = $contentModel->where('section', 'global')[0] ?? [];
    $sysName = !empty($globalConfig['title']) ? $globalConfig['title'] : 'SalonManager';
    ?>
    <title><?= $title ?? $sysName ?></title>
    <?php if(!empty($globalConfig['image'])): ?>
    <link rel="icon" type="image/x-icon" href="<?= $globalConfig['image'] ?>">
    <?php endif; ?>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
    <!-- Alpine wrapper around the whole UI -->
    <div x-data="{ sidebarOpen: localStorage.getItem('sidebarOpen') !== 'false' }" 
         x-init="$watch('sidebarOpen', val => localStorage.setItem('sidebarOpen', val))"
         class="flex h-full w-full">
         
    <!-- Sidebar for Admin Panel -->
    <?php if (isset($showSidebar) && $showSidebar): ?>
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-gray-900 text-white flex-shrink-0 hidden md:flex flex-col transition-all duration-300 ease-in-out">
            <div class="h-16 flex items-center justify-between px-4 border-b border-gray-800">
                <h1 x-show="sidebarOpen" class="text-xl font-bold truncate"><?= $sysName ?></h1>
                
                <!-- Toggle Button -->
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 hover:text-white focus:outline-none" :class="!sidebarOpen && 'w-full flex justify-center'">
                    <svg x-show="sidebarOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                    <svg x-show="!sidebarOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto" :class="sidebarOpen ? 'px-3' : 'px-2 items-center'">
                <a href="/admin" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= $_SERVER['REQUEST_URI'] === '/admin' ? 'bg-gray-800 text-white pointer-events-none' : 'text-gray-300 hover:bg-gray-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Painel Geral' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= $_SERVER['REQUEST_URI'] === '/admin' ? 'text-white' : 'text-gray-400' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Painel Geral</span>
                </a>
                
                <a href="/admin/appointments" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= strpos($_SERVER['REQUEST_URI'], '/admin/appointments') === 0 ? 'bg-emerald-600 text-white pointer-events-none' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Agenda' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/appointments') === 0 ? 'text-white' : 'text-emerald-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Agenda</span>
                </a>

                <a href="/admin/sales/create" class="flex items-center px-3 py-2.5 mt-2 rounded-lg text-sm font-bold <?= strpos($_SERVER['REQUEST_URI'], '/admin/sales/create') === 0 ? 'bg-fuchsia-600 text-white pointer-events-none' : 'text-fuchsia-100 hover:bg-fuchsia-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Frente de Caixa' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/sales/create') === 0 ? 'text-white' : 'text-fuchsia-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Frente de Caixa</span>
                </a>
                
                <a href="/admin/finance" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-bold <?= strpos($_SERVER['REQUEST_URI'], '/admin/finance') === 0 ? 'bg-indigo-600 text-white pointer-events-none' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Financeiro' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/finance') === 0 ? 'text-white' : 'text-indigo-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Financeiro</span>
                </a>

                <div x-show="sidebarOpen" class="px-3 py-2 mt-6 text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap overflow-hidden">
                    Cadastros Básicos
                </div>
                <!-- Small dividing dots when collapsed -->
                <div x-show="!sidebarOpen" class="px-3 py-2 mt-6 text-xs font-bold text-gray-600 text-center tracking-wider">
                    ...
                </div>
                
                <a href="/admin/customers" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= strpos($_SERVER['REQUEST_URI'], '/admin/customers') === 0 ? 'bg-blue-600 text-white pointer-events-none' : 'text-blue-100 hover:bg-blue-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Clientes' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/customers') === 0 ? 'text-white' : 'text-blue-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Clientes</span>
                </a>
                
                <a href="/admin/services" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= strpos($_SERVER['REQUEST_URI'], '/admin/services') === 0 ? 'bg-pink-600 text-white pointer-events-none' : 'text-pink-100 hover:bg-pink-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Serviços' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/services') === 0 ? 'text-white' : 'text-pink-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Serviços</span>
                </a>

                <a href="/admin/products" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= strpos($_SERVER['REQUEST_URI'], '/admin/products') === 0 ? 'bg-orange-600 text-white pointer-events-none' : 'text-orange-100 hover:bg-orange-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Produtos e Vendas' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/products') === 0 ? 'text-white' : 'text-orange-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Produtos e Vendas</span>
                </a>
                
                <a href="/admin/stock" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= strpos($_SERVER['REQUEST_URI'], '/admin/stock') === 0 ? 'bg-amber-600 text-white pointer-events-none' : 'text-amber-100 hover:bg-amber-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Movimentos de Estoque' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/stock') === 0 ? 'text-white' : 'text-amber-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Movimentos de Estoque</span>
                </a>

                <a href="/admin/professionals" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= strpos($_SERVER['REQUEST_URI'], '/admin/professionals') === 0 ? 'bg-cyan-600 text-white pointer-events-none' : 'text-cyan-100 hover:bg-cyan-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Profissionais' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/professionals') === 0 ? 'text-white' : 'text-cyan-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Profissionais</span>
                </a>

                <div x-show="sidebarOpen" class="px-3 py-2 mt-6 text-xs font-semibold text-gray-500 uppercase tracking-wider whitespace-nowrap overflow-hidden">
                    Configurações do App
                </div>
                <div x-show="!sidebarOpen" class="px-3 py-2 mt-6 text-xs font-bold text-gray-600 text-center tracking-wider">
                    ...
                </div>

                <a href="/admin/users" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= strpos($_SERVER['REQUEST_URI'], '/admin/users') === 0 ? 'bg-red-600 text-white pointer-events-none' : 'text-red-100 hover:bg-red-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Acessos' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/users') === 0 ? 'text-white' : 'text-red-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Acessos <span x-show="sidebarOpen">(Usuários)</span></span>
                </a>

                <a href="/admin/content" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= strpos($_SERVER['REQUEST_URI'], '/admin/content') === 0 ? 'bg-teal-600 text-white pointer-events-none' : 'text-teal-100 hover:bg-teal-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'Site Público' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/content') === 0 ? 'text-white' : 'text-teal-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">Site Público</span>
                </a>

                <a href="/admin/seo" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium <?= strpos($_SERVER['REQUEST_URI'], '/admin/seo') === 0 ? 'bg-indigo-600 text-white pointer-events-none' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' ?> transition-colors" :title="!sidebarOpen ? 'SEO & Rastreamento' : ''">
                    <svg class="h-5 w-5 flex-shrink-0 <?= strpos($_SERVER['REQUEST_URI'], '/admin/seo') === 0 ? 'text-white' : 'text-indigo-300' ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <span x-show="sidebarOpen" class="ml-3 whitespace-nowrap">SEO & Rastreamento</span>
                </a>
            </nav>
            <div class="p-4 border-t border-gray-800 text-center">
                <a href="/logout" class="block w-full text-center px-2 py-2 bg-red-600 rounded text-white hover:bg-red-700 transition" title="Sair do Sistema">
                    <svg x-show="!sidebarOpen" class="h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span x-show="sidebarOpen">Sair</span>
                </a>
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
            <h1 class="ml-4 text-xl font-semibold"><?= $sysName ?></h1>
        </header>
        <?php endif; ?>
        
        <main class="<?= isset($showSidebar) && $showSidebar ? 'p-6 flex-1' : '' ?> overflow-y-auto">
            <?= $content ?? '' ?>
        </main>
    </div>
    
    <!-- Close alpine x-data wrapper -->
    </div>
</body>
</html>
