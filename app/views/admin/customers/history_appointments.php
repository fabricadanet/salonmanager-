<table class="w-full text-left border-collapse">
    <thead>
        <tr class="bg-gray-50 border-b border-gray-100">
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Data</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Horário</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Serviço</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Profissional</th>
            <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-slate-400">Status</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-50">
        <?php if (empty($appointments)): ?>
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-xs text-gray-400 italic">Nenhum agendamento encontrado.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($appointments as $app): ?>
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 text-xs font-bold text-slate-600"><?= date('d/m/Y', strtotime($app['appointment_date'])) ?></td>
                    <td class="px-6 py-4 text-xs text-gray-500"><?= $app['start_time'] ?> - <?= $app['end_time'] ?></td>
                    <td class="px-6 py-4 text-xs font-black text-slate-900 uppercase tracking-tighter"><?= htmlspecialchars($app['service_name']) ?></td>
                    <td class="px-6 py-4 text-xs text-gray-500"><?= htmlspecialchars($app['professional_name']) ?></td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-[9px] font-black uppercase tracking-widest rounded-full 
                            <?= $app['status'] === 'concluido' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' ?>">
                            <?= $app['status'] ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
