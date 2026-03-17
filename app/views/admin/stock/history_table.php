<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Data/Hora</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Tipo</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Quant.</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Motivo</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php foreach ($movements as $m): ?>
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                    <?= date('d/m/Y H:i', strtotime($m['created_at'])) ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest rounded-full <?= $m['type'] === 'in' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' ?>">
                        <?= $m['type'] === 'in' ? 'Entrada' : 'Saída' ?>
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-black">
                    <?= ($m['type'] === 'in' ? '+' : '-') . $m['quantity'] ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                    <?= htmlspecialchars($m['reason']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($movements)): ?>
            <tr>
                <td colspan="4" class="px-6 py-12 text-center">
                    <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Nenhuma movimentação registrada</p>
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
        Mostrando <?= count($movements) ?> de <?= $total ?> registros
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
