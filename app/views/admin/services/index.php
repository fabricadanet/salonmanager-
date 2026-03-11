<div class="flex justify-between items-center mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800">Serviços</h2>
    <a href="/admin/services/create" class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded shadow text-sm font-medium">
        + Novo Serviço
    </a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço (R$)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duração (min)</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($items as $item): ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['name']) ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?= htmlspecialchars($item['description']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= number_format($item['price'], 2, ',', '.') ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $item['duration'] ?> min</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="/admin/services/edit?id=<?= $item['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                    <form action="/admin/services/delete" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza?');">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($items)): ?>
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Nenhum serviço cadastrado.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
