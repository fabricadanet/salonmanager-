<section class="py-24 bg-noir px-6 lg:px-12 relative overflow-hidden">
    <!-- Decorative Element -->
    <div class="absolute top-0 right-0 w-1/3 aspect-square border-l border-b border-white/[0.03] -z-0"></div>
    
    <div class="max-w-4xl mx-auto relative z-10">
        <?php if(isset($_GET['success'])): ?>
            <div class="mb-12 p-8 bg-gold/10 border border-gold/30 text-gold text-center font-serif italic text-xl animate-reveal-up">
                Obrigado. Seu agendamento foi recebido com sucesso.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['error'])): ?>
            <div class="mb-12 p-6 bg-red-900/20 border border-red-900/40 text-red-500 text-center uppercase tracking-widest text-xs font-bold">
                Houve um problema com seu pedido. Por favor, revise os dados.
            </div>
        <?php endif; ?>

        <div class="mb-16 space-y-4 reveal">
            <span class="text-[10px] uppercase tracking-[0.5em] text-gold font-bold">Appointment</span>
            <h1 class="text-6xl md:text-7xl font-serif italic text-white leading-tight">Agende seu momento.</h1>
            <p class="text-gray-500 font-light text-lg max-w-xl">Escolha seu ritual, o profissional de sua preferência e o melhor horário para ser transformado.</p>
        </div>

        <form action="/agendar" method="POST" class="space-y-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 border-t border-white/10 pt-12">
                <!-- Left: Ritual and Professional -->
                <div class="space-y-12">
                    <div class="space-y-6">
                        <label for="service_id" class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-bold">01. Selecione o Ritual</label>
                        <select name="service_id" id="service_id" required class="block w-full bg-transparent border-0 border-b border-white/10 text-xl font-serif italic text-white py-4 focus:ring-0 focus:border-gold transition-colors outline-none cursor-pointer appearance-none">
                            <option value="" disabled selected class="bg-noir">ESCOLHA UM SERVIÇO...</option>
                            <?php foreach($services as $s): ?>
                                <option value="<?= $s['id'] ?>" class="bg-noir">
                                    <?= htmlspecialchars($s['name']) ?> — R$ <?= number_format($s['price'], 2, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="space-y-6">
                        <label for="professional_id" class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-bold">02. Selecione o Profissional</label>
                        <select name="professional_id" id="professional_id" required class="block w-full bg-transparent border-0 border-b border-white/10 text-xl font-serif italic text-white py-4 focus:ring-0 focus:border-gold transition-colors outline-none cursor-pointer appearance-none">
                            <option value="" disabled selected class="bg-noir">ESCOLHA O ESPECIALISTA...</option>
                            <?php foreach($professionals as $p): ?>
                                <option value="<?= $p['id'] ?>" class="bg-noir">
                                    <?= htmlspecialchars($p['name']) ?> (<?= htmlspecialchars($p['specialty']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Right: Date and Time -->
                <div class="space-y-12">
                    <div class="space-y-6">
                        <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-bold">03. Data Desejada</label>
                        <input type="date" name="appointment_date" required min="<?= date('Y-m-d') ?>" 
                               class="block w-full bg-transparent border-0 border-b border-white/10 text-xl font-serif italic text-white py-4 focus:ring-0 focus:border-gold transition-colors outline-none appearance-none">
                    </div>

                    <div class="space-y-6">
                        <label class="block text-[10px] uppercase tracking-[0.3em] text-gray-400 font-bold">04. Horário Preferencial</label>
                        <input type="time" name="start_time" required 
                               class="block w-full bg-transparent border-0 border-b border-white/10 text-xl font-serif italic text-white py-4 focus:ring-0 focus:border-gold transition-colors outline-none appearance-none">
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 pt-12 space-y-12">
                <div class="space-y-4">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-gray-400 font-bold">05. Seus Detalhes</span>
                    <h3 class="text-3xl font-serif italic text-white">Como podemos identificá-la?</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <input type="text" name="name" required placeholder="NOME COMPLETO" 
                           class="bg-transparent border-0 border-b border-white/10 text-sm tracking-[0.2em] text-white py-4 focus:ring-0 focus:border-gold transition-colors outline-none placeholder:text-gray-700 font-bold uppercase">
                    
                    <input type="text" name="phone" required placeholder="TEL / WHATSAPP" 
                           class="bg-transparent border-0 border-b border-white/10 text-sm tracking-[0.2em] text-white py-4 focus:ring-0 focus:border-gold transition-colors outline-none placeholder:text-gray-700 font-bold uppercase">
                </div>
            </div>

            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-8">
                <p class="text-[10px] text-gray-600 uppercase tracking-widest max-w-xs text-center md:text-left">
                    Ao confirmar o agendamento, você receberá uma confirmação em breve via WhatsApp.
                </p>
                <button type="submit" class="group relative px-20 py-6 overflow-hidden bg-gold text-noir font-bold uppercase tracking-[0.3em] text-xs transition-transform hover:scale-105">
                    Solicitar Agendamento
                </button>
            </div>
        </form>
    </div>
</section>
