<?php 
$heroImage = $data['hero']['image'] ?? 'https://images.unsplash.com/photo-1562322140-8baeececf3df?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80';
?>
<!-- Hero Section (Massive Typographic) -->
<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-noir pt-20">
    <!-- Background Large Text -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none">
        <span class="text-[20vw] font-serif italic text-white/[0.03] leading-none uppercase tracking-tighter"><?= htmlspecialchars($hero['subtitle'] ?? 'Elegância') ?></span>
    </div>
    
    <!-- Hero Content -->
    <div class="relative max-w-7xl mx-auto px-6 lg:px-12 z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7 space-y-8 reveal">
            <div class="flex items-center space-x-4">
                <div class="h-[1px] w-12 bg-gold"></div>
                <span class="text-xs uppercase tracking-[0.4em] text-gold font-bold"><?= htmlspecialchars($hero['subtitle'] ?? 'Premium Experience') ?></span>
            </div>
            <h1 class="text-6xl md:text-8xl lg:text-9xl font-serif leading-[1] italic text-balanced">
                <?= htmlspecialchars($data['hero']['title'] ?? 'A arte da beleza redefine você.') ?>
            </h1>
            <p class="max-w-md text-lg text-gray-400 font-light leading-relaxed">
                <?= htmlspecialchars($data['hero']['content'] ?? 'Transformamos a sua visão em realidade através da excelência técnica e sensibilidade artística.') ?>
            </p>
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-8 pt-6">
                <a href="/agendar" class="group relative px-10 py-5 overflow-hidden bg-gold text-noir font-bold uppercase tracking-[0.2em] text-xs transition-transform hover:scale-105 shadow-[0_10px_30px_rgba(212,175,55,0.2)]">
                    Reservar Agora
                </a>
                <a href="/servicos" class="group flex items-center space-x-3 text-xs uppercase tracking-[0.3em] font-medium hover:text-gold transition-colors">
                    <span>Nossos Serviços</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
        
        <!-- Hero Visual (Asymmetric) -->
        <div class="lg:col-span-5 relative mt-12 lg:mt-0">
            <div class="relative w-full aspect-[4/5] border border-white/10 group shadow-2xl">
                <!-- Image Container with Overflow Hidden specifically for the zoom effect -->
                <div class="absolute inset-0 overflow-hidden">
                    <img class="w-full h-full object-cover grayscale brightness-75 transition-all duration-1000 group-hover:scale-110 group-hover:grayscale-0" 
                         src="<?= $heroImage ?>" 
                         alt="Salon Specialist">
                    <div class="absolute inset-0 bg-gold/10 mix-blend-overlay"></div>
                </div>

                <!-- Floating Card (Moved outside overflow-hidden but inside the relative parent) -->
                <div class="absolute bottom-10 -left-10 bg-noir p-6 border border-gold/30 backdrop-blur-md max-w-[200px] hidden md:block z-20">
                    <span class="block text-3xl font-serif italic text-gold mb-2">+10k</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Transformações realizadas com perfeição</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section (Asymmetric Layering) -->
<?php if (!empty($data['about']['title']) || !empty($data['about']['content'])): ?>
<section class="py-32 bg-noir relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
        <div class="relative order-2 lg:order-1 reveal">
            <div class="bg-noir-light border border-white/5 p-4 relative z-10 w-4/5 shadow-2xl">
                <img class="w-full grayscale hover:grayscale-0 transition-all duration-700" 
                     src="https://images.unsplash.com/photo-1522337660859-02fbefca4702?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" 
                     alt="Our Space">
            </div>
            <div class="absolute -bottom-12 -right-12 w-3/4 border border-gold/20 aspect-video z-0 bg-gold/5 hidden md:block opacity-30"></div>
        </div>
        
        <div class="space-y-8 order-1 lg:order-2 reveal">
            <span class="text-[10px] uppercase tracking-[0.5em] text-gold font-bold">Inspirando Confiança</span>
            <h2 class="text-5xl md:text-6xl font-serif italic leading-tight">
                <?= htmlspecialchars($data['about']['title'] ?? 'A Essência de Nossa Arte') ?>
            </h2>
            <div class="text-gray-400 font-light leading-relaxed space-y-4">
                <?= nl2br(htmlspecialchars($data['about']['content'] ?? '')) ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Services Highlight (Fragmented Grid) -->
<section class="py-32 bg-noir-light border-y border-white/5">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8 reveal">
            <div class="max-w-lg space-y-4">
                <span class="text-[10px] uppercase tracking-[0.5em] text-gold font-bold"><?= htmlspecialchars($services_h['title'] ?? 'Curadoria Especializada') ?></span>
                <h2 class="text-5xl font-serif italic italic"><?= htmlspecialchars($services_h['subtitle'] ?? 'Serviços que contam uma história.') ?></h2>
            </div>
            <a href="/servicos" class="text-xs uppercase tracking-[0.3em] font-medium border-b border-gold/30 pb-2 hover:text-gold hover:border-gold transition-all">Ver catálogo completo</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-0 border-l border-t border-white/5 reveal">
            <?php foreach ($services as $service): ?>
                <div class="group relative bg-noir p-0 border-r border-b border-white/5 overflow-hidden transition-all duration-500 hover:bg-noir-lighter">
                    <div class="aspect-video relative overflow-hidden">
                        <?php if(!empty($service['image'])): ?>
                            <img src="<?= $service['image'] ?>" class="w-full h-full object-cover grayscale brightness-50 group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000">
                        <?php else: ?>
                            <div class="w-full h-full bg-noir-light flex items-center justify-center">
                                <span class="text-[10px] uppercase tracking-widest text-gray-800">No Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-noir/40 group-hover:bg-noir/10 transition-colors"></div>
                    </div>
                    <div class="p-10 relative z-10 space-y-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-2xl font-serif italic group-hover:text-gold transition-colors"><?= htmlspecialchars($service['name']) ?></h3>
                            <span class="text-xs text-gold/50 font-bold"><?= $service['duration'] ?> MIN</span>
                        </div>
                        <p class="text-sm text-gray-500 font-light leading-relaxed line-clamp-2"><?= htmlspecialchars($service['description']) ?></p>
                        <div class="flex justify-between items-center pt-4">
                            <span class="text-xl font-light">R$ <?= number_format($service['price'], 2, ',', '.') ?></span>
                            <a href="/agendar" class="opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-500 text-[10px] uppercase tracking-[0.2em] font-bold text-gold">Agendar &rarr;</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Products Display (Extreme Asymmetry) -->
<section class="py-32 bg-noir">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col lg:flex-row gap-20">
        <div class="lg:w-1/3 space-y-8 sticky top-32 self-start reveal">
            <span class="text-[10px] uppercase tracking-[0.5em] text-gold font-bold"><?= htmlspecialchars($products_h['title'] ?? "Selection D'Excellence") ?></span>
            <h2 class="text-5xl font-serif italic leading-tight text-white"><?= htmlspecialchars($products_h['subtitle'] ?? 'Produtos de luxo para seu ritual diário.') ?></h2>
            <p class="text-sm text-gray-500 font-light leading-relaxed">
                <?= htmlspecialchars($products_h['content'] ?? 'Selecionamos apenas as marcas mais prestigiadas que compartilham nosso compromisso com a integridade capilar e resultados sublimes.') ?>
            </p>
            <div class="pt-8">
                <a href="/produtos" class="px-8 py-4 border border-white/10 text-xs uppercase tracking-[0.2em] hover:bg-white hover:text-noir transition-all">Ver todos os produtos</a>
            </div>
        </div>
        
        <div class="lg:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-12 reveal">
            <?php foreach ($products as $product): ?>
                <div class="group space-y-6">
                    <div class="relative aspect-[3/4] overflow-hidden bg-noir-light border border-white/5 shadow-2xl">
                        <?php if ($product['image']): ?>
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-1000">
                        <?php else: ?>
                            <div class="w-full h-full bg-noir-lighter flex items-center justify-center">
                                <span class="text-[10px] uppercase tracking-[0.3em] text-gray-700 italic">Portrait Boutique</span>
                            </div>
                        <?php endif; ?>
                        <div class="absolute bottom-4 right-4 bg-noir/80 backdrop-blur-sm p-4 border border-gold/10 opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-sm font-bold text-gold">R$ <?= number_format($product['price'], 2, ',', '.') ?></span>
                        </div>
                    </div>
                    <div class="text-center group-hover:text-gold transition-colors">
                        <h3 class="text-xl font-serif italic"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-600 mt-2"><?= htmlspecialchars(substr($product['description'], 0, 80)) ?>...</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-40 bg-noir-light relative overflow-hidden">
    <div class="absolute inset-0 flex items-center justify-center opacity-[0.02] pointer-events-none">
        <span class="text-[30vw] font-serif italic text-white leading-none uppercase"><?= htmlspecialchars($cta['subtitle'] ?? 'Experience') ?></span>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 text-center space-y-12 reveal">
        <h2 class="text-5xl md:text-7xl font-serif italic leading-tight"><?= htmlspecialchars($cta['title'] ?? 'Pronta para viver a sua melhor versão?') ?></h2>
        <div class="flex flex-col md:flex-row justify-center items-center space-y-6 md:space-y-0 md:space-x-12">
            <a href="/agendar" class="px-16 py-6 bg-gold text-noir font-bold uppercase tracking-[0.3em] text-xs hover:bg-gold-light transition-all shadow-2xl">
                <?= htmlspecialchars($cta['content'] ?? 'Agendar Horário') ?>
            </a>
            <a href="/contato" class="text-xs uppercase tracking-[0.3em] border-b border-gold/50 pb-2 hover:text-gold transition-all italic">
                Falar com especialista
            </a>
        </div>
    </div>
</section>
