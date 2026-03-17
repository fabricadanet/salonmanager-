<section class="min-h-screen bg-soft pt-32 pb-24">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gold block mb-3">Get in Touch</span>
            <h1 class="text-5xl font-serif italic text-primary uppercase">Contato</h1>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-start">
            <!-- Contact Form -->
            <div class="bg-white rounded-[3rem] p-10 md:p-12 shadow-2xl border border-white text-left">
                <form id="contactForm" class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Nome Completo</label>
                        <input type="text" id="name" required class="w-full bg-soft border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-gold outline-none transition-all" placeholder="Seu nome">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Assunto</label>
                        <select id="subject" class="w-full bg-soft border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-gold outline-none transition-all appearance-none">
                            <option value="Dúvida">Dúvida sobre serviço</option>
                            <option value="Orçamento">Solicitar orçamento</option>
                            <option value="Feedback">Sugestão ou Feedback</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Mensagem</label>
                        <textarea id="message" required rows="4" class="w-full bg-soft border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-gold outline-none transition-all" placeholder="Como podemos te ajudar?"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-gold text-white py-5 rounded-2xl text-[11px] font-black uppercase tracking-[0.3em] hover:bg-primary transition-all shadow-lg hover:shadow-gold/20">
                        Enviar via WhatsApp
                    </button>
                </form>
            </div>

            <!-- Alternative Channels -->
            <div class="space-y-6">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-gold/5 flex items-center gap-6 group">
                    <div class="h-16 w-16 bg-soft rounded-2xl flex items-center justify-center text-gold group-hover:bg-gold group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" /></svg>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">WhatsApp</span>
                        <a href="https://wa.me/<?= preg_replace('/\D/','',$whatsapp) ?>" class="text-sm font-bold text-primary hover:text-gold transition-colors"><?= $whatsapp ?></a>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-gold/5 flex items-center gap-6 group">
                    <div class="h-16 w-16 bg-soft rounded-2xl flex items-center justify-center text-gold group-hover:bg-gold group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div class="text-left">
                        <span class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Endereço</span>
                        <p class="text-sm font-bold text-primary">Consulte nossa localização</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('contactForm')?.addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('name').value;
                const subject = document.getElementById('subject').value;
                const msg = document.getElementById('message').value;
                
                const whatsappMsg = `Olá! Meu nome é ${name}. \n*Assunto:* ${subject} \n*Mensagem:* ${msg}`;
                const url = `https://wa.me/<?= preg_replace('/\D/','',$whatsapp) ?>?text=${encodeURIComponent(whatsappMsg)}`;
                
                window.open(url, '_blank');
            });
        </script>
    </div>
</section>
section>