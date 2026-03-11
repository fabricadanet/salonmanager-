<div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800">Transações e Contas</h2>
    <div class="flex gap-2">
        <a href="/admin/finance" class="text-sm text-gray-600 hover:text-gray-900 mt-2">Voltar ao Dashboard</a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    
    <!-- Formulário Nova Transação -->
    <div class="lg:col-span-1">
        <div class="bg-white shadow rounded-lg p-6 sticky top-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">Novo Lançamento</h3>
            
            <form action="/admin/finance/transactions/store" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                    <select name="type" required class="w-full border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="expense">Despesa (Saída)</option>
                        <option value="income">Receita (Entrada)</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                    <select name="category_id" required class="w-full border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                        <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?> (<?= $cat['type'] == 'income' ? '+' : '-' ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                    <input type="text" name="description" required placeholder="Ex: Conta de Luz Março" class="w-full border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Valor (R$)</label>
                    <input type="number" step="0.01" name="amount" required class="w-full border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vencimento</label>
                    <input type="date" name="due_date" required value="<?= date('Y-m-d') ?>" class="w-full border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="paid">Já Pago / Recebido</option>
                        <option value="pending">Pendente a Pagar</option>
                    </select>
                </div>

                <div class="flex items-center mt-2">
                    <input type="checkbox" name="is_recurring" value="1" id="rec" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    <label for="rec" class="ml-2 block text-sm text-gray-900 font-medium z-">Repetir todo mês (Recorrente)</label>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">Lançar Agora</button>
            </form>
        </div>
    </div>

    <!-- Lista Transações -->
    <div class="lg:col-span-3">
        <!-- Filtros Rápidos -->
        <div class="bg-gray-50 p-4 border rounded-lg mb-4 flex gap-4">
            <form method="GET" class="flex items-center gap-4 w-full">
                <select name="type" class="border-gray-300 rounded text-sm py-1.5 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Todos os Tipos</option>
                    <option value="income" <?= $typeFilter == 'income' ? 'selected' : '' ?>>Apenas Entradas</option>
                    <option value="expense" <?= $typeFilter == 'expense' ? 'selected' : '' ?>>Apenas Saídas</option>
                </select>
                <select name="status" class="border-gray-300 rounded text-sm py-1.5 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Qualquer Status</option>
                    <option value="pending" <?= $statusFilter == 'pending' ? 'selected' : '' ?>>Pendentes</option>
                    <option value="paid" <?= $statusFilter == 'paid' ? 'selected' : '' ?>>Pagos</option>
                </select>
                <button type="submit" class="bg-gray-200 px-3 py-1.5 rounded text-sm font-medium hover:bg-gray-300">Filtrar</button>
                <a href="/admin/finance/transactions" class="text-sm text-indigo-600 ml-auto">Limpar Filtros</a>
            </form>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data/Venc</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descrição</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Valor</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Ref.</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <?php foreach($transactions as $t): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">
                            <?= date('d/m/Y', strtotime($t['due_date'])) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 font-medium">
                            <?= htmlspecialchars($t['description']) ?>
                            <?php if($t['is_recurring']): ?><span class="text-xs ml-1 text-indigo-500" title="Recorrente">🔄</span><?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500 truncate max-w-[120px]" title="<?= htmlspecialchars($t['category_name']) ?>">
                            <?= htmlspecialchars($t['category_name']) ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-right font-bold <?= $t['type'] == 'income' ? 'text-emerald-600' : 'text-red-600' ?>">
                            R$ <?= number_format($t['amount'], 2, ',', '.') ?>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <?php if($t['status'] == 'paid'): ?>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Liquidado</span>
                            <?php else: ?>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pendente</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <?php if($t['reference_type'] == 'commission'): ?>
                                <span class="text-[10px] font-bold bg-purple-100 text-purple-700 px-1 rounded">COMISSÃO</span>
                            <?php elseif($t['reference_type'] == 'sales' || $t['reference_type'] == 'appointment'): ?>
                                <span class="text-[10px] font-bold bg-blue-100 text-blue-700 px-1 rounded">VENDA</span>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-right text-sm font-medium flex justify-end gap-2">
                            <?php if($t['status'] == 'pending'): ?>
                            <form action="/admin/finance/transactions/pay" method="POST" class="inline">
                                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                <button type="submit" class="text-emerald-600 hover:text-emerald-900 font-bold" title="Dar Baixa (Pagar)"><svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></button>
                            </form>
                            <?php endif; ?>

                            <form action="/admin/finance/transactions/delete" method="POST" class="inline" onsubmit="return confirm('Apagar este lançamento definitivamente?');">
                                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                <button type="submit" class="text-red-500 hover:text-red-900"><svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if(empty($transactions)): ?>
                <div class="p-8 text-center text-gray-500">Nenhuma transação encontrada.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
