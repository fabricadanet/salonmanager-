<section class="py-24 bg-noir px-6 lg:px-12">
    <div class="max-w-7xl mx-auto">
        <div class="mb-24 space-y-4 max-w-2xl reveal">
            <span class="text-[10px] uppercase tracking-[0.5em] text-gold font-bold">L'Art de la Beauté</span>
            <h1 class="text-6xl md:text-7xl font-serif italic text-white leading-tight">Nossos Serviços.</h1>
            <p class="text-gray-500 font-light text-lg italic">Uma curadoria de tratamentos e cuidados desenhados para elevar a sua essência e proporcionar momentos únicos de bem-estar.</p>
        </div>

        <div class="grid grid-cols-1 gap-12 reveal">
            <?php foreach ($services as $index => $service): ?>
                <div class="group py-12 border-b border-white/10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center transition-all duration-700 hover:bg-white/[0.02]">
                    <div class="lg:col-span-1">
                        <span class="text-6xl font-serif italic text-white/10 group-hover:text-gold/20 transition-colors"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></span>
                    </div>

                    <div class="lg:col-span-3">
                        <div class="aspect-square bg-noir-light border border-white/5 overflow-hidden group-hover:border-gold/30 transition-colors shadow-2xl">
                            <?php if(!empty($service['image'])): ?>
                                <img src="<?= $service['image'] ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center opacity-20">
                                     <span class="text-[10px] uppercase tracking-widest italic">Portrait Ritual</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="lg:col-span-5 space-y-4">
                        <h3 class="text-3xl font-serif italic text-white group-hover:text-gold transition-colors"><?= htmlspecialchars($service['name']) ?></h3>
                        <p class="text-gray-500 font-light text-sm leading-relaxed max-w-md italic"><?= htmlspecialchars($service['description']) ?></p>
                        <div class="flex items-center text-[10px] uppercase tracking-widest text-gold/40 group-hover:text-gold/80 transition-colors">
                            <span class="font-bold underline underline-offset-4 decoration-gold/20"><?= $service['duration'] ?> MINUTOS DE RITUAL</span>
                        </div>
                    </div>

                    <div class="lg:col-span-3 text-left lg:text-right">
                        <span class="block text-[10px] uppercase tracking-[0.3em] text-gold/30 mb-2 font-bold italic">Investimento</span>
                        <span class="text-5xl font-serif italic text-white group-hover:tracking-wider transition-all duration-700">R$ <?= number_format($service['price'], 2, ',', '.') ?></span>
                        <div class="mt-6">
                            <a href="/agendar" class="inline-block px-8 py-4 border border-gold/20 text-[10px] uppercase tracking-widest text-gold hover:bg-gold hover:text-noir transition-all">Agendar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($services)): ?>
            <div class="py-24 text-center border-t border-white/5">
                <p class="text-gray-600 uppercase tracking-widest text-xs italic">Nenhum serviço disponível no catálogo atualmente.</p>
            </div>
        <?php endif; ?>

        <div class="mt-40 flex flex-col items-center justify-center space-y-12 reveal">
            <h2 class="text-5xl font-serif italic text-white text-center leading-tight shadow-gold/10 drop-shadow-2xl">Transforme seu dia.<br>Reserve sua experiência hoje.</h2>
            <a href="/agendar" class="group relative px-20 py-8 overflow-hidden bg-gold text-noir font-black uppercase tracking-[0.4em] text-xs transition-all hover:scale-105 shadow-[0_20px_50px_rgba(212,175,55,0.3)]">
                Reservar Agora
            </a>
        </div>
    </div>
</section>
