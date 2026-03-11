<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800">Histórico de Estoque</h2>
    <p class="text-gray-500 mt-1">Produto: <span class="font-bold text-gray-900"><?= htmlspecialchars($product['name']) ?></span></p>
    <a href="/admin/stock" class="text-sm text-indigo-600 hover:text-indigo-900 mt-2 block">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motivo</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($movements as $mov): ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= date('d/m/Y H:i', strtotime($mov['created_at'])) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">
                    <?php if ($mov['type'] == 'in'): ?>
                        <span class="text-green-600">Entrada</span>
                    <?php else: ?>
                        <span class="text-red-600">Saída</span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($mov['reason'] ?? '-') ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold <?= $mov['type'] == 'in' ? 'text-green-600' : 'text-red-600' ?>">
                    <?= $mov['type'] == 'in' ? '+' : '-' ?><?= $mov['quantity'] ?>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($movements)): ?>
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Nenhuma movimentação registrada.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
