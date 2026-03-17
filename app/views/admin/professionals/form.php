<div class="mb-8 flex justify-between items-end border-b border-gray-100 pb-6">
    <div>
        <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase"><?= $item ? 'Editar Membro' : 'Novo Membro' ?></h2>
        <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1">Configuração de Equipe</p>
    </div>
    <a href="/admin/professionals" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-slate-900 transition-colors">&larr; Voltar para a lista</a>
</div>

<div class="bg-white shadow-sm border border-gray-100 p-8 max-w-4xl">
    <form action="<?= $item ? '/admin/professionals/update' : '/admin/professionals/store' ?>" method="POST" class="space-y-8">
        <?php if ($item): ?>
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nome Artístico / Profissional *</label>
                <input type="text" name="name" required value="<?= htmlspecialchars($item['name'] ?? '') ?>" 
                       placeholder="Ex: Rodrigo Barber"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none font-bold">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Especialidade Principal</label>
                <input type="text" name="specialty" value="<?= htmlspecialchars($item['specialty'] ?? '') ?>" 
                       placeholder="Ex: Barbeiro, Esteticista..."
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Comissão Geral (%) *</label>
                <input type="number" step="0.1" name="commission_percentage" required value="<?= $item['commission_percentage'] ?? 0 ?>" 
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>
        </div>

        <div class="pt-6 border-t border-gray-50 flex justify-end">
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-12 py-4 rounded-none shadow-sm text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:scale-[1.02] active:scale-[0.98]">
                <?= $item ? 'Atualizar Perfil' : 'Cadastrar Membro' ?>
            </button>
        </div>
    </form>
</div>

<?php if ($item): ?>
<div class="mt-12 space-y-16 max-w-6xl">
    <!-- Appointments History -->
    <div x-data="{ 
        search: '', from: '', to: '', loading: false,
        update() {
            this.loading = true;
            const params = new URLSearchParams({
                id: '<?= $item['id'] ?>',
                history_type: 'appointments',
                history_search: this.search,
                history_from: this.from,
                history_to: this.to
            });
            fetch('/admin/professionals/edit?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById('history-appointments-container').innerHTML = html;
                this.loading = false;
            });
        }
    }">
        <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-end border-b border-gray-100 pb-4 gap-4">
            <div>
                <h3 class="text-xl font-bold text-slate-900 tracking-tighter uppercase">Histórico de Agendamentos</h3>
                <p class="text-[9px] text-gray-400 uppercase tracking-[0.3em] font-black mt-1">Serviços realizados pelo profissional</p>
            </div>
            
            <div class="flex flex-wrap gap-2 items-center">
                <input type="text" x-model="search" @input.debounce.500ms="update()" placeholder="Buscar serviço ou cliente..." class="text-[10px] uppercase font-bold tracking-widest bg-gray-50 border-none px-3 py-2 focus:ring-1 focus:ring-slate-900 w-48">
                <div class="flex items-center bg-gray-50 px-2">
                    <input type="date" x-model="from" @change="update()" class="text-[10px] bg-transparent border-none p-2 focus:ring-0">
                    <span class="text-[10px] text-gray-300 mx-1">até</span>
                    <input type="date" x-model="to" @change="update()" class="text-[10px] bg-transparent border-none p-2 focus:ring-0">
                </div>
                <div x-show="loading" class="ml-2">
                    <svg class="animate-spin h-4 w-4 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>
            </div>
        </div>
        
        <div id="history-appointments-container" class="bg-white border border-gray-100 overflow-hidden shadow-sm">
            <?php require __DIR__ . '/history_appointments.php'; ?>
        </div>
    </div>

    <!-- Products History -->
    <div x-data="{ 
        search: '', from: '', to: '', loading: false,
        update() {
            this.loading = true;
            const params = new URLSearchParams({
                id: '<?= $item['id'] ?>',
                history_type: 'products',
                history_search: this.search,
                history_from: this.from,
                history_to: this.to
            });
            fetch('/admin/professionals/edit?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById('history-products-container').innerHTML = html;
                this.loading = false;
            });
        }
    }">
        <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-end border-b border-gray-100 pb-4 gap-4">
            <div>
                <h3 class="text-xl font-bold text-slate-900 tracking-tighter uppercase">Produtos Vendidos</h3>
                <p class="text-[9px] text-gray-400 uppercase tracking-[0.3em] font-black mt-1">Vendas diretas realizadas</p>
            </div>

            <div class="flex flex-wrap gap-2 items-center">
                <input type="text" x-model="search" @input.debounce.500ms="update()" placeholder="Buscar produto ou cliente..." class="text-[10px] uppercase font-bold tracking-widest bg-gray-50 border-none px-3 py-2 focus:ring-1 focus:ring-slate-900 w-48">
                <div class="flex items-center bg-gray-50 px-2">
                    <input type="date" x-model="from" @change="update()" class="text-[10px] bg-transparent border-none p-2 focus:ring-0">
                    <span class="text-[10px] text-gray-300 mx-1">até</span>
                    <input type="date" x-model="to" @change="update()" class="text-[10px] bg-transparent border-none p-2 focus:ring-0">
                </div>
                <div x-show="loading" class="ml-2">
                    <svg class="animate-spin h-4 w-4 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>
            </div>
        </div>
        
        <div id="history-products-container" class="bg-white border border-gray-100 overflow-hidden shadow-sm">
            <?php require __DIR__ . '/history_products.php'; ?>
        </div>
    </div>

    <!-- Commissions History -->
    <div x-data="{ 
        from: '', to: '', loading: false,
        update() {
            this.loading = true;
            const params = new URLSearchParams({
                id: '<?= $item['id'] ?>',
                history_type: 'commissions',
                history_from: this.from,
                history_to: this.to
            });
            fetch('/admin/professionals/edit?' + params.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById('history-commissions-container').innerHTML = html;
                this.loading = false;
            });
        }
    }">
        <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-end border-b border-gray-100 pb-4 gap-4">
            <div>
                <h3 class="text-xl font-bold text-slate-900 tracking-tighter uppercase">Comissões Pagas</h3>
                <p class="text-[9px] text-gray-400 uppercase tracking-[0.3em] font-black mt-1">Totais diários (Financeiro)</p>
            </div>

            <div class="flex flex-wrap gap-2 items-center">
                <div class="flex items-center bg-gray-50 px-2">
                    <input type="date" x-model="from" @change="update()" class="text-[10px] bg-transparent border-none p-2 focus:ring-0">
                    <span class="text-[10px] text-gray-300 mx-1">até</span>
                    <input type="date" x-model="to" @change="update()" class="text-[10px] bg-transparent border-none p-2 focus:ring-0">
                </div>
                <div x-show="loading" class="ml-2">
                    <svg class="animate-spin h-4 w-4 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </div>
            </div>
        </div>
        
        <div id="history-commissions-container" class="bg-white border border-gray-100 overflow-hidden shadow-sm">
            <?php require __DIR__ . '/history_commissions.php'; ?>
        </div>
    </div>
</div>
<?php endif; ?>
