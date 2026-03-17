<div class="mb-8 flex justify-between items-end border-b border-gray-100 pb-6">
    <div>
        <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase"><?= $item ? 'Editar Membro' : 'Novo Membro' ?></h2>
        <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1">Configuração de Equipe</p>
    </div>
    <a href="/admin/professionals" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-slate-900 transition-colors">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow-sm border border-gray-100 p-8 max-w-4xl">
    <form action="<?= $item ? '/admin/professionals/update' : '/admin/professionals/store' ?>" method="POST" class="space-y-8">
        <?php if ($item): ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nome Artístico / Profissional *</label>
                <input type="text" name="name" required value="<?= htmlspecialchars($item['name'] ?? '') ?>" 
                       placeholder="Ex: Rodrigo Barber"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none font-bold">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Especialidade Principal</label>
                <input type="text" name="specialty" value="<?= htmlspecialchars($item['specialty'] ?? '') ?>" 
                       placeholder="Ex: Barbeiro, Esteticista..."
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Comissão Geral (%) *</label>
                <input type="number" step="0.1" name="commission_percentage" required value="<?= $item['commission_percentage'] ?? 0 ?>" 
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>
        </div>

        <div class="pt-6 border-t border-gray-50 flex justify-end">
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-12 py-4 rounded-none shadow-sm text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-[0.98]">
                <?= $item ? 'Atualizar Perfil' : 'Cadastrar Membro' ?>
            </button>
        </div>
    </form>
</div>
