<div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
    <div>
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Módulo Financeiro</h2>
        <p class="text-sm text-gray-500 mt-1">Visão geral do caixa deste mês (<?= date('m/Y') ?>)</p>
    </div>
    <div class="flex gap-2 text-sm">
        <a href="/admin/finance/transactions" class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 font-bold rounded-lg hover:bg-indigo-100 transition shadow-sm">
            Ver Lançamentos
        </a>
        <a href="/admin/finance/categories" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition shadow-sm">
            Categorias
        </a>
    </div>
</div>

<!-- DRE / Big Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Receitas -->
    <div class="bg-emerald-500 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
        <svg class="absolute -bottom-4 -right-4 w-32 h-32 opacity-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>
        <div class="relative z-10">
            <h3 class="text-emerald-50 text-sm font-semibold uppercase tracking-wider mb-1">Receitas Quitadas (Mês)</h3>
            <p class="mt-2 text-4xl font-black">R$ <?= number_format($incomeMonth, 2, ',', '.') ?></p>
        </div>
    </div>

    <!-- Despesas -->
    <div class="bg-red-500 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
        <svg class="absolute -bottom-4 -right-4 w-32 h-32 opacity-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 13a1 1 0 110 2H7a1 1 0 01-1-1v-5a1 1 0 112 0v2.586l4.293-4.293a1 1 0 011.414 0l2.293 2.293 4.293-4.293a1 1 0 111.414 1.414l-5 5a1 1 0 01-1.414 0L11 9.414 7.414 13H12z" clip-rule="evenodd"></path></svg>
        <div class="relative z-10">
            <h3 class="text-red-50 text-sm font-semibold uppercase tracking-wider mb-1">Despesas Pagas (Mês)</h3>
            <p class="mt-2 text-4xl font-black">R$ <?= number_format($expenseMonth, 2, ',', '.') ?></p>
        </div>
    </div>

    <!-- Saldo -->
    <div class="<?= $balanceMonth >= 0 ? 'bg-indigo-600' : 'bg-orange-500' ?> rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
        <div class="relative z-10">
            <h3 class="text-indigo-100 text-sm font-semibold uppercase tracking-wider mb-1">Saldo Atual</h3>
            <p class="mt-2 text-4xl font-black">R$ <?= number_format($balanceMonth, 2, ',', '.') ?></p>
        </div>
    </div>
</div>

<!-- Pending Box -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-200 pb-2">Próximos Vencimentos (Pendentes)</h3>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <ul class="divide-y divide-gray-200">
                <?php foreach($upcomingPending as $txn): ?>
                <li class="p-4 flex items-center justify-between hover:bg-gray-50">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-4">
                            <?php if($txn['type'] === 'income'): ?>
                                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold">↑</div>
                            <?php else: ?>
                                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold">↓</div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900"><?= htmlspecialchars($txn['description']) ?></p>
                            <p class="text-xs text-gray-500"><?= htmlspecialchars($txn['category_name']) ?> • Vence em: <span class="<?= strtotime($txn['due_date']) < time() ? 'text-red-600 font-bold' : '' ?>"><?= date('d/m/Y', strtotime($txn['due_date'])) ?></span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-black <?= $txn['type'] === 'income' ? 'text-emerald-600' : 'text-red-600' ?>">
                            <?= $txn['type'] === 'income' ? '+' : '-' ?> R$ <?= number_format($txn['amount'], 2, ',', '.') ?>
                        </p>
                        <form action="/admin/finance/transactions/pay" method="POST" class="mt-1">
                            <input type="hidden" name="id" value="<?= $txn['id'] ?>">
                            <button type="submit" class="text-xs bg-gray-900 text-white px-2 py-1 rounded hover:bg-gray-700 font-medium">Dar Baixa</button>
                        </form>
                    </div>
                </li>
                <?php endforeach; ?>
                
                <?php if(empty($upcomingPending)): ?>
                    <li class="p-8 text-center text-gray-500">Nenhuma conta pendente próxima. Viva! 🎉</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 border-red-500">
            <h4 class="text-sm font-bold text-gray-500 uppercase">Total a Pagar Pendente</h4>
            <p class="text-3xl font-black text-red-600 mt-2">R$ <?= number_format($pendingExpenses, 2, ',', '.') ?></p>
            <p class="text-xs text-gray-400 mt-1">Soma de todas despesas abertas até o fim do mês</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 border-l-4 border-emerald-500">
            <h4 class="text-sm font-bold text-gray-500 uppercase">Total a Receber Pendente</h4>
            <p class="text-3xl font-black text-emerald-600 mt-2">R$ <?= number_format($pendingIncomes, 2, ',', '.') ?></p>
            <p class="text-xs text-gray-400 mt-1">Soma de recebimentos em aberto</p>
        </div>
    </div>
</div>
