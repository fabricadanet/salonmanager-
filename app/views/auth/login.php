<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo | SalonManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-6 bg-cover bg-center bg-no-repeat" style="background-image: url('<?= $background ?>');">
    
    <div class="absolute inset-0 bg-slate-900/40 backdrop-grayscale-[0.5]"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="text-center mb-10">
            <?php if(!empty($logo)): ?>
                <img src="<?= $logo ?>" alt="SalonManager" class="h-16 mx-auto mb-4 drop-shadow-2xl">
            <?php else: ?>
                <h1 class="text-4xl font-black text-white tracking-tighter uppercase mb-2">Salon<span class="text-indigo-400">Manager</span></h1>
            <?php endif; ?>
            <p class="text-white/60 text-xs font-bold uppercase tracking-[0.3em]">Painel de Controle</p>
        </div>

        <div class="glass rounded-[2.5rem] p-10 shadow-2xl">
            <h2 class="text-2xl font-black text-slate-900 mb-8 tracking-tight">Bem-vindo(a).</h2>

            <?php if (isset($error)): ?>
                <div class="bg-red-500/10 border border-red-500/20 text-red-600 p-4 rounded-2xl mb-6 text-sm font-bold flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="/login" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">E-mail</label>
                    <input type="email" name="email" required autofocus
                           class="w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm font-bold focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none"
                           placeholder="seu@email.com">
                </div>

                <div class="space-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Senha</label>
                    <input type="password" name="password" required
                           class="w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm font-bold focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none"
                           placeholder="••••••••">
                </div>

                <button type="submit" 
                        class="w-full bg-slate-900 text-white rounded-2xl py-4 font-black uppercase tracking-widest text-xs hover:bg-slate-800 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-slate-900/20">
                    Entrar no Sistema
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-slate-900/5 text-center">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">SalonManager v2.0 &copy; <?= date('Y') ?></p>
            </div>
        </div>
    </div>

</body>
</html>
