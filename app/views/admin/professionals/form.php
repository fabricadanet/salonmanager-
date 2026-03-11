<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800"><?= $item ? 'Editar Profissional' : 'Novo Profissional' ?></h2>
    <a href="/admin/professionals" class="text-sm text-indigo-600 hover:text-indigo-900 mt-2 block">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl">
    <form action="<?= $item ? '/admin/professionals/update' : '/admin/professionals/store' ?>" method="POST">
        <?php if ($item): ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <?php endif; ?>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nome *</label>
            <input type="text" name="name" required value="<?= htmlspecialchars($item['name'] ?? '') ?>" 
                   class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Especialidade</label>
            <input type="text" name="specialty" value="<?= htmlspecialchars($item['specialty'] ?? '') ?>" 
                   class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Comissão (ex: 0.4 para 40%) *</label>
            <input type="number" step="0.01" max="1" min="0" name="commission_percentage" required value="<?= $item['commission_percentage'] ?? '0.00' ?>" 
                   class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            <p class="text-xs text-gray-500 mt-1">Insira um valor entre 0 e 1 (Exemplo: 0.40 para 40% de comissão no serviço)</p>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800">
                Salvar Profissional
            </button>
        </div>
    </form>
</div>
