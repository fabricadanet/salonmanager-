<div x-data="{ 
    dateFrom: '<?= $dateFrom ?? '' ?>',
    dateTo: '<?= $dateTo ?? '' ?>',
    loading: false,
    updateTable(page = 1) {
        this.loading = true;
        const params = new URLSearchParams({
            page: page,
            date_from: this.dateFrom,
            date_to: this.dateTo
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
}">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase">Vendas</h2>
            <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1">Histórico de Transações</p>
        </div>
        <a href="/admin/sales/create" class="bg-slate-900 hover:bg-slate-800 text-white px-10 py-3 rounded-none shadow-sm text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-[0.98]">
            Nova Venda (PDV)
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white p-6 mb-6 shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row items-end gap-6">
            <div class="flex-1 space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">De:</label>
                <input type="date" x-model="dateFrom" @change="updateTable(1)"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>
            <div class="flex-1 space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Até:</label>
                <input type="date" x-model="dateTo" @change="updateTable(1)"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>
            <button @click="dateFrom = ''; dateTo = ''; updateTable(1)" 
                    class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-3 text-[10px] font-black uppercase tracking-[0.2em] transition-all rounded-none">
                Limpar
            </button>
            <div x-show="loading" class="flex items-center pb-3">
                <svg class="animate-spin h-5 w-5 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div id="table-container" class="bg-white shadow-sm border border-gray-100 overflow-hidden">
        <?php require __DIR__ . '/index_table.php'; ?>
    </div>
</div>
