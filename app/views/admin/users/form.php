<?php
$isEdit = isset($user);
$action = $isEdit ? '/admin/users/update' : '/admin/users/store';
$title = $isEdit ? 'Editar Usuário' : 'Novo Usuário';
?>

<div class="mb-6 border-b border-gray-200 pb-4 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800"><?= $title ?></h2>
    <a href="/admin/users" class="text-sm font-medium text-gray-600 hover:text-gray-900">
        &larr; Voltar
    </a>
</div>

<div class="bg-white shadow rounded-lg max-w-2xl border border-gray-100 overflow-hidden">
    <form action="<?= $action ?>" method="POST" class="p-6 space-y-6">
        <?php if($isEdit): ?>
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <?php endif; ?>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Nome Completo</label>
            <input type="text" name="name" required value="<?= $isEdit ? htmlspecialchars($user['name']) : '' ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Primeiro e Sobrenome">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">E-mail (Login de Acesso)</label>
            <input type="email" name="email" required value="<?= $isEdit ? htmlspecialchars($user['email']) : '' ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="seu-email@exemplo.com">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">
                <?= $isEdit ? 'Nova Senha (Deixe me branco para NÃO alterar)' : 'Senha de Acesso' ?>
            </label>
            <input type="password" name="password" <?= $isEdit ? '' : 'required' ?> minlength="6" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Tipo de Permissão</label>
            <select name="role" required class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 focus:bg-white transition-colors cursor-pointer">
                <?php
                $currentRole = $isEdit ? $user['role'] : '';
                ?>
                <option value="reception" <?= $currentRole == 'reception' ? 'selected' : '' ?>>
                    👤 Recepção (Pode ver Agenda, Clientes e PDV/Vendas)
                </option>
                <option value="professional" <?= $currentRole == 'professional' ? 'selected' : '' ?>>
                    ✂️ Profissional (Pode ver apenas a própria Agenda)
                </option>
                <option value="admin" <?= $currentRole == 'admin' ? 'selected' : '' ?>>
                    ⚙️ Administrador Gerente (Acesso TOTAL, Financeiro e a todos os usuários)
                </option>
            </select>
            
            <?php if($isEdit && $user['id'] == Auth::user()['id']): ?>
                <p class="text-xs text-orange-600 mt-2 font-medium">⚠️ Cuidado: Você está editando seu próprio nível. Remover privilégios Admin trancará o seu acesso a esta tela.</p>
            <?php endif; ?>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
            <a href="/admin/users" class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">Cancelar</a>
            <button type="submit" class="bg-indigo-600 text-white font-bold px-6 py-2 rounded-lg hover:bg-indigo-700 shadow flex-shrink-0">
                <?= $isEdit ? 'Salvar Configurações' : 'Cadastrar e Convidar' ?>
            </button>
        </div>
    </form>
</div>
