<div class="mb-8 flex justify-between items-end border-b border-gray-100 pb-6">
    <div>
        <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase"><?= isset($user) ? 'Editar Acesso' : 'Novo Acesso' ?></h2>
        <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1">Configuração de Permissões</p>
    </div>
    <a href="/admin/users" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-slate-900 transition-colors">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow-sm border border-gray-100 p-8 max-w-4xl">
    <form action="<?= isset($user) ? '/admin/users/update' : '/admin/users/store' ?>" method="POST" class="space-y-8">
        <?php if (isset($user)): ?>
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nome Completo *</label>
                <input type="text" name="name" required value="<?= htmlspecialchars($user['name'] ?? '') ?>" 
                       placeholder="Ex: Administrador Principal"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none font-bold">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">E-mail de Acesso *</label>
                <input type="email" name="email" required value="<?= htmlspecialchars($user['email'] ?? '') ?>" 
                       placeholder="admin@salao.com"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Senha <?= isset($user) ? '(deixe vazio para manter)' : '*' ?></label>
                <input type="password" name="password" <?= isset($user) ? '' : 'required' ?> 
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nível de Acesso *</label>
                <select name="role" required class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none appearance-none">
                    <option value="admin" <?= (isset($user) && $user['role'] === 'admin') ? 'selected' : '' ?>>Administrador</option>
                    <option value="professional" <?= (isset($user) && $user['role'] === 'professional') ? 'selected' : '' ?>>Profissional</option>
                </select>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-50 flex justify-end">
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-12 py-4 rounded-none shadow-sm text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-[0.98]">
                <?= isset($user) ? 'Atualizar Dados' : 'Criar Usuário' ?>
            </button>
        </div>
    </form>
</div>
