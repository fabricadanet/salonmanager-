<div class="py-12 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <?php if(isset($_GET['success'])): ?>
            <div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-center font-medium shadow-sm">
                Agendamento concluído com sucesso! Entraremos em contato se necessário.
            </div>
        <?php endif; ?>

        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900">Agende seu horário</h1>
            <p class="mt-2 text-gray-500">Preencha os dados abaixo de forma prática.</p>
        </div>

        <form action="/agendar" method="POST" class="bg-white shadow border border-gray-100 rounded-lg p-6 sm:p-10">
            
            <div class="space-y-6">
                <!-- Select Service -->
                <div>
                    <label for="service_id" class="block text-sm font-medium text-gray-700 mb-1">Escolha o Serviço</label>
                    <select name="service_id" id="service_id" required class="block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 pb-2">
                        <option value="" disabled selected>Selecione um serviço...</option>
                        <?php foreach($services as $s): ?>
                            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?> (R$ <?= number_format($s['price'], 2, ',', '.') ?> - <?= $s['duration'] ?> min)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Select Professional -->
                <div>
                    <label for="professional_id" class="block text-sm font-medium text-gray-700 mb-1">Qual Profissional?</label>
                    <select name="professional_id" id="professional_id" required class="block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 pb-2">
                        <option value="" disabled selected>Selecione o profissional...</option>
                        <?php foreach($professionals as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?> (<?= htmlspecialchars($p['specialty']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Data</label>
                        <input type="date" name="appointment_date" required min="<?= date('Y-m-d') ?>" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horário</label>
                        <input type="time" name="start_time" required class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Seus dados</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                            <input type="text" name="name" required placeholder="Ex: Maria Silva" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telefone (WhatsApp)</label>
                            <input type="text" name="phone" required placeholder="Ex: 11999999999" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-5 text-right">
                <button type="submit" class="w-full sm:w-auto inline-flex justify-center py-3 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Confirmar Agendamento
                </button>
            </div>
        </form>
    </div>
</div>
