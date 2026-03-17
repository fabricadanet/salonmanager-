<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Profissional</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Especialidade</th>
                <th class="px-6 py-4 text-left text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Comissão</th>
                <th class="px-6 py-4 text-right text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Ações</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            <?php foreach ($items as $item): ?>
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="h-10 w-10 bg-slate-100 flex items-center justify-center mr-3 rounded-full">
                            <span class="text-xs font-black text-slate-400 uppercase"><?= mb_substr($item['name'], 0, 2) ?></span>
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($item['name']) ?></div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-widest"><?= htmlspecialchars($item['email'] ?: 'Sem e-mail') ?></div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                    <?= htmlspecialchars($item['specialty'] ?: 'Geral') ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-black">
                    <?= number_format($item['commission_percentage'], 1) ?>%
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-3">
                        <a href="/admin/professionals/edit?id=<?= $item['id'] ?>" class="text-slate-900 hover:text-slate-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="/admin/professionals/delete" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza?');">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (empty($items)): ?>
            <tr>
                <td colspan="4" class="px-6 py-12 text-center">
                    <p class="text-sm text-gray-400 uppercase tracking-widest font-bold">Nenhum profissional cadastrado</p>
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
        Mostrando <?= count($items) ?> de <?= $total ?> profissionais
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
