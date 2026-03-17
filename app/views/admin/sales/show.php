<div class="mb-8 flex justify-between items-end border-b border-gray-100 pb-6">
    <div>
        <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase">Venda #<?= $sale['id'] ?></h2>
        <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1">Detalhes do Registro</p>
    </div>
    <a href="/admin/sales" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-slate-900 transition-colors">&larr; Voltar para a lista</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Details -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white shadow-sm border border-gray-100 p-8">
            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Itens da Venda</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr>
                            <th class="px-0 py-3 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.1em]">Item</th>
                            <th class="px-4 py-3 text-center text-[10px] font-bold text-gray-400 uppercase tracking-[0.1em]">Qtd.</th>
                            <th class="px-4 py-3 text-right text-[10px] font-bold text-gray-400 uppercase tracking-[0.1em]">Unit.</th>
                            <th class="px-0 py-3 text-right text-[10px] font-bold text-gray-400 uppercase tracking-[0.1em]">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($items as $item): ?>
                        <tr>
                            <td class="px-0 py-4">
                                <div class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($item['item_name']) ?></div>
                                <div class="text-[9px] text-gray-400 uppercase tracking-widest mt-1">
                                    Profissional: <?= htmlspecialchars($item['professional_name'] ?: 'N/A') ?> 
                                    <span class="mx-1">•</span> 
                                    <?= $item['type'] === 'product' ? 'Produto' : 'Serviço' ?>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center text-sm font-bold text-slate-900"><?= $item['quantity'] ?></td>
                            <td class="px-4 py-4 text-right text-sm text-gray-500">R$ <?= number_format($item['unit_price'], 2, ',', '.') ?></td>
                            <td class="px-0 py-4 text-right text-sm font-black text-slate-900">R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-8 pt-8 border-t border-gray-100 flex justify-end">
                <div class="w-full md:w-64 space-y-3">
                    <div class="flex justify-between items-center text-xs uppercase tracking-widest text-gray-400 font-bold">
                        <span>Total dos Itens</span>
                        <span class="text-slate-900">R$ <?= number_format($sale['total_amount'], 2, ',', '.') ?></span>
                    </div>
                    <div class="flex justify-between items-center bg-slate-900 text-white p-4">
                        <span class="text-[10px] uppercase tracking-[0.3em] font-black">Total Pago</span>
                        <span class="text-lg font-black tracking-tight italic">R$ <?= number_format($sale['total_amount'], 2, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="space-y-8">
        <div class="bg-white shadow-sm border border-gray-100 p-8">
            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Informações Gerais</h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Cliente</label>
                    <div class="text-sm font-bold text-slate-900"><?= htmlspecialchars($sale['customer_name']) ?></div>
                </div>
                <div>
                    <label class="block text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Data da Venda</label>
                    <div class="text-sm font-medium text-slate-900"><?= date('d/m/Y H:i', strtotime($sale['created_at'])) ?></div>
                </div>
                <div>
                    <label class="block text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Método de Pagamento</label>
                    <div class="inline-block px-3 py-1 bg-gray-100 text-[10px] font-black uppercase tracking-widest text-gray-600">
                        <?= htmlspecialchars($sale['payment_method']) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <a href="/admin/sales/receipt?id=<?= $sale['id'] ?>&print=1" target="_blank" class="w-full inline-flex items-center justify-center px-6 py-4 bg-slate-900 text-white text-[10px] font-black uppercase tracking-[0.2em] hover:bg-slate-800 transition-all shadow-lg hover:shadow-slate-200">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Imprimir Cupom
            </a>
        </div>

        <div class="bg-slate-50 border border-slate-100 p-8 mt-8">
            <div class="flex items-center space-x-3 mb-4">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 italic">Observação Fiscal</span>
            </div>
            <p class="text-[10px] leading-relaxed text-slate-400 uppercase tracking-wider font-medium">
                Esta é uma visualização simplificada da venda de balcão realizada no terminal PDV em <?= date('d/m/Y', strtotime($sale['created_at'])) ?>.
            </p>
        </div>
    </div>
</div>
