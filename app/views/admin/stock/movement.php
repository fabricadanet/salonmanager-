<div class="mb-8 flex justify-between items-end border-b border-gray-100 pb-6">
    <div>
        <h2 class="text-3xl font-bold text-slate-900 tracking-tighter uppercase">Movimentar Estoque</h2>
        <p class="text-xs text-gray-400 uppercase tracking-[0.3em] font-bold mt-1"><?= htmlspecialchars($product['name']) ?></p>
    </div>
    <a href="/admin/stock" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-slate-900 transition-colors">&larr; Voltar</a>
</div>

<div class="bg-white shadow-sm border border-gray-100 p-8 max-w-2xl">
    <form action="/admin/stock/store_movement" method="POST" class="space-y-8">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

        <div class="space-y-6">
            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Tipo de Movimentação *</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative flex items-center justify-center p-4 border cursor-pointer hover:bg-gray-50 transition-all [&:has(input:checked)]:border-slate-900 [&:has(input:checked)]:ring-1 [&:has(input:checked)]:ring-slate-900">
                        <input type="radio" name="type" value="in" required class="sr-only" checked>
                        <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600">Entrada (+)</span>
                    </label>
                    <label class="relative flex items-center justify-center p-4 border cursor-pointer hover:bg-gray-50 transition-all [&:has(input:checked)]:border-slate-900 [&:has(input:checked)]:ring-1 [&:has(input:checked)]:ring-slate-900">
                        <input type="radio" name="type" value="out" required class="sr-only">
                        <span class="text-[10px] font-black uppercase tracking-widest text-red-600">Saída (-)</span>
                    </label>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Quantidade *</label>
                <input type="number" name="quantity" required min="1" placeholder="0"
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none font-bold">
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Motivo / Observação *</label>
                <input type="text" name="reason" required placeholder="Ex: Compra de fornecedor, Ajuste de inventário..."
                       class="w-full bg-gray-50 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 transition-all rounded-none">
            </div>
        </div>

        <div class="pt-6 border-t border-gray-50">
            <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white px-12 py-4 rounded-none shadow-sm text-[10px] font-black uppercase tracking-[0.2em] transition-all hover:scale-[1.01] active:scale-[0.99]">
                Registrar Movimentação
            </button>
        </div>
    </form>
</div>
