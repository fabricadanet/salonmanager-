<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Salão de beleza premium. Agende seu horário e conheça nossos serviços.">
    <title><?= $title ?? 'SalonManager' ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans flex flex-col min-h-screen">
    
    <!-- Navbar -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold tracking-tight text-gray-900">SalonManager</a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-600 hover:text-gray-900">Home</a>
                    <a href="/servicos" class="text-gray-600 hover:text-gray-900">Serviços</a>
                    <a href="/produtos" class="text-gray-600 hover:text-gray-900">Produtos</a>
                    <a href="/contato" class="text-gray-600 hover:text-gray-900">Contato</a>
                    <a href="/agendar" class="bg-gray-900 text-white px-4 py-2 hover:bg-gray-800 rounded shadow font-medium transition">Agendar Horário</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
            <p>&copy; <?= date('Y') ?> SalonManager. Todos os direitos reservados.</p>
            <?php if (!empty($whatsapp)): ?>
            <p class="mt-2 text-gray-400">WhatsApp: <?= htmlspecialchars($whatsapp) ?></p>
            <?php endif; ?>
        </div>
    </footer>
    
</body>
</html>
