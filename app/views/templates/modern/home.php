<?php 
$heroImage = $data['hero']['image'] ?? 'https://images.unsplash.com/photo-1522337660859-02fbefca4702?auto=format&fit=crop&q=80&w=1000';
?>
<!-- Split Hero Section -->
<section class="max-w-6xl mx-auto px-6 py-20 lg:py-32">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="reveal">
            <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter text-slate-900 leading-[0.9] mb-8 uppercase">
                <?= nl2br(htmlspecialchars($data['hero']['title'] ?? "Sua Melhor\nVersão.")) ?>
            </h1>
            <p class="text-lg text-slate-500 max-w-xl mb-10 font-medium">
                <?= htmlspecialchars($data['hero']['content'] ?? 'Estética avançada e design de beleza com precisão minimalista.') ?>
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/agendar" class="bg-slate-900 text-white px-10 py-4 font-bold uppercase tracking-widest text-sm hover:scale-105 transition-transform text-center">Reservar Horário</a>
                <a href="/servicos" class="border-2 border-slate-900 text-slate-900 px-10 py-4 font-bold uppercase tracking-widest text-sm hover:bg-slate-900 hover:text-white transition-all text-center">Ver Serviços</a>
            </div>
        </div>
        
        <div class="reveal relative">
            <div class="aspect-[4/5] bg-slate-100 rounded-3xl overflow-hidden shadow-2xl relative group">
                <img src="<?= $heroImage ?>" alt="Salon Experience" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/20 to-transparent"></div>
            </div>
            <!-- Floating badge -->
            <div class="absolute -bottom-8 -left-8 bg-white p-6 rounded-2xl shadow-xl border border-slate-100 hidden md:block">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-1">Satisfação</p>
                <p class="text-2xl font-black text-slate-900 uppercase tracking-tighter">100% Premium</p>
            </div>
        </div>
    </div>
</section>

<!-- Philosophy Section -->
<section class="bg-slate-50 py-32 px-6 border-y border-slate-100">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        <div class="reveal order-2 lg:order-1">
            <div class="bg-white p-3 rounded-3xl shadow-2xl rotate-3">
                <div class="aspect-[4/3] bg-slate-200 rounded-2xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
                </div>
            </div>
        </div>
        <div class="reveal order-1 lg:order-2">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-indigo-500 block mb-6">Nossa Filosofia</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-8 uppercase tracking-tighter leading-none italic"><?= htmlspecialchars($data['about']['title'] ?? 'Minimalismo de Ponta') ?></h2>
            <div class="prose prose-slate font-medium text-slate-600 leading-relaxed text-lg italic">
                <?= nl2br(htmlspecialchars($data['about']['content'] ?? 'Focamos no essencial. Nossa equipe transforma sua visão em realidade através de técnicas precisas e produtos de alta qualidade.')) ?>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-32 px-6 bg-white overflow-hidden">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 reveal border-b pb-12 border-slate-100">
            <div class="max-w-md">
                <span class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-300 block mb-4 italic"><?= htmlspecialchars($services_h['title'] ?? 'The Collection') ?></span>
                <h3 class="text-4xl font-extrabold text-slate-900 uppercase tracking-tighter leading-none italic"><?= htmlspecialchars($services_h['subtitle'] ?? 'Serviços') ?></h3>
                <p class="text-slate-500 text-sm mt-4 font-medium italic"><?= htmlspecialchars($services_h['content'] ?? 'Precisão técnica e estética avançada.') ?></p>
            </div>
            <a href="/servicos" class="mt-8 md:mt-0 px-8 py-3 bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.3em] hover:bg-slate-800 transition-all">Explorar Catálogo</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 reveal">
            <?php foreach ($services as $service): ?>
            <div class="group">
                <div class="aspect-[4/3] bg-slate-100 rounded-2xl mb-6 overflow-hidden relative shadow-sm hover:shadow-xl transition-all duration-500">
                    <?php if(!empty($service['image'])): ?>
                        <img src="<?= $service['image'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <?php else: ?>
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    <?php endif; ?>
                    <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black text-slate-900 uppercase tracking-widest shadow-sm">
                        R$ <?= number_format($service['price'], 2, ',', '.') ?>
                    </div>
                </div>
                <h4 class="text-xl font-black text-slate-900 uppercase mb-3 tracking-tighter group-hover:text-indigo-600 transition-colors"><?= htmlspecialchars($service['name']) ?></h4>
                <p class="text-slate-500 text-sm font-medium leading-relaxed mb-4 line-clamp-3 italic"><?= htmlspecialchars($service['description']) ?></p>
                <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-300">
                    <span><?= $service['duration'] ?> MIN</span>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <a href="/agendar" class="text-slate-900 hover:underline">Reservar</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
