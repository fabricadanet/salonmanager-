<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $global['subtitle'] ?? $title ?? 'SalonManager' ?></title>
    <?php if(!empty($global['image'])): ?>
    <link rel="icon" type="image/x-icon" href="<?= $global['image'] ?>">
    <?php endif; ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('active');
                });
            }, { threshold: 0.1 });
            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
        });
    </script>
    <!-- Custom Scripts from Admin -->
    <?php 
    require_once __DIR__ . '/../../../models/WebsiteContent.php';
    $contentModel = new WebsiteContent();
    $seoConfig = $contentModel->where('section', 'seo')[0] ?? [];
    echo $seoConfig['content'] ?? ''; // header_scripts
    ?>
</head>
<body class="bg-white text-slate-900 selection:bg-slate-900 selection:text-white">
    <?= $seoConfig['title'] ?? '' ?> <!-- google_tag -->
    <header x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)"
            class="fixed top-0 w-full z-50 transition-all duration-300"
            :class="scrolled ? 'bg-white/80 backdrop-blur-md border-b py-4' : 'bg-transparent py-8'">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
            <a href="/" class="flex items-center">
                <?php if(!empty($logo)): ?>
                    <img src="<?= $logo ?>" alt="SalonManager" class="h-10 w-auto">
                <?php else: ?>
                    <span class="text-xl font-bold tracking-tighter uppercase"><?= $global['subtitle'] ?? 'SalonManager' ?></span>
                <?php endif; ?>
            </a>
            <nav class="hidden md:flex space-x-8 text-xs font-semibold uppercase tracking-widest">
                <a href="/" class="hover:underline">Home</a>
                <a href="/servicos" class="hover:underline">Serviços</a>
                <a href="/produtos" class="hover:underline">Loja</a>
                <a href="/contato" class="hover:underline">Contato</a>
            </nav>
            <a href="/agendar" class="bg-slate-900 text-white px-5 py-2 text-xs font-bold uppercase tracking-widest hover:bg-slate-800 transition-colors">Agendar</a>
        </div>
    </header>

    <main class="pt-24 min-h-screen">
        <?= $content ?? '' ?>
    </main>

    <footer class="bg-slate-50 border-t py-16 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 text-sm text-slate-500">
            <div class="space-y-4">
                <h4 class="text-slate-900 font-bold uppercase tracking-widest text-xs"><?= $global['subtitle'] ?? 'SalonManager' ?></h4>
                <p><?= !empty($global['footer_text']) ? htmlspecialchars($global['footer_text']) : 'Minimalismo e precisão para sua beleza. Cada detalhe importa.' ?></p>
                <div class="flex space-x-4 pt-2">
                    <?php if(!empty($social['instagram'])): ?>
                        <a href="<?= $social['instagram'] ?>" target="_blank" class="text-slate-400 hover:text-slate-900 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.062-1.366-.332-2.633-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07M12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($social['facebook'])): ?>
                        <a href="<?= $social['facebook'] ?>" target="_blank" class="text-slate-400 hover:text-slate-900 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($social['tiktok'])): ?>
                        <a href="<?= $social['tiktok'] ?>" target="_blank" class="text-slate-400 hover:text-slate-900 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31.036 2.612.13 3.91.24.246 1.25.76 2.375 1.46 3.4 1.056.12 1.3.17 1.8.3.1.536.21 1.07.31 1.61.033.155.07.313.1.47-1.424-.035-2.846-.1-4.267-.215V16a5.52 5.52 0 01-4 5.485 5.53 5.53 0 01-1.6.24 5.54 5.54 0 01-5.54-5.54 5.52 5.52 0 014.282-5.385v2.09A3.442 3.442 0 0013 16V0L12.525.02z"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="space-y-4">
                <h4 class="text-slate-900 font-bold uppercase tracking-widest text-xs">Menu</h4>
                <div class="flex flex-col space-y-2">
                    <a href="/" class="hover:text-slate-900">Início</a>
                    <a href="/servicos" class="hover:text-slate-900">Serviços</a>
                    <a href="/produtos" class="hover:text-slate-900">Produtos</a>
                </div>
            </div>
            <div class="space-y-4">
                <h4 class="text-slate-900 font-bold uppercase tracking-widest text-xs">Localização</h4>
                <p><?= htmlspecialchars($data['contact']['content'] ?? 'Rua da Estética, 123 — Centro') ?></p>
            </div>
        </div>
        <div class="max-w-6xl mx-auto mt-12 pt-8 border-t text-[10px] uppercase font-bold tracking-widest text-slate-400">
            &copy; <?= date('Y') ?> <?= $global['subtitle'] ?? 'SalonManager' ?>. Built for clarity.
        </div>
    </footer>
</body>
</html>
