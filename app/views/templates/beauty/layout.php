<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $global['subtitle'] ?? $global['title'] ?? 'SalonManager' ?></title>

    <?php if(!empty($global['image'])): ?>
        <link rel="icon" href="<?= $global['image'] ?>">
    <?php endif; ?>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- 🎨 DESIGN TOKENS (Inspirado em synctecbr.com.br) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f172a', // slate-900 (Contraste)
                        gold: '#D4AF37',    // Dourado Elegante
                        accent: '#B8860B',  // Dark Gold (Accents)
                        soft: '#FAF9F6',    // Bone/Pearl White (Harmonious background)
                        surface: '#FFFFFF'
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAF9F6; }
        .font-serif { font-family: 'Playfair Display', serif; }
        [x-cloak] { display:none!important; }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .floating-wa {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 100;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .floating-wa:hover { transform: scale(1.1); }
    </style>

</head>

<body class="text-slate-900">

<!-- HEADER -->
<header x-data="{open:false, scrolled: false}" 
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'glass py-3 shadow-sm' : 'bg-transparent py-5'"
        class="fixed w-full top-0 z-50 transition-all duration-300">
    <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">

        <a href="/" class="flex items-center gap-3">
            <div class="h-10 w-10 flex items-center justify-center rounded-full bg-white shadow-sm border border-soft overflow-hidden">
                <?php if(!empty($logo)): ?>
                    <img src="<?= htmlspecialchars((string)$logo) ?>" alt="Logo" class="h-8 w-8 object-cover rounded-full">
                <?php else: ?>
                    <span class="text-xs font-bold text-accent">B</span>
                <?php endif; ?>
            </div>
            <div class="leading-none">
                <span class="block text-sm font-black uppercase tracking-[0.2em] text-primary">
                    <?= $global['title'] ?? 'Beauty' ?>
                </span>
                <span class="text-[9px] text-accent uppercase tracking-widest font-bold">
                    <?= $global['subtitle'] ?? 'Pro Flow' ?>
                </span>
            </div>
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex gap-10 text-[10px] uppercase font-black tracking-[0.2em]">
            <a href="/" class="hover:text-accent transition-colors">Home</a>
            <a href="/servicos" class="hover:text-accent transition-colors">Serviços</a>
            <a href="/produtos" class="hover:text-accent transition-colors">Produtos</a>
            <a href="/contato" class="hover:text-accent transition-colors">Contato</a>
        </nav>

        <div class="flex items-center gap-4">
            <a href="/agendar" class="hidden sm:block bg-gold text-white px-6 py-3 text-[10px] font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-lg hover:shadow-soft">
                Agendar
            </a>
            
            <!-- Mobile Toggle -->
            <button @click="open = !open" class="md:hidden text-primary">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
            </button>
        </div>

    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-cloak 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="absolute top-full left-0 w-full bg-white border-b shadow-xl p-8 md:hidden">
        <nav class="flex flex-col gap-6 text-xs uppercase font-black tracking-widest">
            <a href="/" @click="open = false">Home</a>
            <a href="/servicos" @click="open = false">Serviços</a>
            <a href="/produtos" @click="open = false">Produtos</a>
            <a href="/contato" @click="open = false">Contato</a>
            <hr class="border-soft">
            <a href="/agendar" class="bg-gold text-white text-center py-4">Agendar Agora</a>
        </nav>
    </div>
</header>

<!-- CONTENT -->
<main class="">
    <?= $content ?>
</main>

<!-- FOOTER -->
<footer class="bg-primary text-white py-20">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12">
        <div>
            <div class="flex items-center gap-3 mb-6">
                <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center p-1 overflow-hidden">
                    <?php if(!empty($logo)): ?>
                        <img src="<?= htmlspecialchars((string)$logo) ?>" alt="Logo" class="h-8 w-8 object-cover rounded-full">
                    <?php endif; ?>
                </div>
                <span class="font-serif italic text-xl"><?= $global['title'] ?? 'Beauty' ?></span>
            </div>
            <p class="text-slate-400 text-sm leading-relaxed">
                <?= $data['contact']['content'] ?? 'Especialista em realçar sua beleza natural com técnicas modernas e produtos de alta qualidade.' ?>
            </p>
        </div>
        
        <div class="space-y-4">
            <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-gold">Navegação</h4>
            <nav class="flex flex-col gap-3 text-sm text-slate-300">
                <a href="/" class="hover:text-white transition-colors">Início</a>
                <a href="/servicos" class="hover:text-white transition-colors">Nossos Serviços</a>
                <a href="/produtos" class="hover:text-white transition-colors">Nossos Produtos</a>
                <a href="/agendar" class="hover:text-white transition-colors">Agendamento Online</a>
            </nav>
        </div>

        <div class="space-y-4">
            <h4 class="text-[10px] font-black uppercase tracking-[0.3em] text-gold">Contato</h4>
            <div class="text-sm text-slate-300 space-y-3">
                <p>Venha nos visitar e transforme seu visual.</p>
                <a href="https://wa.me/<?= preg_replace('/\D/','',$whatsapp) ?>" class="flex items-center gap-2 text-gold font-bold">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" /></svg>
                    Fale Conosco
                </a>
            </div>
        </div>
    </div>
    
    <div class="mt-20 pt-8 border-t border-slate-800 text-center text-[10px] uppercase font-black tracking-widest text-slate-500">
        <div class="mb-4 flex justify-center gap-6">
            <a href="/privacidade" class="hover:text-gold transition-colors">Privacidade</a>
            <a href="/termos" class="hover:text-gold transition-colors">Termos</a>
        </div>
        <p><?= $global['subtitle'] ?? 'SalonManager' ?> © <?= date('Y') ?></p>
    </div>
</footer>

<!-- WhatsApp Floating -->
<a href="https://wa.me/<?= preg_replace('/\D/','',$whatsapp) ?>" target="_blank" class="floating-wa shadow-2xl">
    <div class="w-14 h-14 bg-emerald-500 rounded-full flex items-center justify-center text-white">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" /></svg>
    </div>
</a>

</body>
</html>