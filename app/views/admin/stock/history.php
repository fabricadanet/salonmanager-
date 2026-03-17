<div x-data="{ 
    loading: false,
    updateTable(page = 1) {
        this.loading = true;
        const params = new URLSearchParams({
            product_id: '<?= $product['id'] ?>',
            page: page
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
    <div class="mb-8 flex justify-between items-end border-b border-gray-100 pb-6">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase">Histórico de Estoque</h2>
            <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1"><?= htmlspecialchars($product['name']) ?></p>
        </div>
        <div class="flex items-center space-x-6">
            <div x-show="loading" class="animate-spin h-4 w-4 text-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            </div>
            <a href="/admin/stock" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-slate-900 transition-colors">&larr; Voltar</a>
        </div>
    </div>

    <div id="table-container" class="bg-white shadow-sm border border-gray-100 overflow-hidden">
        <?php require __DIR__ . '/history_table.php'; ?>
    </div>
</div>
