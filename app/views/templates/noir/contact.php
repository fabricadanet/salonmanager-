<section class="py-24 bg-noir px-6 lg:px-12 relative min-h-[80vh] flex items-center">
    <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
        <!-- Left: Branding & Contact Info -->
        <div class="space-y-12 reveal">
            <div class="space-y-4">
                <span class="text-[10px] uppercase tracking-[0.5em] text-gold font-bold">Contact Us</span>
                <h1 class="text-6xl md:text-8xl font-serif italic text-white leading-tight">Vamos Conversar.</h1>
            </div>
            
            <p class="text-gray-500 font-light text-lg max-w-md leading-relaxed">
                <?= htmlspecialchars($data['contact']['content'] ?? 'Estamos à disposição para tirar suas dúvidas e ajudá-la a escolher o melhor tratamento para sua beleza.') ?>
            </p>

            <div class="space-y-8 pt-6">
                <div class="group">
                    <span class="block text-[10px] uppercase tracking-widest text-gold mb-2 font-bold opacity-50">Localização</span>
                    <p class="text-white font-serif italic text-xl group-hover:text-gold transition-colors">Avenida da Elegância, 1000 — São Paulo, SP</p>
                </div>
                <div class="group">
                    <span class="block text-[10px] uppercase tracking-widest text-gold mb-2 font-bold opacity-50">Horário de Atendimento</span>
                    <p class="text-white font-serif italic text-xl group-hover:text-gold transition-colors">Seg — Sáb: 09:00 às 20:00</p>
                </div>
            </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="bg-noir-light border border-white/5 p-12 relative" x-data="contactApp()">
            <div class="absolute -top-4 -right-4 w-24 h-24 border-t border-r border-gold/30 -z-0"></div>
            
            <div class="relative z-10 space-y-12">
                <div class="space-y-8">
                    <input type="text" x-model="name" placeholder="SEU NOME" 
                           class="w-full bg-transparent border-0 border-b border-white/10 text-sm tracking-[0.2em] text-white py-4 focus:ring-0 focus:border-gold transition-colors outline-none placeholder:text-gray-700 font-bold uppercase">
                    
                    <input type="text" x-model="phone" placeholder="SEU TELEFONE" 
                           class="w-full bg-transparent border-0 border-b border-white/10 text-sm tracking-[0.2em] text-white py-4 focus:ring-0 focus:border-gold transition-colors outline-none placeholder:text-gray-700 font-bold uppercase">
                    
                    <textarea x-model="message" placeholder="SUA MENSAGEM" rows="4" 
                              class="w-full bg-transparent border-0 border-b border-white/10 text-sm tracking-[0.2em] text-white py-4 focus:ring-0 focus:border-gold transition-colors outline-none placeholder:text-gray-700 font-bold uppercase resize-none"></textarea>
                </div>

                <button @click="sendMessage()" 
                        class="w-full py-6 bg-gold text-noir font-bold uppercase tracking-[0.3em] text-xs transition-transform hover:scale-105">
                    Enviar via WhatsApp
                </button>
            </div>
        </div>
    </div>
</section>

<script>
    function contactApp() {
        return {
            name: '',
            phone: '',
            message: '',
            salonPhone: '<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>',
            
            sendMessage() {
                if (!this.name || !this.message) {
                    return;
                }
                
                let text = `*SOLONMANAGER - CONTACTO VIA SITE*\n\n`;
                text += `Olá! Gostaria de mais informações.\n\n`;
                text += `*NOME:* ${this.name.toUpperCase()}\n`;
                if(this.phone) text += `*TELEFONE:* ${this.phone.toUpperCase()}\n`;
                text += `\n*MENSAGEM:* \n${this.message.toUpperCase()}`;
                
                const encoded = encodeURIComponent(text);
                const url = `https://wa.me/${this.salonPhone}?text=${encoded}`;
                window.open(url, '_blank');
            }
        }
    }
</script>
