<div x-data="{ 
    search: '<?= $search ?? '' ?>',
    loading: false,
    updateTable(page = 1) {
        this.loading = true;
        const params = new URLSearchParams({
            page: page,
            search: this.search
        });
        
        const newUrl = `${window.location.pathname}?${params.toString()}`;
        window.history.pushState({}, '', newUrl);

        fetch(newUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('table-container').innerHTML = html;
            this.loading = false;
        })
        .catch(err => {
            console.error(err);
            this.loading = false;
        });
    }
}" x-init="$watch('search', () => { if(search.length >= 2 || search.length == 0) updateTable(1) })">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase">Usuários</h2>
            <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1">Gestão de Acessos ao Sistema</p>
        </div>
        <a href="/admin/users/create" class="bg-slate-900 hover:bg-slate-800 text-white px-8 py-3 rounded-none shadow-sm text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-[0.98]">
            + Novo Acesso
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white p-6 mb-6 shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Buscar por Nome</label>
                <div class="relative">
                    <input type="text" x-model.debounce.500ms="search" placeholder="Nome do usuário..." 
                           class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
                    <div x-show="loading" class="absolute right-3 top-3">
                        <svg class="animate-spin h-4 w-4 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div id="table-container" class="bg-white shadow-sm border border-gray-100 overflow-hidden">
        <?php require __DIR__ . '/index_table.php'; ?>
    </div>
</div>
