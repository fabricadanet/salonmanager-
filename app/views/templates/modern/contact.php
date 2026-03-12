<section class="max-w-6xl mx-auto px-6 py-20 lg:py-32">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
        <div class="reveal">
            <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 leading-none mb-12">CONTATO.</h1>
            
            <div class="space-y-12">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 block mb-4">Localização</span>
                    <p class="text-xl font-bold text-slate-900 uppercase tracking-tight"><?= htmlspecialchars($data['contact']['content'] ?? 'Avenida da Elegância, 1000 — São Paulo, SP') ?></p>
                </div>
                
                <div>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 block mb-4">Horários</span>
                    <p class="text-xl font-bold text-slate-900 uppercase tracking-tight">Seg — Sáb: 09:00 às 20:00</p>
                </div>

                <div>
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-400 block mb-4">WhatsApp Direto</span>
                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>" class="text-3xl font-black text-slate-900 hover:text-slate-500 transition-colors">
                        <?= htmlspecialchars($whatsapp) ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-slate-50 p-12 lg:p-16 reveal border-l-8 border-slate-900 shadow-xl">
            <h3 class="text-2xl font-black text-slate-900 tracking-tighter uppercase mb-8">Envie uma mensagem</h3>
            <div class="space-y-6" x-data="{ name: '', phone: '', message: '' }">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Nome</label>
                    <input type="text" x-model="name" class="w-full bg-white border border-slate-200 p-4 text-xs font-bold focus:outline-none focus:border-slate-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Telefone</label>
                    <input type="text" x-model="phone" class="w-full bg-white border border-slate-200 p-4 text-xs font-bold focus:outline-none focus:border-slate-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Mensagem</label>
                    <textarea x-model="message" rows="4" class="w-full bg-white border border-slate-200 p-4 text-xs font-bold focus:outline-none focus:border-slate-900"></textarea>
                </div>
                
                <button @click="window.open(`https://wa.me/<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>?text=${encodeURIComponent('Olá, meu nome é ' + name + '. ' + message)}`, '_blank')"
                        class="w-full bg-slate-900 text-white py-6 text-xs font-black uppercase tracking-[0.4em] hover:bg-slate-800 transition-all">
                    Enviar via WhatsApp
                </button>
            </div>
        </div>
    </div>
</section>
