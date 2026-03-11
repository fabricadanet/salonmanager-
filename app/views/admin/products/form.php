<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800"><?= $item ? 'Editar Produto' : 'Novo Produto' ?></h2>
    <a href="/admin/products" class="text-sm text-indigo-600 hover:text-indigo-900 mt-2 block">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl">
    <form action="<?= $item ? '/admin/products/update' : '/admin/products/store' ?>" method="POST">
        <?php if ($item): ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <?php endif; ?>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nome *</label>
            <input type="text" name="name" required value="<?= htmlspecialchars($item['name'] ?? '') ?>" 
                   class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
            <textarea name="description" rows="3" 
                      class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Preço (R$) *</label>
                <input type="number" step="0.01" name="price" required value="<?= $item['price'] ?? '' ?>" 
                       class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">URL da Imagem</label>
                <input type="text" name="image" value="<?= htmlspecialchars($item['image'] ?? '') ?>" placeholder="/assets/images/produto.jpg"
                       class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
        </div>

        <div class="mb-6 bg-gray-50 p-4 border rounded grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <h4 class="text-sm font-bold text-gray-700 mb-2">Controle de Estoque</h4>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mínimo Ideal (Alerta) *</label>
                <input type="number" name="min_stock_level" required min="0" value="<?= $item['min_stock_level'] ?? '5' ?>" 
                       class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <h4 class="text-sm font-bold text-gray-700 mb-2">Comissionamento</h4>
                <label class="block text-sm font-medium text-gray-700 mb-1">Comissão do Profissional (%)</label>
                <input type="number" step="0.01" name="commission_percentage" min="0" max="100" value="<?= $item['commission_percentage'] ?? '0' ?>" 
                       class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800">
                Salvar Produto
            </button>
        </div>
    </form>
</div>
