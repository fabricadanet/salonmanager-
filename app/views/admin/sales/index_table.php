<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">ID/Data</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Cliente</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Pagamento</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Total</th>
                <th class="px-6 py-4 text-right text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php foreach ($sales as $s): ?>
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900">#<?= $s['id'] ?></div>
                    <div class="text-[10px] text-gray-400 uppercase tracking-widest"><?= date('d/m/Y H:i', strtotime($s['created_at'])) ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-600 font-medium"><?= htmlspecialchars($s['customer_name'] ?? 'Cliente Avulso') ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest bg-gray-100 text-gray-600 rounded-full">
                        <?= htmlspecialchars($s['payment_method']) ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-black">
                    R$ <?= number_format($s['total_amount'], 2, ',', '.') ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-3">
                        <a href="/admin/sales/details?id=<?= $s['id'] ?>" class="text-slate-900 hover:text-slate-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($sales)): ?>
            <tr>
                <td colspan="5" class="px-6 py-12 text-center">
                    <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Nenhuma venda encontrada</p>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<div class="bg-white px-6 py-4 flex items-center justify-between border-t border-gray-100">
    <div class="text-xs text-gray-400 uppercase tracking-widest font-bold">
        Mostrando <?= count($sales) ?> de <?= $total ?> vendas
    </div>
    <div class="flex space-x-2">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <button @click="updateTable(<?= $i ?>)" 
                    class="px-3 py-1 text-xs font-bold uppercase tracking-widest transition-all rounded <?= $i == $page ? 'bg-slate-900 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' ?>">
                <?= $i ?>
            </button>
        <?php endfor; ?>
    </div>
</div>
<?php endif; ?>
