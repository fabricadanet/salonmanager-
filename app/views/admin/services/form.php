<div class="mb-8 flex justify-between items-end border-b border-gray-100 pb-6">
    <div>
        <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase"><?= $item ? 'Editar Serviço' : 'Novo Serviço' ?></h2>
        <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1">Configuração de Portfólio</p>
    </div>
    <a href="/admin/services" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-slate-900 transition-colors">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow-sm border border-gray-100 p-8 max-w-5xl">
    <form action="<?= $item ? '/admin/services/update' : '/admin/services/store' ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
        <?php if ($item): ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Sidebar with Image -->
            <div class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Imagem do Serviço</label>
                    <div class="aspect-square bg-gray-50 border-2 border-dashed border-gray-200 flex flex-col items-center justify-center relative overflow-hidden group">
                        <?php if($item && $item['image']): ?>
                            <img src="<?= $item['image'] ?>" class="absolute inset-0 w-full h-full object-cover">
                        <?php endif; ?>
                        <div class="text-center p-4 relative z-10 bg-white/80 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity">
                            <p class="text-[8px] font-bold uppercase tracking-widest text-slate-900">Clique para Alterar</p>
                        </div>
                        <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Ou URL da Imagem</label>
                    <input type="text" name="image_url" placeholder="https://..."
                           class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
                </div>
            </div>

            <!-- Content Area -->
            <div class="md:col-span-2 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nome do Serviço *</label>
                        <input type="text" name="name" required value="<?= htmlspecialchars($item['name'] ?? '') ?>" 
                               placeholder="Ex: Corte Feminino com Escova"
                               class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none font-bold">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Preço (R$) *</label>
                        <input type="number" step="0.01" name="price" required value="<?= $item['price'] ?? '' ?>" 
                               class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Duração (minutos) *</label>
                        <input type="number" name="duration" required value="<?= $item['duration'] ?? '' ?>" 
                               class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Descrição Detalhada</label>
                        <textarea name="description" rows="5" 
                                  placeholder="Descreva o que está incluído no serviço..."
                                  class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none leading-relaxed"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-50 flex justify-end">
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-12 py-4 rounded-none shadow-sm text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-[0.98]">
                <?= $item ? 'Atualizar Serviço' : 'Publicar Serviço' ?>
            </button>
        </div>
    </form>
</div>
