<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
    <p class="text-sm text-gray-500">Resumo de desempenho de hoje</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Card 1 -->
    <div class="bg-indigo-600 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
        <svg class="absolute -bottom-4 -right-4 w-32 h-32 opacity-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
        <div class="relative z-10">
            <h3 class="text-indigo-100 text-sm font-semibold uppercase tracking-wider mb-1">Agendamentos (Hoje)</h3>
            <p class="mt-2 text-4xl font-black">
                <?= number_format($appointmentsToday) ?>
            </p>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-emerald-500 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
        <svg class="absolute -bottom-4 -right-4 w-32 h-32 opacity-10" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
        <div class="relative z-10">
            <h3 class="text-emerald-50 text-sm font-semibold uppercase tracking-wider mb-1">Faturamento Total (Hoje)</h3>
            <p class="mt-2 text-4xl font-black">
                R$ <?= number_format($revenueToday, 2, ',', '.') ?>
            </p>
            <p class="text-sm text-emerald-100 font-medium mt-1">+ R$ <?= number_format($revenueSalesToday, 2, ',', '.') ?> via PDV</p>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-fuchsia-600 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
        <svg class="absolute -bottom-4 -right-4 w-32 h-32 opacity-10" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
        <div class="relative z-10">
            <h3 class="text-fuchsia-100 text-sm font-semibold uppercase tracking-wider mb-1">Comissões a Pagar (Hoje)</h3>
            <p class="mt-2 flex items-baseline text-4xl font-black">
                R$ <?= number_format($commissionsToday, 2, ',', '.') ?>
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Mini Card 1 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
        <div>
            <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Serviços Concluídos (Hoje)</h3>
            <p class="mt-1 text-2xl font-black text-gray-900"><?= number_format($servicesToday) ?></p>
        </div>
        <div class="bg-indigo-50 p-3 rounded-full text-indigo-600">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" /></svg>
        </div>
    </div>

    <!-- Mini Card 2 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between">
        <div>
            <h3 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Total de Clientes Registrados</h3>
            <p class="mt-1 text-2xl font-black text-gray-900"><?= number_format($totalCustomers) ?></p>
        </div>
        <div class="bg-fuchsia-50 p-3 rounded-full text-fuchsia-600">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
        </div>
    </div>
</div>

<!-- Additional Panels -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Welcome -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Bem-vindo, <?= htmlspecialchars(Auth::user()['name']) ?>.</h3>
        <p class="text-gray-600">Utilize o menu lateral para gerenciar agendamentos, clientes, serviços e demais configurações do salão.</p>
    </div>

    <!-- Low Stock Alerts -->
    <?php if (!empty($lowStockProducts)): ?>
    <div class="bg-white shadow rounded-lg p-6 border-l-4 border-red-500">
        <h3 class="text-lg font-medium text-red-700 flex items-center mb-4">
            <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            Alerta de Estoque Baixo
        </h3>
        <ul class="divide-y divide-gray-200">
            <?php foreach($lowStockProducts as $prod): ?>
                <li class="py-2 flex justify-between">
                    <span class="text-sm font-medium text-gray-900"><?= htmlspecialchars($prod['name']) ?></span>
                    <span class="text-sm font-bold text-red-600">Restam: <?= $prod['stock_quantity'] ?> (Mínimo: <?= $prod['min_stock_level'] ?>)</span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="mt-4">
            <a href="/admin/stock" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">Gerenciar Estoque &rarr;</a>
        </div>
    </div>
    <?php endif; ?>
</div>
