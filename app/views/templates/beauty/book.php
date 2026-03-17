<section class="min-h-screen bg-soft pt-32 pb-24">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gold block mb-3">Self Care Registry</span>
            <h1 class="text-5xl font-serif italic text-primary uppercase">Agende seu Horário</h1>
            <p class="mt-4 text-slate-400 text-sm uppercase tracking-widest font-bold">É rápido, prático e totalmente online.</p>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-white">
            <div class="grid md:grid-cols-5 h-full">
                <div class="md:col-span-2 bg-primary p-12 text-white flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -top-20 -left-20 w-64 h-64 bg-gold/20 rounded-full blur-3xl"></div>
                    <div class="relative z-10">
                        <h2 class="text-3xl font-serif italic mb-6">Por que agendar online?</h2>
                        <ul class="space-y-6">
                            <li class="flex items-start gap-4">
                                <div class="h-6 w-6 rounded-full bg-gold/20 flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-3 h-3 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="text-sm text-slate-300">Evite esperas e garanta seu horário exclusivo.</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="h-6 w-6 rounded-full bg-gold/20 flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-3 h-3 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="text-sm text-slate-300">Escolha seu profissional favorito.</span>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="h-6 w-6 rounded-full bg-gold/20 flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-3 h-3 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <span class="text-sm text-slate-300">Gestão rápida do seu tempo.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="pt-12 relative z-10">
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-black leading-relaxed">
                            Caso tenha dificuldades, chame no WhatsApp.
                        </p>
                    </div>
                </div>

                <div class="md:col-span-3 p-12 md:p-16">
                    <form action="/process-booking" method="POST" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Nome Completo</label>
                                <input type="text" name="name" required class="w-full bg-soft border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-gold outline-none transition-all" placeholder="Como podemos te chamar?">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">WhatsApp</label>
                                <input type="tel" name="phone" required class="w-full bg-soft border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-gold outline-none transition-all" placeholder="(00) 00000-0000">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Serviço Desejado</label>
                            <select name="service_id" required class="w-full bg-soft border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-gold outline-none transition-all appearance-none">
                                <option value="">Selecione o serviço...</option>
                                <?php foreach ($services as $s): ?>
                                    <option value="<?= $s['id'] ?>" <?= (isset($_GET['service_id']) && $_GET['service_id'] == $s['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($s['name']) ?> - R$ <?= number_format($s['price'], 2, ',', '.') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Data</label>
                                <input type="date" name="appointment_date" required class="w-full bg-soft border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-gold outline-none transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Horário</label>
                                <input type="time" name="start_time" required class="w-full bg-soft border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-gold outline-none transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Profissional de Preferência</label>
                            <select name="professional_id" class="w-full bg-soft border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-gold outline-none transition-all appearance-none">
                                <option value="">Sem preferência (Qualquer profissional)</option>
                                <?php foreach ($professionals as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full bg-gold text-white py-5 rounded-2xl text-[11px] font-black uppercase tracking-[0.3em] hover:bg-primary transition-all shadow-lg hover:shadow-gold/20">
                                Confirmar Agendamento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>