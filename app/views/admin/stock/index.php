<div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800">Controle de Estoque</h2>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade Atual</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Mínimo Ideal</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($products as $product): ?>
            <?php 
                $stock = (int)$product['stock_quantity'];
                $min = (int)$product['min_stock_level'];
                
                $statusColor = 'bg-green-100 text-green-800';
                $statusText = 'Adequado';
                
                if ($stock == 0) {
                    $statusColor = 'bg-red-100 text-red-800';
                    $statusText = 'Esgotado';
                } elseif ($stock <= $min) {
                    $statusColor = 'bg-yellow-100 text-yellow-800';
                    $statusText = 'Estoque Baixo';
                }
            ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($product['name']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $statusColor ?>">
                        <?= $statusText ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold <?= $stock <= $min ? 'text-red-600' : 'text-gray-900' ?>">
                    <?= $stock ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                    <?= $min ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="/admin/stock/movement?product_id=<?= $product['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Movimentar</a>
                    <a href="/admin/stock/history?product_id=<?= $product['id'] ?>" class="text-gray-600 hover:text-gray-900">Histórico</a>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($products)): ?>
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Nenhum produto cadastrado. Adicione produtos na aba "Produtos".</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
