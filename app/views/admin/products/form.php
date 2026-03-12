<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tighter"><?= $item ? 'Editar Produto' : 'Novo Produto' ?></h2>
    <a href="/admin/products" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 hover:text-indigo-900 mt-2 flex items-center">
        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
        Voltar para a lista
    </a>
</div>

<div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 max-w-4xl">
    <form action="<?= $item ? '/admin/products/update' : '/admin/products/store' ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
        <?php if ($item): ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Image Upload Column -->
            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Imagem do Produto</label>
                <div class="aspect-square bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden shadow-inner group relative">
                    <?php if(!empty($item['image'])): ?>
                        <img src="<?= $item['image'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-[10px] font-bold uppercase">Trocar Imagem</div>
                    <?php else: ?>
                        <div class="text-center p-4">
                            <svg class="w-10 h-10 text-gray-200 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Sem Imagem</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="space-y-2">
                    <input type="file" name="image" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <input type="text" name="image_url" placeholder="Ou cole a URL..." value="<?= !empty($item['image']) && !str_starts_with($item['image'], '/uploads/') ? htmlspecialchars($item['image']) : '' ?>" class="w-full bg-gray-50 border-gray-200 rounded-lg text-[10px] p-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <!-- Content Column -->
            <div class="md:col-span-2 space-y-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Nome do Produto *</label>
                    <input type="text" name="name" required value="<?= htmlspecialchars($item['name'] ?? '') ?>" 
                           class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Descrição</label>
                    <textarea name="description" rows="3" 
                              class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-medium focus:ring-indigo-500 focus:border-indigo-500"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Preço (R$) *</label>
                        <input type="number" step="0.01" name="price" required value="<?= $item['price'] ?? '' ?>" 
                               class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50/50 rounded-2xl p-6 border border-gray-100 grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div class="space-y-4">
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Estoque e Logística</h4>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-700">Mínimo Ideal (Alerta) *</label>
                    <input type="number" name="min_stock_level" required min="0" value="<?= $item['min_stock_level'] ?? '5' ?>" 
                           class="w-full bg-white border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
            <div class="space-y-4">
                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Financeiro</h4>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-700">Comissão do Profissional (%)</label>
                    <input type="number" step="0.01" name="commission_percentage" min="0" max="100" value="<?= $item['commission_percentage'] ?? '0' ?>" 
                           class="w-full bg-white border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-indigo-600 shadow-lg text-white px-10 py-4 rounded-xl hover:bg-indigo-700 hover:scale-105 active:scale-95 transition-all duration-300 font-black text-xs uppercase tracking-widest">
                Salvar Produto
            </button>
        </div>
    </form>
</div>
