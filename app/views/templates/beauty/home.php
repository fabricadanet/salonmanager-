<?php 
$heroImage = $data['hero']['image'] ?? 'https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&q=80&w=1000';
?>

<!-- HERO SECTION -->
<section class="relative w-full overflow-hidden flex items-center" style="height: 100vh; min-height: 100vh;">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="<?= $heroImage ?>" class="w-full h-full object-cover object-center" alt="Hero Background">
        <!-- Overlay for readability -->
        <div class="absolute inset-0 bg-white/70 backdrop-blur-[2px]"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10 w-full">
        <div class="max-w-3xl space-y-8 animate-fade-in-up">
            <div class="space-y-4">
                <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gold block">Elegância & Bem-Estar</span>
                <h1 class="text-7xl md:text-9xl font-serif italic text-primary leading-[0.9]">
                    <?= nl2br(htmlspecialchars($data['hero']['title'] ?? 'Factory Salon')) ?>
                </h1>
            </div>
            
            <p class="text-slate-600 text-lg md:text-2xl leading-relaxed max-w-xl font-medium">
                <?= htmlspecialchars($data['hero']['content'] ?? 'Você em primeiro lugar.') ?>
            </p>
            
            <div class="flex flex-wrap gap-6 pt-6">
                <a href="/agendar" class="bg-gold text-white border border-gold px-12 py-6 text-[11px] font-black uppercase tracking-[0.3em] shadow-2xl hover:bg-slate-800 transition-all">
                    Agendar Agora
                </a>
                <a href="/servicos" class="bg-white/40 backdrop-blur-md text-primary border border-primary/10 px-12 py-6 text-[11px] font-black uppercase tracking-[0.3em] hover:bg-white transition-all">
                    Ver Serviços
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 animate-bounce opacity-40">
        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
    </div>
</section>

<!-- SERVICES PREVIEW -->
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center mb-16">
        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gold mb-4 block">Nossa Expertise</span>
        <h2 class="text-4xl font-serif italic text-primary">Serviços Exclusivos</h2>
    </div>
    
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8">
        <?php foreach (array_slice($services, 0, 3) as $s): ?>
        <div class="group bg-white p-10 rounded-[2rem] hover:bg-white hover:shadow-2xl transition-all duration-500 cursor-default border border-gold/5">
            <div class="h-12 w-12 bg-soft rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:bg-gold transition-colors">
                <svg class="w-6 h-6 text-gold group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7 7m-7 0l1.5-1.5M5 20v-5a2 2 0 012-2h9a2 2 0 012 2v5m-4.5-9.25V6a2 2 0 00-2-2 2 2 0 00-2 2v2.75" /></svg>
            </div>
            <h3 class="text-xl font-serif italic mb-4"><?= htmlspecialchars($s['name']) ?></h3>
            <p class="text-sm opacity-60 leading-relaxed mb-6"><?= htmlspecialchars(mb_substr($s['description'], 0, 80)) ?>...</p>
            <div class="text-xs font-black uppercase tracking-widest pt-4 border-t border-black/5 group-hover:border-white/10">
                A partir de <span class="text-lg italic ml-2">R$ <?= number_format($s['price'], 2, ',', '.') ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ABOUT SECTION -->
<section class="py-24 bg-soft">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-20 items-center">
        <div class="grid grid-cols-2 gap-4">
            <div class="space-y-4">
                <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?auto=format&fit=crop&q=80&w=500" class="rounded-3xl shadow-lg" alt="Salon 1">
                <img src="https://images.unsplash.com/photo-1562322140-8baeececf3df?auto=format&fit=crop&q=80&w=500" class="rounded-3xl shadow-lg" alt="Salon 2">
            </div>
            <div class="pt-12">
                <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&q=80&w=500" class="rounded-3xl shadow-lg" alt="Salon 3">
            </div>
        </div>
        <div class="space-y-8">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gold block">Sobre Nós</span>
            <h2 class="text-5xl font-serif italic text-primary leading-tight">
                <?= $data['about']['title'] ?? 'Paixão por transformar e realçar sua autoestima.' ?>
            </h2>
            <div class="text-slate-500 leading-relaxed space-y-4 text-lg">
                <?= nl2br(htmlspecialchars($data['about']['content'] ?? 'Com anos de experiência no mercado de beleza, unimos técnicas tradicionais e inovação para entregar resultados impecáveis.')) ?>
            </div>
            <div class="pt-6">
                <a href="/contato" class="inline-flex items-center gap-4 text-xs font-black uppercase tracking-[0.2em] text-gold group">
                    Conheça nossa história
                    <span class="h-10 w-10 rounded-full border border-gold flex items-center justify-center group-hover:bg-gold group-hover:text-white transition-all text-gold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>