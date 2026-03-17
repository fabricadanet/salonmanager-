<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Produto</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Qtd. Atual</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Status</th>
                <th class="px-6 py-4 text-right text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php foreach ($products as $p): ?>
            <?php 
                $isLow = (int)$p['stock_quantity'] <= (int)$p['min_stock_level'];
                $statusColor = $isLow ? 'text-red-600 bg-red-50' : 'text-emerald-600 bg-emerald-50';
                $statusText = $isLow ? 'Estoque Baixo' : 'Em Dia';
            ?>
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <?php if(!empty($p['image'])): ?>
                            <img src="<?= $p['image'] ?>" class="h-10 w-10 object-cover mr-3 grayscale hover:grayscale-0 transition-all">
                        <?php else: ?>
                            <div class="h-10 w-10 bg-gray-100 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                        <?php endif; ?>
                        <div>
                            <div class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($p['name']) ?></div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-widest">Mínimo: <?= $p['min_stock_level'] ?> unid.</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-black">
                    <?= $p['stock_quantity'] ?> unid.
                </td>
                <td class="px-6 py-4 whitespace-nowrap px-3 text-right">
                    <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest rounded-full <?= $statusColor ?>">
                        <?= $statusText ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-3">
                        <a href="/admin/stock/movement?product_id=<?= $p['id'] ?>" title="Movimentar" class="text-slate-900 hover:text-slate-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        </a>
                        <a href="/admin/stock/history?product_id=<?= $p['id'] ?>" title="Histórico" class="text-slate-900 hover:text-slate-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($products)): ?>
            <tr>
                <td colspan="4" class="px-6 py-12 text-center">
                    <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Nenhum produto em estoque</p>
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
        Mostrando <?= count($products) ?> de <?= $total ?> itens
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
