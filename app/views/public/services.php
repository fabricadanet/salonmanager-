<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Nossos Serviços</h1>
            <p class="mt-4 text-lg text-gray-500">Conheça tudo o que oferecemos para o seu bem-estar e beleza.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($services as $service): ?>
                <div class="bg-gray-50 border rounded-lg shadow-sm p-6 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($service['name']) ?></h3>
                        <p class="text-gray-500 mt-2 text-sm"><?= htmlspecialchars($service['description']) ?></p>
                    </div>
                    <div class="mt-6 border-t pt-4 flex justify-between items-center">
                        <div class="text-lg font-bold text-indigo-600">R$ <?= number_format($service['price'], 2, ',', '.') ?></div>
                        <div class="text-sm text-gray-500 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?= $service['duration'] ?> min
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($services)): ?>
            <p class="text-center text-gray-500">Nenhum serviço disponível no momento.</p>
        <?php endif; ?>

        <div class="mt-12 text-center">
            <a href="/agendar" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gray-900 hover:bg-gray-800">
                Agendar Agora
            </a>
        </div>
    </div>
</div>
