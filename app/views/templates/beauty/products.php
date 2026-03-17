<section class="min-h-screen bg-white pt-32 pb-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div>
                <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gold block mb-3">Home Care</span>
                <h1 class="text-5xl font-serif italic text-primary uppercase">
                    Nossos Produtos
                </h1>
            </div>
            <p class="text-slate-400 text-sm max-w-xs uppercase tracking-widest font-bold leading-relaxed">
                Leve a experiência da Curly Beauty para sua casa.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <?php foreach ($products as $p): ?>
                <div class="group">
                    <div class="aspect-[3/4] bg-soft rounded-[2.5rem] overflow-hidden mb-6 relative shadow-sm group-hover:shadow-2xl transition-all duration-700">
                        <img src="<?= $p['image'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="<?= $p['name'] ?>">
                        <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-6 text-center">
                            <a href="https://wa.me/<?= preg_replace('/\D/','',$whatsapp) ?>?text=Olá! Gostaria de comprar o produto <?= urlencode($p['name']) ?>" 
                               target="_blank"
                               class="bg-gold text-white px-6 py-4 text-[10px] font-black uppercase tracking-widest shadow-xl hover:bg-primary transition-all">
                                Comprar Agora
                            </a>
                        </div>
                    </div>

                    <div class="px-4 text-center">
                        <h3 class="text-lg font-serif italic text-primary mb-2"><?= htmlspecialchars($p['name']) ?></h3>
                        <p class="text-gold font-bold tracking-widest text-sm">
                            R$ <?= number_format($p['price'], 2, ',', '.') ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>