<section class="min-h-screen bg-soft pt-32 pb-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-16">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gold block mb-3">Menu de Beleza</span>
            <h1 class="text-5xl font-serif italic text-primary uppercase">
                Nossos Serviços
            </h1>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            <?php foreach ($services as $s): ?>
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-2xl transition-all duration-500 border border-white group relative overflow-hidden h-full flex flex-col">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-gold/5 rounded-full group-hover:bg-gold/10 transition-colors"></div>
                    
                    <div class="relative z-10 flex-grow">
                        <h3 class="text-2xl font-serif italic text-primary mb-4"><?= htmlspecialchars($s['name']) ?></h3>

                        <p class="text-sm text-slate-400 leading-relaxed mb-8">
                            <?= htmlspecialchars($s['description'] ?? 'Técnica exclusiva para realçar sua beleza natural.') ?>
                        </p>
                    </div>

                    <div class="relative z-10 pt-8 border-t border-soft flex items-end justify-between mt-auto">
                        <div>
                            <span class="block text-[10px] font-black uppercase tracking-widest text-slate-300 mb-1">Valor do investimento</span>
                            <p class="text-2xl font-serif italic text-primary">
                                R$ <?= number_format($s['price'], 2, ',', '.') ?>
                            </p>
                        </div>
                        
                        <a href="/agendar?service_id=<?= $s['id'] ?>" class="h-14 w-14 bg-gold text-white flex items-center justify-center rounded-2xl hover:bg-primary transition-all shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>