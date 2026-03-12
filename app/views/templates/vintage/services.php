<section class="py-32 px-6 vintage-gradient min-h-[50vh] flex flex-col justify-center border-b border-amber-100">
    <div class="max-w-4xl mx-auto text-center reveal">
        <span class="text-[10px] uppercase tracking-[0.6em] font-black text-amber-700 block mb-10">La Boutique de Beauté</span>
        <h1 class="text-6xl md:text-8xl font-serif italic text-amber-900 leading-none mb-8">Nossos Rituais.</h1>
        <p class="text-lg font-serif italic text-amber-800/60 max-w-2xl mx-auto italic">Uma seleção cuidadosa de tratamentos para elevar sua beleza natural sob o cuidado da tradição.</p>
    </div>
</section>

<section class="py-32 px-6 bg-white relative">
    <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-[#f7f1e3]/30 to-transparent"></div>
    <div class="max-w-6xl mx-auto relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20 reveal">
            <?php foreach ($services as $index => $service): ?>
            <div class="flex flex-col gap-8 group">
                <div class="aspect-[4/3] vintage-border p-2 bg-white relative overflow-hidden shadow-xl group-hover:shadow-2xl transition-all duration-700">
                    <?php if(!empty($service['image'])): ?>
                        <img src="<?= $service['image'] ?>" class="w-full h-full object-cover sepia-[0.3] group-hover:sepia-0 group-hover:scale-105 transition-all duration-1000">
                    <?php else: ?>
                        <div class="w-full h-full bg-amber-50 flex items-center justify-center italic">
                            <span class="text-xs font-serif text-amber-200 uppercase tracking-widest">Ritual Frame</span>
                        </div>
                    <?php endif; ?>
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm border border-amber-100 px-4 py-1 rounded-full text-[10px] font-black text-amber-900 shadow-sm italic">
                        <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-baseline border-b border-amber-100 pb-4">
                        <h3 class="text-3xl font-serif font-bold text-amber-950 uppercase tracking-tight group-hover:text-amber-700 transition-colors italic"><?= htmlspecialchars($service['name']) ?></h3>
                        <span class="text-xl font-serif italic text-amber-900">R$ <?= number_format($service['price'], 2, ',', '.') ?></span>
                    </div>
                    <p class="text-base font-serif italic text-amber-800/70 leading-relaxed italic"><?= htmlspecialchars($service['description']) ?></p>
                    <div class="flex justify-between items-center">
                        <div class="inline-block text-[10px] font-black uppercase tracking-[0.4em] text-amber-700 py-2 px-4 bg-amber-50 rounded-full italic">
                            Duração: <?= $service['duration'] ?> MIN
                        </div>
                        <a href="/agendar" class="text-[10px] font-black uppercase tracking-[0.3em] text-amber-900 hover:text-amber-600 transition-all italic border-b border-amber-900/10">Reservar &rarr;</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
