<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight">Conteúdo do Site Público</h2>
    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Personalize a identidade visual e o conteúdo do seu salão.</p>
</div>

<form action="/admin/content/update" method="POST" enctype="multipart/form-data" class="space-y-10 pb-20">
    <!-- Custom Selection Styles -->
    <style>
        label:has(input:checked) .check-icon { opacity: 1 !important; }
        label:has(input:checked) .check-circle { 
            background-color: #6366f1 !important; 
            border-color: #6366f1 !important; 
        }
    </style>
    
    <!-- Configurações Globais -->
    <div class="bg-gray-900 shadow-xl rounded-2xl p-8 border border-gray-800 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-2 h-full bg-indigo-500"></div>
        <h3 class="text-lg font-black text-white mb-6 flex items-center uppercase tracking-tighter">
            <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Configurações Globais
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nome do Sistema (Admin)</label>
                <input type="text" name="global[title]" value="<?= htmlspecialchars($content['global']['title'] ?? 'SalonManager') ?>" class="w-full bg-gray-800 border-gray-700 rounded-xl p-4 text-sm font-bold text-white focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nome do Site (Público)</label>
                <input type="text" name="global[subtitle]" value="<?= htmlspecialchars($content['global']['subtitle'] ?? 'SalonManager | Premium Beauty') ?>" class="w-full bg-gray-800 border-gray-700 rounded-xl p-4 text-sm font-bold text-white focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            
            <div class="md:col-span-2 space-y-4 pt-4 border-t border-gray-800">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-indigo-400">Descritivo do Rodapé (Footer)</label>
                <textarea name="global[footer_text]" rows="2" placeholder="Ex: Elegância e excelência em cada detalhe. O destino definitivo para quem busca transformar sua beleza natural..." class="w-full bg-gray-800 border-gray-700 rounded-xl p-4 text-sm font-medium text-white focus:ring-indigo-500 focus:border-indigo-500"><?= htmlspecialchars($content['global']['footer_text'] ?? '') ?></textarea>
            </div>
            
            <!-- Favicon Settings -->
            <div class="md:col-span-2 space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Favicon (Ícone da Aba)</label>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gray-800 rounded-lg border border-gray-700 flex items-center justify-center overflow-hidden">
                        <?php if(!empty($content['global']['image'])): ?>
                            <img src="<?= $content['global']['image'] ?>" class="w-full h-full object-contain">
                        <?php else: ?>
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <?php endif; ?>
                    </div>
                    <div class="flex-grow space-y-2">
                        <input type="file" name="global[image]" class="block w-full text-[10px] text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-gray-700 file:text-white hover:file:bg-gray-600">
                        <input type="text" name="global[image_url]" placeholder="URL do Favicon..." value="<?= !str_starts_with($content['global']['image'] ?? '', '/uploads/') ? htmlspecialchars($content['global']['image'] ?? '') : '' ?>" class="w-full bg-gray-800 border-gray-700 rounded-lg text-[10px] p-2 text-white placeholder:text-gray-600">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Identidade Visual -->
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-2 h-full bg-indigo-600"></div>
        <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center uppercase tracking-tighter">
            <svg class="w-5 h-5 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Logos e Branding
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Logo Settings -->
            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Logomarca (Upload ou URL)</label>
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden">
                        <?php if(!empty($content['logo']['image'])): ?>
                            <img src="<?= $content['logo']['image'] ?>" class="max-w-full max-h-full object-contain">
                        <?php else: ?>
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <?php endif; ?>
                    </div>
                    <div class="flex-grow space-y-2">
                        <input type="file" name="logo[image]" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <input type="text" name="logo[image_url]" placeholder="Ou cole a URL aqui..." value="<?= !str_starts_with($content['logo']['image'] ?? '', '/uploads/') ? htmlspecialchars($content['logo']['image'] ?? '') : '' ?>" class="w-full bg-gray-50 border-gray-200 rounded-lg text-xs p-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
            </div>

            <!-- Admin Login Background -->
            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Fundo da Tela de Login</label>
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden">
                        <?php if(!empty($content['admin_login']['image'])): ?>
                            <img src="<?= $content['admin_login']['image'] ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <?php endif; ?>
                    </div>
                    <div class="flex-grow space-y-2">
                        <input type="file" name="admin_login[image]" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <input type="text" name="admin_login[image_url]" placeholder="Ou cole a URL aqui..." value="<?= !str_starts_with($content['admin_login']['image'] ?? '', '/uploads/') ? htmlspecialchars($content['admin_login']['image'] ?? '') : '' ?>" class="w-full bg-gray-50 border-gray-200 rounded-lg text-xs p-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template Selection -->
    <div class="bg-indigo-900 shadow-2xl rounded-2xl p-8 border border-indigo-800 relative group overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 to-slate-900 opacity-50"></div>
        <div class="relative z-10">
            <h3 class="text-lg font-black text-white mb-6 border-b border-indigo-800 pb-4 flex items-center uppercase tracking-tighter">
                <svg class="w-5 h-5 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                Template do Site Público
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Noir -->
                <label class="relative cursor-pointer group">
                    <input type="radio" name="config[content]" value="noir" class="peer sr-only" <?= ($content['config']['content'] ?? 'noir') === 'noir' ? 'checked' : '' ?>>
                    <div class="p-4 bg-noir-800 border-2 border-indigo-800/30 rounded-2xl peer-checked:border-indigo-500 peer-checked:bg-indigo-500/10 hover:bg-white/5 transition-all duration-300 peer-checked:[&_.check-icon]:opacity-100 peer-checked:[&_.check-circle]:bg-indigo-500 peer-checked:[&_.check-circle]:border-indigo-500">
                        <div class="aspect-[16/10] bg-noir rounded-xl mb-4 overflow-hidden border border-white/5 shadow-2xl">
                            <img src="/assets/img/previews/noir.png" class="w-full h-full object-cover">
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="block text-sm font-black text-indigo-100 uppercase tracking-widest">Noir & Gold</span>
                                <span class="block text-[10px] text-indigo-300/40 uppercase mt-1">Elegância e Mistério</span>
                            </div>
                            <!-- Selection Check -->
                            <div class="check-circle w-6 h-6 rounded-full border-2 border-indigo-800 flex items-center justify-center transition-all">
                                <svg class="check-icon w-3 h-3 text-white opacity-0 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    </div>
                </label>
                <!-- Modern -->
                <label class="relative cursor-pointer group">
                    <input type="radio" name="config[content]" value="modern" class="peer sr-only" <?= ($content['config']['content'] ?? '') === 'modern' ? 'checked' : '' ?>>
                    <div class="p-4 bg-white/5 border-2 border-indigo-800/30 rounded-2xl peer-checked:border-indigo-500 peer-checked:bg-indigo-500/10 hover:bg-white/5 transition-all duration-300 peer-checked:[&_.check-icon]:opacity-100 peer-checked:[&_.check-circle]:bg-indigo-500 peer-checked:[&_.check-circle]:border-indigo-500">
                        <div class="aspect-[16/10] bg-white rounded-xl mb-4 overflow-hidden border border-white/5 shadow-2xl">
                            <img src="/assets/img/previews/modern.png" class="w-full h-full object-cover">
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="block text-sm font-black text-indigo-100 uppercase tracking-widest">Modern Clarity</span>
                                <span class="block text-[10px] text-indigo-300/40 uppercase mt-1">Minimalismo e Precisão</span>
                            </div>
                            <div class="check-circle w-6 h-6 rounded-full border-2 border-indigo-800 flex items-center justify-center transition-all">
                                <svg class="check-icon w-3 h-3 text-white opacity-0 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    </div>
                </label>

                <!-- Vintage -->
                <label class="relative cursor-pointer group">
                    <input type="radio" name="config[content]" value="vintage" class="peer sr-only" <?= ($content['config']['content'] ?? '') === 'vintage' ? 'checked' : '' ?>>
                    <div class="p-4 bg-white/5 border-2 border-indigo-800/30 rounded-2xl peer-checked:border-indigo-500 peer-checked:bg-indigo-500/10 hover:bg-white/5 transition-all duration-300 peer-checked:[&_.check-icon]:opacity-100 peer-checked:[&_.check-circle]:bg-indigo-500 peer-checked:[&_.check-circle]:border-indigo-500">
                        <div class="aspect-[16/10] bg-amber-50 rounded-xl mb-4 overflow-hidden border border-white/5 shadow-2xl">
                            <img src="/assets/img/previews/vintage.png" class="w-full h-full object-cover">
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="block text-sm font-black text-indigo-100 uppercase tracking-widest">Vintage Chic</span>
                                <span class="block text-[10px] text-indigo-300/40 uppercase mt-1">Tradição e Acolhimento</span>
                            </div>
                            <div class="check-circle w-6 h-6 rounded-full border-2 border-indigo-800 flex items-center justify-center transition-all">
                                <svg class="check-icon w-3 h-3 text-white opacity-0 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    </div>
                </label>
                <!-- Beauty -->
                <label class="relative cursor-pointer group">
    <input type="radio" name="config[content]" value="beauty" class="peer sr-only" <?= ($content['config']['content'] ?? '') === 'beauty' ? 'checked' : '' ?>>

    <div class="p-4 bg-white/5 border-2 border-indigo-800/30 rounded-2xl 
        peer-checked:border-indigo-500 
        peer-checked:bg-indigo-500/10 
        hover:bg-white/5 
        transition-all duration-300
        peer-checked:[&_.check-icon]:opacity-100 
        peer-checked:[&_.check-circle]:bg-indigo-500 
        peer-checked:[&_.check-circle]:border-indigo-500">

        <!-- Preview -->
        <div class="aspect-[16/10] bg-pink-50 rounded-xl mb-4 overflow-hidden border border-white/5 shadow-2xl">
            <img src="/assets/img/previews/beauty.png" class="w-full h-full object-cover">
        </div>

        <!-- Info -->
        <div class="flex items-center justify-between">
            <div>
                <span class="block text-sm font-black text-indigo-100 uppercase tracking-widest">
                    Beauty Flow
                </span>
                <span class="block text-[10px] text-indigo-300/40 uppercase mt-1">
                    Elegância Moderna & Conversão
                </span>
            </div>

            <!-- Check -->
            <div class="check-circle w-6 h-6 rounded-full border-2 border-indigo-800 flex items-center justify-center transition-all">
                <svg class="check-icon w-3 h-3 text-white opacity-0 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>
    </div>
</label>
            </div>
        </div>
    </div>
    
    <!-- Hero Section -->
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-2 h-full bg-slate-900"></div>
        <h3 class="text-lg font-black text-gray-900 mb-8 border-b border-gray-100 pb-4 uppercase tracking-tighter">Seção Principal (Hero)</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-2 space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Imagem de Destaque (Hero)</label>
                <div class="flex items-center space-x-6">
                    <div class="w-32 h-32 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 flex items-center justify-center overflow-hidden shadow-inner">
                        <?php if(!empty($content['hero']['image'])): ?>
                            <img src="<?= $content['hero']['image'] ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <?php endif; ?>
                    </div>
                    <div class="flex-grow space-y-3">
                        <input type="file" name="hero[image]" class="block w-full text-xs text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-slate-900 file:text-white hover:file:bg-slate-800">
                        <input type="text" name="hero[image_url]" placeholder="Ou cole a URL da imagem aqui..." value="<?= !str_starts_with($content['hero']['image'] ?? '', '/uploads/') ? htmlspecialchars($content['hero']['image'] ?? '') : '' ?>" class="w-full bg-gray-50 border-gray-200 rounded-xl text-xs p-3 focus:ring-slate-900 focus:border-slate-900 shadow-sm">
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Título de Impacto</label>
                <input type="text" name="hero[title]" value="<?= htmlspecialchars($content['hero']['title'] ?? '') ?>" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-slate-900 focus:border-slate-900">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Subtítulo</label>
                <input type="text" name="hero[subtitle]" value="<?= htmlspecialchars($content['hero']['subtitle'] ?? '') ?>" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-slate-900 focus:border-slate-900">
            </div>
            <div class="md:col-span-2 space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Texto de Apoio</label>
                <textarea name="hero[content]" rows="3" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-medium focus:ring-slate-900 focus:border-slate-900"><?= htmlspecialchars($content['hero']['content'] ?? '') ?></textarea>
            </div>
        </div>
    </div>

    <!-- Quem Somos -->
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
        <h3 class="text-lg font-black text-gray-900 mb-8 border-b border-gray-100 pb-4 uppercase tracking-tighter">Quem Somos</h3>
        <div class="space-y-6">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Título da Seção</label>
                <input type="text" name="about[title]" value="<?= htmlspecialchars($content['about']['title'] ?? '') ?>" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Narrativa</label>
                <textarea name="about[content]" rows="6" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-medium leading-relaxed focus:ring-indigo-500 focus:border-indigo-500"><?= htmlspecialchars($content['about']['content'] ?? '') ?></textarea>
            </div>
        </div>
    </div>

    <!-- Seções da Página Inicial -->
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-2 h-full bg-amber-500"></div>
        <h3 class="text-lg font-black text-gray-900 mb-8 border-b border-gray-100 pb-4 uppercase tracking-tighter">Cabeçalhos das Seções (Homepage)</h3>
        
        <div class="space-y-12">
            <!-- Services Header -->
            <div class="space-y-6">
                <label class="block text-xs font-black uppercase tracking-widest text-amber-600">Seção de Serviços</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400">Tagline (Título Pequeno)</label>
                        <input type="text" name="services_header[title]" value="<?= htmlspecialchars($content['services_header']['title'] ?? '') ?>" placeholder="Ex: Curadoria Especializada" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-amber-500 focus:border-amber-500">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400">Título Principal</label>
                        <input type="text" name="services_header[subtitle]" value="<?= htmlspecialchars($content['services_header']['subtitle'] ?? '') ?>" placeholder="Ex: Nossos Serviços" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-amber-500 focus:border-amber-500">
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400">Texto de Apoio</label>
                        <textarea name="services_header[content]" rows="2" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-medium focus:ring-amber-500 focus:border-amber-500"><?= htmlspecialchars($content['services_header']['content'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Products Header -->
            <div class="space-y-6 pt-6 border-t border-gray-100">
                <label class="block text-xs font-black uppercase tracking-widest text-indigo-600">Seção de Produtos</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400">Tagline (Título Pequeno)</label>
                        <input type="text" name="products_header[title]" value="<?= htmlspecialchars($content['products_header']['title'] ?? '') ?>" placeholder="Ex: Selection D'Excellence" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400">Título Principal</label>
                        <input type="text" name="products_header[subtitle]" value="<?= htmlspecialchars($content['products_header']['subtitle'] ?? '') ?>" placeholder="Ex: Nossa Boutique" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-[10px] font-black uppercase text-gray-400">Texto de Apoio</label>
                        <textarea name="products_header[content]" rows="2" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-medium focus:ring-indigo-500 focus:border-indigo-500"><?= htmlspecialchars($content['products_header']['content'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action (CTA) Section -->
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-2 h-full bg-green-500"></div>
        <h3 class="text-lg font-black text-gray-900 mb-8 border-b border-gray-100 pb-4 uppercase tracking-tighter">Chamada para Ação (CTA Agendar)</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Título do CTA</label>
                <input type="text" name="cta[title]" value="<?= htmlspecialchars($content['cta']['title'] ?? '') ?>" placeholder="Ex: Pronta para viver a sua melhor versão?" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-green-500 focus:border-green-500">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Fundo Decorativo (Se aplicável)</label>
                <input type="text" name="cta[subtitle]" value="<?= htmlspecialchars($content['cta']['subtitle'] ?? '') ?>" placeholder="Ex: Experience" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-green-500 focus:border-green-500">
            </div>
            <div class="md:col-span-2 space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Texto do Botão (Opcional)</label>
                <input type="text" name="cta[content]" value="<?= htmlspecialchars($content['cta']['content'] ?? '') ?>" placeholder="Ex: Agendar Horário" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-green-500 focus:border-green-500">
            </div>
        </div>
    </div>

    <!-- Políticas e Termos (Rich Text) -->
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-2 h-full bg-purple-600"></div>
        <h3 class="text-lg font-black text-gray-900 mb-8 border-b border-gray-100 pb-4 uppercase tracking-tighter">Políticas e Termos</h3>
        
        <div class="space-y-12">
            <!-- Política de Privacidade -->
            <div class="space-y-4">
                <label class="block text-[10px] font-black uppercase tracking-widest text-purple-600">Política de Privacidade</label>
                <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200">
                    <div id="privacy-editor" style="height: 300px;"><?= htmlspecialchars_decode($content['privacy']['content'] ?? '') ?></div>
                    <input type="hidden" name="privacy[content]" id="privacy-input">
                </div>
            </div>

            <!-- Termos de Uso -->
            <div class="space-y-4 pt-6 border-t border-gray-100">
                <label class="block text-[10px] font-black uppercase tracking-widest text-purple-600">Termos de Uso</label>
                <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-200">
                    <div id="terms-editor" style="height: 300px;"><?= htmlspecialchars_decode($content['terms']['content'] ?? '') ?></div>
                    <input type="hidden" name="terms[content]" id="terms-input">
                </div>
            </div>
        </div>
    </div>

    <!-- Redes Sociais -->
    <div class="bg-gray-900 shadow-xl rounded-2xl p-8 border border-gray-800 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-2 h-full bg-pink-500"></div>
        <h3 class="text-lg font-black text-white mb-8 border-b border-gray-800 pb-4 uppercase tracking-tighter flex items-center">
            <svg class="w-5 h-5 mr-3 text-pink-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.332 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.332-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608-.062-1.366-.332-2.633-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.332-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308 1.266-.058 1.646-.07 4.85-.07M12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
            Redes Sociais
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Instagram (Link Completo)</label>
                <input type="text" name="social[instagram]" value="<?= htmlspecialchars($content['social']['instagram'] ?? '') ?>" placeholder="https://instagram.com/seu-perfil" class="w-full bg-gray-800 border-gray-700 rounded-xl p-4 text-sm font-bold text-white focus:ring-pink-500 focus:border-pink-500">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Facebook (Link Completo)</label>
                <input type="text" name="social[facebook]" value="<?= htmlspecialchars($content['social']['facebook'] ?? '') ?>" placeholder="https://facebook.com/seu-perfil" class="w-full bg-gray-800 border-gray-700 rounded-xl p-4 text-sm font-bold text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">TikTok (Link Completo)</label>
                <input type="text" name="social[tiktok]" value="<?= htmlspecialchars($content['social']['tiktok'] ?? '') ?>" placeholder="https://tiktok.com/@seu-perfil" class="w-full bg-gray-800 border-gray-700 rounded-xl p-4 text-sm font-bold text-white focus:ring-gray-300 focus:border-gray-300">
            </div>
        </div>
    </div>

    <!-- Contato e Redes -->
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
        <h3 class="text-lg font-black text-gray-900 mb-8 border-b border-gray-100 pb-4 uppercase tracking-tighter">Contato e WhatsApp</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Número WhatsApp (Direto)</label>
                <input type="text" name="whatsapp[content]" value="<?= htmlspecialchars($content['whatsapp']['content'] ?? '') ?>" placeholder="5511999999999" class="w-full bg-green-50/30 border-green-100 rounded-xl p-4 text-sm font-bold text-green-800 focus:ring-green-500 focus:border-green-500">
            </div>
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Endereço / Localização</label>
                <input type="text" name="contact[content]" value="<?= htmlspecialchars($content['contact']['content'] ?? '') ?>" class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-sm font-bold focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
    </div>

    <!-- Floating Save Button -->
    <div class="fixed bottom-8 right-8 z-50">
        <button type="submit" class="bg-indigo-600 shadow-[0_20px_50px_rgba(79,70,229,0.3)] text-white px-10 py-5 rounded-2xl hover:bg-indigo-700 hover:scale-105 active:scale-95 transition-all duration-300 font-black text-sm uppercase tracking-[0.2em] flex items-center group">
            <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
            Publicar Alterações
        </button>
    </div>
</form>

<!-- Quill.js for Rich Text -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quillOptions = {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'clean']
                ]
            }
        };

        const privacyEditor = new Quill('#privacy-editor', quillOptions);
        const termsEditor = new Quill('#terms-editor', quillOptions);

        const form = document.querySelector('form');
        form.onsubmit = function() {
            document.querySelector('#privacy-input').value = privacyEditor.root.innerHTML;
            document.querySelector('#terms-input').value = termsEditor.root.innerHTML;
        };
    });
</script>
