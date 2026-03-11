<!-- Hero Section -->
<div class="relative bg-gray-900">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover opacity-30" src="https://images.unsplash.com/photo-1521590832167-7bfc17484d20?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Salon Background">
        <div class="absolute inset-0 bg-gray-900 mix-blend-multiply" aria-hidden="true"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
            <?= htmlspecialchars($data['hero']['title'] ?? 'Seu Salão de Beleza') ?>
        </h1>
        <p class="mt-6 max-w-lg mx-auto text-xl text-gray-300">
            <?= htmlspecialchars($data['hero']['subtitle'] ?? 'Surpreenda-se com os nossos profissionais.') ?>
        </p>
        <p class="mt-4 max-w-2xl mx-auto text-md text-gray-400">
            <?= htmlspecialchars($data['hero']['content'] ?? '') ?>
        </p>
        <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
            <a href="/agendar" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-gray-900 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                Agendar Agora
            </a>
            <a href="/servicos" class="mt-3 w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 sm:mt-0 sm:ml-3">
                Ver Serviços
            </a>
        </div>
    </div>
</div>

<!-- Quem Somos -->
<?php if (!empty($data['about']['title']) || !empty($data['about']['content'])): ?>
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900"><?= htmlspecialchars($data['about']['title'] ?? 'Quem Somos') ?></h2>
        <p class="mt-4 max-w-2xl text-lg text-gray-500 mx-auto">
            <?= nl2br(htmlspecialchars($data['about']['content'] ?? '')) ?>
        </p>
    </div>
</div>
<?php endif; ?>

<!-- Serviços em Destaque -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Serviços em Destaque</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <?php foreach ($services as $service): ?>
                <div class="bg-white border rounded-lg shadow-sm p-6 hover:shadow-md transition">
                    <h3 class="text-lg font-bold text-gray-900"><?= htmlspecialchars($service['name']) ?></h3>
                    <p class="text-gray-500 mt-2 text-sm"><?= htmlspecialchars($service['description']) ?></p>
                    <div class="mt-4 flex justify-between items-center text-sm font-medium">
                        <span class="text-indigo-600">R$ <?= number_format($service['price'], 2, ',', '.') ?></span>
                        <span class="text-gray-400"><?= $service['duration'] ?> min</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-8">
            <a href="/servicos" class="text-indigo-600 font-medium hover:text-indigo-900">Ver todos os serviços &rarr;</a>
        </div>
    </div>
</div>

<!-- Produtos em Destaque -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Produtos em Destaque</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
            <?php foreach ($products as $product): ?>
                <div class="bg-gray-50 border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                    <?php if ($product['image']): ?>
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gray-200"></div>
                    <?php endif; ?>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="text-gray-500 mt-2 text-sm"><?= htmlspecialchars($product['description']) ?></p>
                        <p class="mt-4 text-lg font-bold text-gray-900">R$ <?= number_format($product['price'], 2, ',', '.') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-8">
            <a href="/produtos" class="text-indigo-600 font-medium hover:text-indigo-900">Ver todos os produtos &rarr;</a>
        </div>
    </div>
</div>
