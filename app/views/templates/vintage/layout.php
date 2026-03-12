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
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #fcfaf7; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        [x-cloak] { display: none !important; }
        .reveal { opacity: 0; transform: scale(0.98); transition: all 1s ease; }
        .reveal.active { opacity: 1; transform: scale(1); }
        .vintage-border { border: 1px solid #d4b483; }
        .vintage-gradient { background: linear-gradient(to bottom, #fcfaf7, #f7f1e3); }
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
<body class="text-amber-950/80">
    <?= $seoConfig['title'] ?? '' ?> <!-- google_tag -->
    <header x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)"
            class="fixed top-0 w-full z-50 transition-all duration-500"
            :class="scrolled ? 'bg-[#fcfaf7]/90 backdrop-blur-md border-b border-amber-200/50 py-4' : 'bg-transparent py-10'">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
            <a href="/" class="group flex flex-col items-center">
                <?php if(!empty($logo)): ?>
                    <img src="<?= $logo ?>" alt="SalonManager" class="h-12 w-auto mb-1 group-hover:scale-105 transition-transform">
                <?php else: ?>
                    <span class="text-3xl font-serif font-bold italic tracking-wider text-amber-900 leading-none"><?= $global['subtitle'] ?? 'SalonManager' ?></span>
                    <span class="text-[8px] uppercase tracking-[0.6em] text-amber-700/60 mt-1 font-bold">Est. 2024</span>
                <?php endif; ?>
            </a>
            <nav class="hidden md:flex space-x-10 text-[10px] uppercase tracking-[0.3em] font-semibold text-amber-900/70">
                <a href="/" class="hover:text-amber-600 transition-colors">Início</a>
                <a href="/servicos" class="hover:text-amber-600 transition-colors">Serviços</a>
                <a href="/produtos" class="hover:text-amber-600 transition-colors">Boutique</a>
                <a href="/contato" class="hover:text-amber-600 transition-colors">Contato</a>
            </nav>
            <a href="/agendar" class="vintage-border px-8 py-3 text-[10px] uppercase tracking-[0.3em] font-bold text-amber-900 hover:bg-amber-900 hover:text-white transition-all">Agendar</a>
        </div>
    </header>

    <main class="min-h-screen">
        <?= $content ?? '' ?>
    </main>

    <footer class="bg-[#f0e6d2] border-t border-amber-200 py-24 px-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/paper.png');"></div>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 relative z-10">
            <div class="md:col-span-2 space-y-8">
                <h4 class="text-2xl font-serif italic font-bold text-amber-900">Onde a tradição encontra a arte.</h4>
                <p class="text-sm font-serif italic text-amber-900/60 leading-relaxed">
                    <?= !empty($global['footer_text']) ? htmlspecialchars($global['footer_text']) : 'Celebrando a beleza clássica e o cuidado artesanal. Um refúgio de sofisticação para almas exigentes.' ?>
                </p>
                <div class="h-px bg-amber-900/20 w-24"></div>
            </div>
            
            <div class="space-y-6">
                <h5 class="text-[10px] uppercase tracking-[0.4em] font-black text-amber-900">Explore</h5>
                <ul class="space-y-4 text-xs font-semibold uppercase tracking-widest text-amber-800/60">
                    <li><a href="/" class="hover:text-amber-900">Home</a></li>
                    <li><a href="/servicos" class="hover:text-amber-900">Serviços</a></li>
                    <li><a href="/produtos" class="hover:text-amber-900">Produtos</a></li>
                </ul>
            </div>

            <div class="space-y-6">
                <h5 class="text-[10px] uppercase tracking-[0.4em] font-black text-amber-900">Visite-nos</h5>
                <p class="text-xs italic font-serif leading-relaxed text-amber-800/80">
                    <?= htmlspecialchars($data['contact']['content'] ?? 'Rua da Estética, 123 — Centro') ?>
                </p>
            </div>
        </div>
        <div class="max-w-6xl mx-auto mt-20 pt-10 border-t border-amber-900/10 text-center">
            <p class="text-[10px] uppercase tracking-[0.5em] text-amber-900/30 font-black">
                &copy; <?= date('Y') ?> <?= $global['subtitle'] ?? 'SalonManager' ?>. Atemporal.
            </p>
        </div>
    </footer>
</body>
</html>
