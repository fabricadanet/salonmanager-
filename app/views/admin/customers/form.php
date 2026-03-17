<div class="mb-8 flex justify-between items-end border-b border-gray-100 pb-6">
    <div>
        <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase"><?= $customer ? 'Editar Cliente' : 'Novo Cliente' ?></h2>
        <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1">Informações Cadastrais</p>
    </div>
    <a href="/admin/customers" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-slate-900 transition-colors">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow-sm border border-gray-100 p-8 max-w-4xl">
    <form action="<?= $customer ? '/admin/customers/update' : '/admin/customers/store' ?>" method="POST" class="space-y-8">
        <?php if ($customer): ?>
            <input type="hidden" name="id" value="<?= $customer['id'] ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nome Completo *</label>
                <input type="text" name="name" required value="<?= htmlspecialchars($customer['name'] ?? '') ?>" 
                       placeholder="Ex: Maria Oliveira"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Telefone / WhatsApp</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($customer['phone'] ?? '') ?>" 
                       placeholder="(00) 00000-0000"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Endereço de E-mail</label>
                <input type="email" name="email" value="<?= htmlspecialchars($customer['email'] ?? '') ?>" 
                       placeholder="cliente@exemplo.com"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Observações Internas</label>
                <textarea name="notes" rows="4" 
                          placeholder="Preferências, alergias ou histórico relevante..."
                          class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none"><?= htmlspecialchars($customer['notes'] ?? '') ?></textarea>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-50 flex justify-end">
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-12 py-4 rounded-none shadow-sm text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-[0.98]">
                <?= $customer ? 'Atualizar Cliente' : 'Finalizar Cadastro' ?>
            </button>
        </div>
    </form>
</div>
