<section class="max-w-4xl mx-auto px-6 py-20 lg:py-32">
    <div class="mb-16 reveal">
        <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 leading-none mb-6">RESERVAR.</h1>
        <p class="text-slate-500 font-medium text-lg leading-relaxed">Escolha seu ritual e o profissional de sua preferência.</p>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="bg-slate-900 text-white p-12 mb-16 reveal">
            <h3 class="text-2xl font-black uppercase tracking-tighter mb-2">Agendamento Realizado.</h3>
            <p class="text-slate-400 font-medium text-sm uppercase tracking-widest">Enviamos os detalhes para o seu contato. Te esperamos!</p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="bg-red-500 text-white p-8 mb-16 reveal">
            <p class="text-sm font-bold uppercase tracking-widest text-center">Erro ao processar reserva. Tente novamente.</p>
        </div>
    <?php endif; ?>

    <form action="/agendar" method="POST" class="space-y-12 reveal">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.4em] text-slate-400">01. Ritual</label>
                <select name="service_id" required class="w-full bg-slate-50 border-b-2 border-slate-200 p-6 text-sm font-bold uppercase transition-colors focus:outline-none focus:border-slate-900 appearance-none">
                    <option value="">Escolha um serviço...</option>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id'] ?>"><?= htmlspecialchars($service['name']) ?> — R$ <?= number_format($service['price'], 2, ',', '.') ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.4em] text-slate-400">02. Especialista</label>
                <select name="professional_id" required class="w-full bg-slate-50 border-b-2 border-slate-200 p-6 text-sm font-bold uppercase transition-colors focus:outline-none focus:border-slate-900 appearance-none">
                    <option value="">Escolha o profissional...</option>
                    <?php foreach ($professionals as $professional): ?>
                        <option value="<?= $professional['id'] ?>"><?= htmlspecialchars($professional['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.4em] text-slate-400">03. Data</label>
                <input type="date" name="appointment_date" required class="w-full bg-slate-50 border-b-2 border-slate-200 p-6 text-sm font-bold uppercase transition-colors focus:outline-none focus:border-slate-900">
            </div>

            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.4em] text-slate-400">04. Horário</label>
                <input type="time" name="start_time" required class="w-full bg-slate-50 border-b-2 border-slate-200 p-6 text-sm font-bold uppercase transition-colors focus:outline-none focus:border-slate-900">
            </div>
        </div>

        <div class="pt-12 border-t border-slate-100 italic font-serif text-slate-400 text-xl">
            "Sua beleza em boas mãos."
        </div>

        <div class="space-y-8">
            <h3 class="text-2xl font-black text-slate-900 tracking-tighter uppercase">05. Seus Detalhes</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <input type="text" name="name" placeholder="NOME COMPLETO" required class="w-full bg-slate-50 border-b-2 border-slate-200 p-6 text-xs font-bold transition-colors focus:outline-none focus:border-slate-900">
                <input type="tel" name="phone" placeholder="TELEFONE" required class="w-full bg-slate-50 border-b-2 border-slate-200 p-6 text-xs font-bold transition-colors focus:outline-none focus:border-slate-900">
            </div>
        </div>

        <button type="submit" class="w-full bg-slate-900 text-white py-8 text-xs font-black uppercase tracking-[0.5em] hover:bg-slate-800 hover:scale-[1.01] transition-all">
            Confirmar Reserva
        </button>
    </form>
</section>
