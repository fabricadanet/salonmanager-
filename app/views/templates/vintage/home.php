<?php 
$heroImage = $data['hero']['image'] ?? 'https://images.unsplash.com/photo-1552664688-cf412ec27db2?auto=format&fit=crop&q=80&w=1000';
?>
<section class="relative min-h-screen flex items-center justify-center overflow-hidden vintage-gradient">
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');"></div>
    
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto reveal">
        <span class="text-[10px] uppercase tracking-[0.6em] font-black text-amber-700 block mb-10"><?= htmlspecialchars($data['hero']['subtitle'] ?? 'Maison de Beauté') ?></span>
        <h1 class="text-7xl md:text-9xl font-serif italic text-amber-900 leading-none mb-10">
            <?= nl2br(htmlspecialchars($data['hero']['title'] ?? "A Arte da\nBeleza.")) ?>
        </h1>
        <p class="text-xl font-serif italic text-amber-800/60 max-w-2xl mx-auto mb-12 leading-relaxed">
            <?= htmlspecialchars($data['hero']['content'] ?? 'Onde o tempo desacelera e sua beleza floresce sob o cuidado da tradição e excelência.') ?>
        </p>
        <div class="flex flex-col sm:flex-row gap-8 justify-center items-center">
            <a href="/agendar" class="bg-amber-900 text-[#fcfaf7] px-12 py-5 font-bold uppercase tracking-[0.3em] text-[10px] shadow-2xl hover:bg-amber-800 transition-all">Marcar Encontro</a>
            <a href="/servicos" class="text-amber-900 text-[10px] font-black uppercase tracking-[0.4em] border-b-2 border-amber-900/20 pb-1 hover:border-amber-900 transition-all">Nossos Rituais</a>
        </div>
    </div>
</section>

<section class="py-32 px-6 bg-white relative">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
        <div class="reveal order-2 lg:order-1">
            <div class="vintage-border p-3 inline-block shadow-2xl relative">
                <div class="absolute inset-0 bg-amber-900/5 -m-2 -z-10 rotate-2"></div>
                <div class="aspect-[4/5] bg-amber-50 w-full md:w-[400px] overflow-hidden">
                    <img src="<?= $heroImage ?>" class="w-full h-full object-cover sepia-[0.3] group-hover:sepia-0 transition-all duration-1000">
                </div>
            </div>
        </div>
        <div class="reveal order-1 lg:order-2 space-y-8">
            <h2 class="text-5xl font-serif italic text-amber-950 leading-tight"><?= htmlspecialchars($data['about']['title'] ?? 'Nossa História, Seu Legado.') ?></h2>
            <div class="h-px bg-amber-200 w-24"></div>
            <p class="text-lg font-serif italic text-amber-900/70 leading-relaxed first-letter:text-5xl first-letter:font-bold first-letter:mr-3 first-letter:float-left first-letter:text-amber-900">
                <?= nl2br(htmlspecialchars($data['about']['content'] ?? 'Há anos nos dedicamos a criar um refúgio de sofisticação onde cada cliente é tratado como uma obra de arte única.')) ?>
            </p>
        </div>
    </div>
</section>

<section class="py-32 px-6 bg-[#fcfaf7]">
    <div class="max-w-5xl mx-auto text-center mb-24 reveal">
        <h3 class="text-4xl font-serif italic text-amber-900 mb-6"><?= htmlspecialchars($services_h['subtitle'] ?? 'Rituais em Destaque') ?></h3>
        <p class="text-[10px] uppercase tracking-[0.4em] text-amber-700 font-black"><?= htmlspecialchars($services_h['title'] ?? 'Uma Experiência Atemporal') ?></p>
    </div>
    
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-16 reveal">
        <?php foreach ($services as $service): ?>
        <div class="text-center group">
            <div class="mb-10 relative flex justify-center">
                <div class="w-full aspect-square vintage-border p-2 bg-white overflow-hidden shadow-xl group-hover:scale-105 transition-all duration-700">
                    <?php if(!empty($service['image'])): ?>
                        <img src="<?= $service['image'] ?>" class="w-full h-full object-cover sepia-[0.2] group-hover:sepia-0 transition-all duration-700">
                    <?php else: ?>
                        <div class="w-full h-full bg-amber-50 flex items-center justify-center">
                            <span class="text-xs font-serif italic text-amber-200">Ritual Sculpt</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="absolute -bottom-4 bg-white vintage-border px-6 py-1 text-[10px] font-bold uppercase tracking-widest text-amber-700 shadow-sm group-hover:bg-amber-900 group-hover:text-white transition-colors">RS</div>
            </div>
            <h4 class="text-2xl font-serif font-bold text-amber-900 tracking-tight mb-4"><?= htmlspecialchars($service['name']) ?></h4>
            <p class="text-sm font-serif italic text-amber-800/60 mb-6 line-clamp-2"><?= htmlspecialchars($service['description']) ?></p>
            <div class="text-[10px] uppercase font-black tracking-[0.3em] text-amber-900 border-t border-amber-100 pt-4 flex justify-between items-center">
                <span><?= $service['duration'] ?> MIN</span>
                <span>R$ <?= number_format($service['price'], 2, ',', '.') ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-20 reveal">
        <a href="/servicos" class="bg-transparent border border-amber-900/30 text-amber-900 px-10 py-4 text-[10px] font-black uppercase tracking-[0.4em] hover:bg-amber-900 hover:text-white transition-all">Ver Todos os Rituais</a>
    </div>
</section>
