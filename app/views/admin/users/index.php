<div class="mb-6 border-b border-gray-200 pb-4 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Contas de Acesso</h2>
        <p class="text-sm text-gray-500">Gerencie quem tem login na plataforma do salão</p>
    </div>
    <a href="/admin/users/create" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-sm transition">
        + Novo Usuário
    </a>
</div>

<div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email (Login)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Função (Nível)</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php foreach($users as $u): ?>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold mr-3">
                            <?= substr(htmlspecialchars($u['name']), 0, 1) ?>
                        </div>
                        <div class="text-sm font-bold text-gray-900">
                            <?= htmlspecialchars($u['name']) ?>
                            <?php if($u['id'] == Auth::user()['id']): ?>
                                <span class="ml-2 text-[10px] font-medium bg-green-100 text-green-800 px-2 py-0.5 rounded-full">Você</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?= htmlspecialchars($u['email']) ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?php if($u['role'] === 'admin'): ?>
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">Administrador</span>
                    <?php elseif($u['role'] === 'reception'): ?>
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Recepção</span>
                    <?php else: ?>
                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Profissional</span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="/admin/users/edit?id=<?= $u['id'] ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                    
                    <?php if($u['id'] != Auth::user()['id']): ?>
                    <form action="/admin/users/delete" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar o acesso deste usuário permanentemente?');">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <button type="submit" class="text-red-500 hover:text-red-900 font-medium">Excluir</button>
                    </form>
                    <?php else: ?>
                        <span class="text-gray-300 pointer-events-none" title="Você não pode apagar sua própria conta">Excluir</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if(empty($users)): ?>
    <div class="p-8 text-center text-gray-500 font-medium">Nenhum usuário encontrado.</div>
    <?php endif; ?>
</div>
