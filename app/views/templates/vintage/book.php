<section class="py-32 px-6 vintage-gradient min-h-screen flex flex-col justify-center">
    <div class="max-w-4xl mx-auto w-full">
        <div class="mb-20 text-center reveal">
            <span class="text-[10px] uppercase tracking-[0.5em] text-amber-700 font-black block mb-6">Reservation</span>
            <h1 class="text-6xl md:text-8xl font-serif italic text-amber-900 leading-none">Agende seu momento.</h1>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="vintage-border p-12 mb-16 bg-white text-center reveal">
                <h3 class="text-3xl font-serif italic text-amber-900 mb-4">Sua reserva foi acolhida.</h3>
                <p class="text-sm font-serif italic text-amber-800/60 uppercase tracking-widest">Aguardamos ansiosamente por sua visita.</p>
            </div>
        <?php endif; ?>

        <form action="/agendar" method="POST" class="vintage-border p-10 md:p-20 bg-white shadow-2xl space-y-16 reveal relative">
            <div class="absolute inset-4 border border-amber-900/5 pointer-events-none"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 relative z-10">
                <div class="space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-[0.4em] text-amber-900">I. Selecione o Ritual</label>
                    <div class="relative">
                        <select name="service_id" required class="w-full bg-amber-50/50 border-b border-amber-900/20 p-5 text-lg font-serif italic focus:outline-none focus:border-amber-900 appearance-none">
                            <option value="">Escolha...</option>
                            <?php foreach ($services as $service): ?>
                                <option value="<?= $service['id'] ?>"><?= htmlspecialchars($service['name']) ?> • R$ <?= number_format($service['price'], 2, ',', '.') ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-amber-900/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-[0.4em] text-amber-900">II. O Especialista</label>
                    <div class="relative">
                        <select name="professional_id" required class="w-full bg-amber-50/50 border-b border-amber-900/20 p-5 text-lg font-serif italic focus:outline-none focus:border-amber-900 appearance-none">
                            <option value="">Escolha...</option>
                            <?php foreach ($professionals as $professional): ?>
                                <option value="<?= $professional['id'] ?>"><?= htmlspecialchars($professional['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg class="w-4 h-4 text-amber-900/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-[0.4em] text-amber-900">III. Data Desejada</label>
                    <input type="date" name="appointment_date" required class="w-full bg-amber-50/50 border-b border-amber-900/20 p-5 text-sm font-serif italic focus:outline-none focus:border-amber-900">
                </div>

                <div class="space-y-4">
                    <label class="block text-[10px] font-black uppercase tracking-[0.4em] text-amber-900">IV. Horário</label>
                    <input type="time" name="start_time" required class="w-full bg-amber-50/50 border-b border-amber-900/20 p-5 text-sm font-serif italic focus:outline-none focus:border-amber-900">
                </div>
            </div>

            <div class="space-y-10 relative z-10">
                <h3 class="text-3xl font-serif italic font-bold text-amber-950 border-b border-amber-900/10 pb-4">V. Seus detalhes.</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <input type="text" name="name" placeholder="NOME COMPLETO" required class="w-full bg-transparent border-b border-amber-900/20 p-4 text-sm font-serif italic placeholder:text-amber-900/20 focus:outline-none focus:border-amber-900">
                    <input type="tel" name="phone" placeholder="TELEFONE" required class="w-full bg-transparent border-b border-amber-900/20 p-4 text-sm font-serif italic placeholder:text-amber-900/20 focus:outline-none focus:border-amber-900">
                </div>
            </div>

            <button type="submit" class="w-full bg-amber-900 text-[#fcfaf7] py-8 text-[10px] font-black uppercase tracking-[0.6em] hover:bg-amber-800 transition-all shadow-2xl relative z-10">
                Confirmar Ritual
            </button>
        </form>
    </div>
</section>
