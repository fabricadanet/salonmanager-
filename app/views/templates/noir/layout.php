<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Salão de beleza premium. Agende seu horário e conheça nossos serviços.">
    <title><?= $global['subtitle'] ?? $title ?? 'SalonManager' ?></title>
    <?php if(!empty($global['image'])): ?>
    <link rel="icon" type="image/x-icon" href="<?= $global['image'] ?>">
    <?php endif; ?>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS with Custom Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        noir: {
                            DEFAULT: '#050505',
                            light: '#111111',
                            lighter: '#1a1a1a',
                        },
                        gold: {
                            DEFAULT: '#D4AF37',
                            dark: '#A6892C',
                            light: '#F4CF63',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    animation: {
                        'reveal-up': 'revealUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'fade-in': 'fadeIn 1s ease-out forwards',
                    },
                    keyframes: {
                        revealUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        .text-balanced { text-wrap: balance; }
        .noir-gradient { background: linear-gradient(180deg, rgba(5,5,5,0) 0%, rgba(5,5,5,1) 100%); }
        
        /* Reveal on Scroll */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

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
<body class="bg-noir text-white font-sans flex flex-col min-h-screen selection:bg-gold selection:text-noir">
    <?= $seoConfig['title'] ?? '' ?> <!-- google_tag -->
    
    <!-- Navbar -->
    <header 
        x-data="{ scrolled: false, mobileMenuOpen: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-white/5"
        :class="scrolled || mobileMenuOpen ? 'bg-noir/95 backdrop-blur-md py-3' : 'bg-transparent py-5'"
    >
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex justify-between items-center">
            <a href="/" class="group flex items-center space-x-2">
                <?php if(!empty($logo)): ?>
                    <img src="<?= (string)$logo ?>" alt="SalonManager" class="h-10 w-auto group-hover:scale-105 transition-transform">
                <?php else: ?>
                    <span class="text-2xl font-bold tracking-widest font-serif text-white group-hover:text-gold transition-colors italic"><?= mb_substr($global['subtitle'] ?? 'S.M', 0, 3) ?></span>
                    <span class="text-xs tracking-[0.3em] uppercase opacity-50 font-light group-hover:opacity-100 transition-opacity"><?= $global['subtitle'] ?? 'SalonManager' ?></span>
                <?php endif; ?>
            </a>
            
            <nav class="hidden md:flex items-center space-x-12">
                <a href="/" class="text-sm uppercase tracking-widest hover:text-gold transition-colors font-light">Início</a>
                <a href="/servicos" class="text-sm uppercase tracking-widest hover:text-gold transition-colors font-light">Serviços</a>
                <a href="/produtos" class="text-sm uppercase tracking-widest hover:text-gold transition-colors font-light">Produtos</a>
                <a href="/contato" class="text-sm uppercase tracking-widest hover:text-gold transition-colors font-light">Contato</a>
            </nav>
            
            <div class="flex items-center space-x-6">
                <a href="/agendar" class="hidden md:block group relative px-6 py-3 overflow-hidden border border-gold/30">
                    <div class="absolute inset-0 w-0 bg-gold transition-all duration-[400ms] ease-out group-hover:w-full"></div>
                    <span class="relative text-xs uppercase tracking-[0.2em] font-medium text-gold group-hover:text-noir transition-colors">Agendar</span>
                </a>

                <!-- Hamburger Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-white hover:text-gold transition-colors focus:outline-none">
                    <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 9h16.5m-16.5 6.75h16.5"/></svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="md:hidden bg-noir-light border-b border-white/10 absolute top-full left-0 w-full p-8 shadow-2xl overflow-y-auto max-h-[calc(100vh-80px)]"
        >
            <nav class="flex flex-col space-y-6">
                <a href="/" class="text-lg uppercase tracking-[0.3em] font-light hover:text-gold transition-colors border-b border-white/5 pb-4">Início</a>
                <a href="/servicos" class="text-lg uppercase tracking-[0.3em] font-light hover:text-gold transition-colors border-b border-white/5 pb-4">Serviços</a>
                <a href="/produtos" class="text-lg uppercase tracking-[0.3em] font-light hover:text-gold transition-colors border-b border-white/5 pb-4">Produtos</a>
                <a href="/contato" class="text-lg uppercase tracking-[0.3em] font-light hover:text-gold transition-colors border-b border-white/5 pb-4">Contato</a>
                <a href="/agendar" class="mt-4 block text-center py-4 border border-gold text-gold uppercase tracking-[0.2em] text-xs font-bold hover:bg-gold hover:text-noir transition-all">
                    Agendar Horário
                </a>
            </nav>
            
            <?php if (!empty($social)): ?>
            <div class="flex space-x-6 mt-12 pt-8 border-t border-white/5">
                <?php if(!empty($social['instagram'])): ?>
                    <a href="<?= $social['instagram'] ?>" target="_blank" class="text-gray-500 hover:text-gold transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.062-1.366-.332-2.633-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07M12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow pt-20">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="bg-noir-light border-t border-white/5 py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="md:col-span-2 space-y-6">
                <a href="/" class="text-2xl font-bold tracking-widest font-serif text-white italic"><?= $global['subtitle'] ?? 'SalonManager' ?></a>
                <p class="max-w-sm text-sm text-gray-500 font-light leading-relaxed">
                    <?= !empty($global['footer_text']) ? htmlspecialchars($global['footer_text']) : 'Elegância e excelência em cada detalhe. O destino definitivo para quem busca transformar sua beleza natural em uma obra de arte.' ?>
                </p>
                <div class="flex space-x-6 pt-4">
                    <?php if(!empty($social['instagram'])): ?>
                        <a href="<?= $social['instagram'] ?>" target="_blank" class="text-gray-500 hover:text-gold transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.062-1.366-.332-2.633-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07M12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($social['facebook'])): ?>
                        <a href="<?= $social['facebook'] ?>" target="_blank" class="text-gray-500 hover:text-gold transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($social['tiktok'])): ?>
                        <a href="<?= $social['tiktok'] ?>" target="_blank" class="text-gray-500 hover:text-gold transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31.036 2.612.13 3.91.24.246 1.25.76 2.375 1.46 3.4 1.056.12 1.3.17 1.8.3.1.536.21 1.07.31 1.61.033.155.07.313.1.47-1.424-.035-2.846-.1-4.267-.215V16a5.52 5.52 0 01-4 5.485 5.53 5.53 0 01-1.6.24 5.54 5.54 0 01-5.54-5.54 5.52 5.52 0 014.282-5.385v2.09A3.442 3.442 0 0013 16V0L12.525.02z"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (!empty($whatsapp)): ?>
                <div class="pt-4">
                    <span class="text-[10px] uppercase tracking-[0.3em] text-gold/50 block mb-2 font-bold">Contato Direto</span>
                    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>" class="text-xl font-light hover:text-gold transition-colors">
                        <?= htmlspecialchars($whatsapp) ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="space-y-6">
                <span class="text-[10px] uppercase tracking-[0.3em] text-gold/50 block font-bold">Navegação</span>
                <ul class="space-y-4 text-sm font-light text-gray-400">
                    <li><a href="/" class="hover:text-gold transition-colors">Home</a></li>
                    <li><a href="/servicos" class="hover:text-gold transition-colors">Serviços</a></li>
                    <li><a href="/produtos" class="hover:text-gold transition-colors">Produtos</a></li>
                    <li><a href="/agendar" class="hover:text-gold transition-colors">Agendar</a></li>
                </ul>
            </div>
            
            <div class="space-y-6">
                <span class="text-[10px] uppercase tracking-[0.3em] text-gold/50 block font-bold">Legal</span>
                <ul class="space-y-4 text-sm font-light text-gray-400">
                    <li><a href="/privacidade" class="text-gray-500 hover:text-gold transition-colors">Privacidade</a></li>
                    <li><a href="/termos" class="text-gray-500 hover:text-gold transition-colors">Termos de Uso</a></li>
                    <li><a href="/login" class="hover:text-gold transition-colors">Admin</a></li>
                </ul>
                <p class="pt-6 text-[10px] text-gray-600 tracking-wider">
                    &copy; <?= date('Y') ?> <?= mb_strtoupper($global['subtitle'] ?? 'SALONMANAGER') ?>. <br>TODOS OS DIREITOS RESERVADOS.
                </p>
            </div>
        </div>
    </footer>
    
</body>
</html>
