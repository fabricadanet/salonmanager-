<section class="max-w-6xl mx-auto px-6 py-20 lg:py-32">
    <div class="mb-20 reveal">
        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-indigo-500 block mb-4 italic">Full Catalog</span>
        <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 leading-none mb-6">SERVIÇOS.</h1>
        <p class="text-slate-500 font-medium text-lg max-w-2xl italic">Precisão cirúrgica e design minimalista em cada procedimento.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 reveal">
        <?php foreach ($services as $service): ?>
        <div class="group">
            <div class="aspect-[16/10] bg-slate-100 rounded-3xl mb-8 overflow-hidden relative shadow-sm hover:shadow-2xl transition-all duration-700">
                <?php if(!empty($service['image'])): ?>
                    <img src="<?= $service['image'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                <?php else: ?>
                    <div class="w-full h-full bg-slate-50 flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                <?php endif; ?>
                <div class="absolute inset-0 bg-slate-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                     <a href="/agendar" class="bg-white text-slate-900 px-6 py-3 text-[10px] font-black uppercase tracking-widest rounded-full opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-500">Reservar Agora</a>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="flex justify-between items-start">
                    <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tighter group-hover:text-indigo-600 transition-colors"><?= htmlspecialchars($service['name']) ?></h3>
                </div>
                <p class="text-slate-500 text-sm font-medium leading-relaxed italic"><?= htmlspecialchars($service['description']) ?></p>
                <div class="flex justify-between items-center py-4 border-t border-slate-50">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-300"><?= $service['duration'] ?> MIN</span>
                    <span class="text-lg font-black text-slate-900">R$ <?= number_format($service['price'], 2, ',', '.') ?></span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
