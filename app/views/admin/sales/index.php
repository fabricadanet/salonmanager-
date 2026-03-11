<div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800">Histórico de Vendas (PDV)</h2>
    <a href="/admin/sales/create" class="bg-gray-900 text-white px-4 py-2 hover:bg-gray-800 rounded shadow font-medium transition">Novo Pedido (PDV)</a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Método Pgto.</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($sales as $sale): ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#<?= str_pad($sale['id'], 5, '0', STR_PAD_LEFT) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= date('d/m/Y H:i', strtotime($sale['created_at'])) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    <?= htmlspecialchars($sale['customer_name'] ?? 'Cliente Avulso') ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                    <?= htmlspecialchars($sale['payment_method']) ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">
                    R$ <?= number_format($sale['total_amount'], 2, ',', '.') ?>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($sales)): ?>
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Nenhuma venda registrada ainda.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
