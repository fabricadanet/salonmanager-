<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-100 pb-6 gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase">Painel de Controle</h2>
        <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1">Visão Geral do Negócio</p>
    </div>
    
    <div class="flex bg-gray-100 p-1 rounded-none">
        <a href="/admin?range=today" class="px-4 py-2 text-[10px] font-black uppercase tracking-widest transition-all <?= ($range ?? 'today') === 'today' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-slate-600' ?>">Hoje</a>
        <a href="/admin?range=month" class="px-4 py-2 text-[10px] font-black uppercase tracking-widest transition-all <?= ($range ?? '') === 'month' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-slate-600' ?>">Mês</a>
        <a href="/admin?range=year" class="px-4 py-2 text-[10px] font-black uppercase tracking-widest transition-all <?= ($range ?? '') === 'year' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-400 hover:text-slate-600' ?>">Ano</a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Revenue -->
    <div class="bg-indigo-600 p-6 text-white relative overflow-hidden group">
        <div class="relative z-10">
            <h3 class="text-indigo-100 text-[10px] font-black uppercase tracking-widest mb-1">Faturamento (Hoje)</h3>
            <p class="text-3xl font-black tracking-tighter">R$ <?= number_format($revenueToday, 2, ',', '.') ?></p>
            <p class="text-[9px] text-indigo-200 mt-2 font-bold uppercase tracking-widest">Inclui PDV: R$ <?= number_format($revenueSalesToday, 2, ',', '.') ?></p>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-10 transition-transform group-hover:scale-110 duration-500">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
        </div>
    </div>

    <!-- Appointments -->
    <div class="bg-slate-900 p-6 text-white relative overflow-hidden group">
        <div class="relative z-10">
            <h3 class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Agendamentos (Hoje)</h3>
            <p class="text-3xl font-black tracking-tighter"><?= number_format($appointmentsToday) ?></p>
            <p class="text-[9px] text-slate-500 mt-2 font-bold uppercase tracking-widest"><?= number_format($servicesToday) ?> concluídos</p>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-10 transition-transform group-hover:scale-110 duration-500">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
        </div>
    </div>

    <!-- New Customers -->
    <div class="bg-emerald-500 p-6 text-white relative overflow-hidden group">
        <div class="relative z-10">
            <h3 class="text-emerald-100 text-[10px] font-black uppercase tracking-widest mb-1">Novos Clientes</h3>
            <p class="text-3xl font-black tracking-tighter"><?= number_format($newCustomersRange) ?></p>
            <p class="text-[9px] text-emerald-200 mt-2 font-bold uppercase tracking-widest">No período selecionado</p>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-10 transition-transform group-hover:scale-110 duration-500">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
    </div>

    <!-- Commissions -->
    <div class="bg-fuchsia-600 p-6 text-white relative overflow-hidden group">
        <div class="relative z-10">
            <h3 class="text-fuchsia-100 text-[10px] font-black uppercase tracking-widest mb-1">Comissões (Hoje)</h3>
            <p class="text-3xl font-black tracking-tighter">R$ <?= number_format($commissionsToday, 2, ',', '.') ?></p>
            <p class="text-[9px] text-fuchsia-200 mt-2 font-bold uppercase tracking-widest">Geradas para a equipe</p>
        </div>
        <div class="absolute -right-4 -bottom-4 opacity-10 transition-transform group-hover:scale-110 duration-500">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path></svg>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
    <!-- Top Customers -->
    <div class="bg-white border border-gray-100 shadow-sm p-6 overflow-hidden">
        <div class="flex items-center justify-between mb-6 border-b border-gray-50 pb-4">
            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-900 italic">Top 5 Clientes</h3>
            <span class="text-[9px] font-black uppercase tracking-widest text-gray-400">Consumo</span>
        </div>
        <div class="space-y-4">
            <?php if (empty($topCustomers)): ?>
                <p class="text-[10px] text-gray-400 italic">Sem dados no período.</p>
            <?php else: ?>
                <?php foreach ($topCustomers as $index => $c): ?>
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-black text-slate-300 w-4">0<?= $index + 1 ?></span>
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-tighter group-hover:text-indigo-600 transition-colors"><?= htmlspecialchars($c['name']) ?></span>
                        </div>
                        <span class="text-[10px] font-black text-slate-900 tracking-tighter">R$ <?= number_format($c['total'], 2, ',', '.') ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Top Products/Services -->
    <div class="bg-white border border-gray-100 shadow-sm p-6 overflow-hidden">
        <div class="flex items-center justify-between mb-6 border-b border-gray-50 pb-4">
            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-900 italic">Mais Consumidos</h3>
            <span class="text-[9px] font-black uppercase tracking-widest text-gray-400">Itens</span>
        </div>
        <div class="space-y-4">
            <?php if (empty($topItems)): ?>
                <p class="text-[10px] text-gray-400 italic">Sem dados no período.</p>
            <?php else: ?>
                <?php foreach ($topItems as $index => $item): ?>
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-black text-slate-300 w-4">0<?= $index + 1 ?></span>
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-tighter group-hover:text-indigo-600 transition-colors"><?= htmlspecialchars($item['item_name']) ?></span>
                        </div>
                        <span class="text-[10px] font-black text-slate-900 tracking-tighter"><?= $item['total'] ?> un</span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Top Professionals -->
    <div class="bg-white border border-gray-100 shadow-sm p-6 overflow-hidden">
        <div class="flex items-center justify-between mb-6 border-b border-gray-50 pb-4">
            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-900 italic">Profissionais Elite</h3>
            <span class="text-[9px] font-black uppercase tracking-widest text-gray-400">Serviços</span>
        </div>
        <div class="space-y-4">
            <?php if (empty($topProfessionals)): ?>
                <p class="text-[10px] text-gray-400 italic">Sem dados no período.</p>
            <?php else: ?>
                <?php foreach ($topProfessionals as $index => $p): ?>
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-black text-slate-300 w-4">0<?= $index + 1 ?></span>
                            <span class="text-xs font-bold text-slate-700 uppercase tracking-tighter group-hover:text-indigo-600 transition-colors"><?= htmlspecialchars($p['name']) ?></span>
                        </div>
                        <span class="text-[10px] font-black text-slate-900 tracking-tighter"><?= $p['total'] ?> atend.</span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Low Stock Alerts -->
    <?php if (!empty($lowStockProducts)): ?>
    <div class="bg-white shadow-sm border border-red-100 p-8 overflow-hidden relative">
        <div class="absolute top-0 right-0 p-4 opacity-5">
            <svg class="w-24 h-24 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.45l8.28 14.55H3.72L12 5.45zM11 16h2v2h-2v-2zm0-7h2v5h-2V9z"/></svg>
        </div>
        <h3 class="text-lg font-black text-red-600 uppercase tracking-tighter italic mb-6 flex items-center gap-2">
            <span class="w-2 h-2 bg-red-600 rounded-full animate-pulse"></span>
            Crítico: Reposição de Estoque
        </h3>
        <ul class="space-y-4 relative z-10">
            <?php foreach($lowStockProducts as $prod): ?>
                <li class="flex justify-between items-center border-b border-gray-50 pb-3">
                    <span class="text-xs font-bold text-slate-700 uppercase tracking-tighter"><?= htmlspecialchars($prod['name']) ?></span>
                    <span class="text-[10px] font-black text-red-500 bg-red-50 px-3 py-1"><?= $prod['stock_quantity'] ?> em estoque</span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="mt-8">
            <a href="/admin/stock" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-red-600 transition-colors flex items-center gap-2">
                Gerenciar Inventário &rarr;
            </a>
        </div>
    </div>
    <?php endif; ?>

    <!-- Welcome Panel -->
    <div class="bg-slate-900 p-8 text-white relative overflow-hidden group">
        <div class="absolute -right-12 -bottom-12 opacity-5 text-indigo-400 transition-transform group-hover:scale-125 duration-700">
            <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
        </div>
        <div class="relative z-10">
            <h3 class="text-2xl font-black tracking-tighter uppercase mb-4">Bem-vindo, <?= htmlspecialchars(explode(' ', Auth::user()['name'])[0]) ?>.</h3>
            <p class="text-slate-400 text-sm font-medium leading-relaxed max-w-md">O sistema está pronto para as operações de hoje. Monitore seus KPIs e gerencie sua agenda com precisão cirúrgica.</p>
            <div class="mt-8 grid grid-cols-2 gap-4">
                <div class="border border-slate-700 p-4 group-hover:border-indigo-500/30 transition-colors">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Status Sistema</p>
                    <p class="text-xs font-bold text-emerald-400 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full shadow-[0_0_8px_rgba(52,211,153,0.5)]"></span>
                        Operacional
                    </p>
                </div>
                <div class="border border-slate-700 p-4 group-hover:border-indigo-500/30 transition-colors">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Backups</p>
                    <p class="text-xs font-bold text-slate-300">Atualizado</p>
                </div>
            </div>
        </div>
    </div>
</div>
