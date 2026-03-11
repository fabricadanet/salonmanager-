<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800">Movimentar Estoque</h2>
    <p class="text-gray-500 mt-1">Produto: <span class="font-bold text-gray-900"><?= htmlspecialchars($product['name']) ?></span> | Estoque Atual: <?= (int)$product['stock_quantity'] ?></p>
    <a href="/admin/stock" class="text-sm text-indigo-600 hover:text-indigo-900 mt-2 block">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-lg">
    <form action="/admin/stock/store" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Movimento *</label>
            <select name="type" required class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
                <option value="in">Entrada (Adicionar ao estoque)</option>
                <option value="out">Saída (Remover do estoque)</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Quantidade *</label>
            <input type="number" name="quantity" required min="1" value="1" 
                   class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Motivo / Observação</label>
            <input type="text" name="reason" placeholder="Ex: Compra do Fornecedor, Venda Avulsa, Uso Interno, Etiqueta Danificada..." 
                   class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800">
                Registrar Movimento
            </button>
        </div>
    </form>
</div>
