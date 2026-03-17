<table class="w-full text-left border-collapse">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-100">
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Data</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Total Comissões do Dia</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
        <?php if (empty($commissions)): ?>
            <tr>
                <td colspan="2" class="px-6 py-8 text-center text-xs text-gray-400 italic">Nenhuma comissão registrada.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($commissions as $c): ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 text-xs font-bold text-slate-600"><?= date('d/m/Y', strtotime($c['date'])) ?></td>
                    <td class="px-6 py-4 text-xs font-bold text-right text-green-600 tracking-tighter">R$ <?= number_format($c['total_amount'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
