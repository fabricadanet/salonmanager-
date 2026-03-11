<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800"><?= $customer ? 'Editar Cliente' : 'Novo Cliente' ?></h2>
    <a href="/admin/customers" class="text-sm text-indigo-600 hover:text-indigo-900 mt-2 block">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-2xl">
    <form action="<?= $customer ? '/admin/customers/update' : '/admin/customers/store' ?>" method="POST">
        <?php if ($customer): ?>
            <input type="hidden" name="id" value="<?= $customer['id'] ?>">
        <?php endif; ?>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nome *</label>
            <input type="text" name="name" required value="<?= htmlspecialchars($customer['name'] ?? '') ?>" 
                   class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($customer['phone'] ?? '') ?>" 
                   class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($customer['email'] ?? '') ?>" 
                   class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Observações</label>
            <textarea name="notes" rows="3" 
                      class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2"><?= htmlspecialchars($customer['notes'] ?? '') ?></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-800">
                Salvar Cliente
            </button>
        </div>
    </form>
</div>
