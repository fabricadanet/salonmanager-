<div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800">Categorias Financeiras</h2>
    <div class="flex gap-2">
        <a href="/admin/finance" class="text-sm text-gray-600 hover:text-gray-900 mt-2">Voltar ao Dashboard</a>
        <a href="/admin/finance/transactions" class="text-sm text-indigo-600 hover:text-indigo-900 mt-2 ml-4">Todos os Lançamentos</a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Nova Categoria -->
    <div class="lg:col-span-1">
        <div class="bg-white shadow rounded-lg p-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">Nova Categoria</h3>
            
            <form action="/admin/finance/categories/store" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome da Categoria</label>
                    <input type="text" name="name" required placeholder="Ex: Fornecedores, Salários..." class="w-full border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo Primário</label>
                    <select name="type" required class="w-full border-gray-300 rounded focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="expense">Despesa (Gasto / Saída)</option>
                        <option value="income">Receita (Lucro / Entrada)</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">Adicionar Categoria</button>
            </form>
        </div>
        <div class="mt-4 text-sm text-gray-500">
            <p><strong>Nota:</strong> Estas categorias aparecerão no formulário na hora de registrar uma nova entrada ou saída de dinheiro do salão.</p>
        </div>
    </div>

    <!-- Lista -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    <?php foreach($categories as $c): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-bold text-gray-900 whitespace-nowrap">
                            <?= htmlspecialchars($c['name']) ?>
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap">
                            <?php if($c['type'] === 'income'): ?>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">Receita (+)</span>
                            <?php else: ?>
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Despesa (-)</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-right font-medium">
                            <!-- Prevenir exclusão de categorias críticas de sistema -->
                            <?php if(!in_array($c['name'], ['Venda PDV', 'Agendamento', 'Comissão Profissional'])): ?>
                            <form action="/admin/finance/categories/delete" method="POST" onsubmit="return confirm('Deseja excluir esta categoria? Isso pode afetar históricos antigos.');">
                                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                <button type="submit" class="text-red-500 hover:text-red-900 leading-none" title="Excluir"><svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                            </form>
                            <?php else: ?>
                                <span class="text-xs text-gray-400">Protegido do Sistema</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
