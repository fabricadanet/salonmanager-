<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800"><?= $item ? 'Editar Serviço' : 'Novo Serviço' ?></h2>
    <a href="/admin/services" class="text-sm text-indigo-600 hover:text-indigo-900 mt-2 block">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl">
    <form action="<?= $item ? '/admin/services/update' : '/admin/services/store' ?>" method="POST">
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
                <label class="block text-sm font-medium text-gray-700 mb-2">Duração (minutos) *</label>
                <input type="number" name="duration" required value="<?= $item['duration'] ?? '' ?>" 
                       class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800">
                Salvar Serviço
            </button>
        </div>
    </form>
</div>
