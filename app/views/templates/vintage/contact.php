<section class="py-32 px-6 vintage-gradient min-h-screen flex items-center">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-center w-full">
        <div class="reveal space-y-16">
            <div class="space-y-6">
                <span class="text-[10px] uppercase tracking-[0.5em] text-amber-700 font-black block mb-6">Contact</span>
                <h1 class="text-6xl md:text-8xl font-serif italic text-amber-900 leading-none">Entre em contato.</h1>
            </div>
            
            <div class="space-y-16">
                <div class="flex items-start space-x-8">
                    <div class="w-px h-12 bg-amber-900/20"></div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-700 block mb-4">A Maison</span>
                        <p class="text-2xl font-serif italic text-amber-950"><?= htmlspecialchars($data['contact']['content'] ?? 'Avenida da Elegância, 1000 — São Paulo, SP') ?></p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-8">
                    <div class="w-px h-12 bg-amber-900/20"></div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-700 block mb-4">Expediente</span>
                        <p class="text-2xl font-serif italic text-amber-950">Segunda a Sábado, das 09h às 20h.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-8">
                    <div class="w-px h-12 bg-amber-900/20"></div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-700 block mb-4">Correspondência Digital</span>
                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>" class="text-4xl font-serif italic font-bold text-amber-900 hover:text-amber-700 transition-colors">
                            <?= htmlspecialchars($whatsapp) ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white vintage-border p-12 lg:p-20 reveal shadow-2xl relative">
            <div class="absolute inset-4 border border-amber-900/5 pointer-events-none"></div>
            <h3 class="text-3xl font-serif italic font-bold text-amber-950 mb-12 relative z-10">Deixe sua mensagem</h3>
            <div class="space-y-8 relative z-10" x-data="{ name: '', phone: '', message: '' }">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-amber-700">Nome Estimado</label>
                    <input type="text" x-model="name" class="w-full bg-amber-50/30 border-b border-amber-900/20 p-4 text-lg font-serif italic focus:outline-none focus:border-amber-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-amber-700">Telefone para Contato</label>
                    <input type="text" x-model="phone" class="w-full bg-amber-50/30 border-b border-amber-900/20 p-4 text-lg font-serif italic focus:outline-none focus:border-amber-900">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-amber-700">Sua Mensagem</label>
                    <textarea x-model="message" rows="4" class="w-full bg-amber-50/30 border-b border-amber-900/20 p-4 text-lg font-serif italic focus:outline-none focus:border-amber-900"></textarea>
                </div>
                
                <button @click="window.open(`https://wa.me/<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>?text=${encodeURIComponent('Saudações! Sou ' + name + '. ' + message)}`, '_blank')"
                        class="w-full bg-amber-900 text-[#fcfaf7] py-6 text-[10px] font-black uppercase tracking-[0.5em] hover:bg-amber-800 transition-all">
                    Enviar via WhatsApp
                </button>
            </div>
        </div>
    </div>
</section>
