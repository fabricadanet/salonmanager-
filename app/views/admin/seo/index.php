<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-tight">SEO e Rastreamento</h2>
    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Integre ferramentas de análise e melhore a visibilidade do seu site.</p>
</div>

<?php if (isset($_GET['success'])): ?>
<div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-sm font-bold flex items-center shadow-sm rounded-r-lg">
    <svg class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
    Configurações salvas com sucesso!
</div>
<?php endif; ?>

<form action="/admin/seo/update" method="POST" class="space-y-8">
    <!-- Google Tag Manager / Analytics -->
    <div class="bg-white shadow-xl rounded-2xl p-8 border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 left-0 w-2 h-full bg-indigo-600"></div>
        <h3 class="text-lg font-black text-gray-900 mb-6 flex items-center uppercase tracking-tighter">
            <svg class="w-5 h-5 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            Google Tag Manager / Google Analytics
        </h3>
        
        <div class="space-y-4">
            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Snippet do Google Tag (Principal)</label>
            <textarea name="google_tag" rows="8" placeholder="Cole aqui o código fornecido pelo Google (G-XXXXXXXXXX ou GTM-XXXXXXX)..." class="w-full bg-gray-50 border-gray-200 rounded-xl p-4 text-xs font-mono text-gray-700 focus:ring-indigo-500 focus:border-indigo-500"><?= htmlspecialchars($seo['title'] ?? '') ?></textarea>
            <p class="text-[10px] text-gray-500 italic">Dica: Este código será injetado no topo de todas as páginas do site público.</p>
        </div>
    </div>

    <!-- Scripts Adicionais -->
    <div class="bg-gray-900 shadow-xl rounded-2xl p-8 border border-gray-800 overflow-hidden relative text-white">
        <div class="absolute top-0 left-0 w-2 h-full bg-pink-500"></div>
        <h3 class="text-lg font-black text-white mb-6 flex items-center uppercase tracking-tighter">
            <svg class="w-5 h-5 mr-3 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            Scripts e Meta Tags Adicionais (Header)
        </h3>
        
        <div class="space-y-4">
            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Conteúdo do Header Customizado</label>
            <textarea name="header_scripts" rows="12" placeholder="Ex: <meta name='robots' content='index, follow'> ou links para fontes externas..." class="w-full bg-gray-800 border-gray-700 rounded-xl p-4 text-xs font-mono text-indigo-300 focus:ring-pink-500 focus:border-pink-500"><?= htmlspecialchars($seo['content'] ?? '') ?></textarea>
            <p class="text-[10px] text-gray-500 italic">Cuidado: Scripts mal formatados podem quebrar o layout do site público.</p>
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-end">
        <button type="submit" class="bg-indigo-600 shadow-[0_20px_50px_rgba(79,70,229,0.3)] text-white px-10 py-5 rounded-2xl hover:bg-indigo-700 hover:scale-105 active:scale-95 transition-all duration-300 font-black text-sm uppercase tracking-[0.2em] flex items-center group">
            <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
            Salvar Configurações
        </button>
    </div>
</form>
