<table class="w-full text-left border-collapse">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-100">
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Data</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Item</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Tipo</th>
            <th class="px-3 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Qtd</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Valor Unit.</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
        <?php if (empty($consumption)): ?>
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-xs text-gray-400 italic">Nenhum registro de consumo encontrado.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($consumption as $item): ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 text-xs font-bold text-slate-600"><?= date('d/m/Y', strtotime($item['sale_date'])) ?></td>
                    <td class="px-6 py-4 text-xs font-black text-slate-900 uppercase tracking-tighter"><?= htmlspecialchars($item['item_name']) ?></td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-[8px] font-black uppercase tracking-widest border border-gray-200 text-gray-400">
                            <?= $item['type'] === 'service' ? 'Serviço' : 'Produto' ?>
                        </span>
                    </td>
                    <td class="px-3 py-4 text-xs text-center text-gray-500"><?= $item['quantity'] ?></td>
                    <td class="px-6 py-4 text-xs text-right text-gray-500">R$ <?= number_format($item['unit_price'], 2, ',', '.') ?></td>
                    <td class="px-6 py-4 text-xs font-bold text-right text-slate-900 tracking-tighter">R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
