<table class="w-full text-left border-collapse">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-100">
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Data</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Produto</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Cliente</th>
            <th class="px-3 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Qtd</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
        <?php if (empty($products)): ?>
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-xs text-gray-400 italic">Nenhum produto vendido encontrado.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($products as $p): ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 text-xs font-bold text-slate-600"><?= date('d/m/Y', strtotime($p['sale_date'])) ?></td>
                    <td class="px-6 py-4 text-xs font-black text-slate-900 uppercase tracking-tighter"><?= htmlspecialchars($p['product_name']) ?></td>
                    <td class="px-6 py-4 text-xs text-gray-500"><?= htmlspecialchars($p['customer_name'] ?? 'Venda Direta') ?></td>
                    <td class="px-3 py-4 text-xs text-center text-gray-500"><?= $p['quantity'] ?></td>
                    <td class="px-6 py-4 text-xs font-bold text-right text-slate-900 tracking-tighter">R$ <?= number_format($p['subtotal'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
