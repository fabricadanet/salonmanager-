<div class="mb-6 border-b border-gray-200 pb-4">
    <h2 class="text-2xl font-bold text-gray-800">Conteúdo do Site Público</h2>
    <p class="text-sm text-gray-500">Edite as informações exibidas no site para os clientes.</p>
</div>

<form action="/admin/content/update" method="POST" class="space-y-8">
    
    <!-- Hero Section -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Seção Principal (Hero)</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Título Principal</label>
                <input type="text" name="hero[title]" value="<?= htmlspecialchars($content['hero']['title'] ?? '') ?>" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Subtítulo</label>
                <input type="text" name="hero[subtitle]" value="<?= htmlspecialchars($content['hero']['subtitle'] ?? '') ?>" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Texto Resumo</label>
                <textarea name="hero[content]" rows="2" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2"><?= htmlspecialchars($content['hero']['content'] ?? '') ?></textarea>
            </div>
        </div>
    </div>

    <!-- Quem Somos -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Quem Somos</h3>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Título</label>
            <input type="text" name="about[title]" value="<?= htmlspecialchars($content['about']['title'] ?? '') ?>" class="w-full border-gray-300 rounded shadow-sm border p-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Conteúdo</label>
            <textarea name="about[content]" rows="4" class="w-full border-gray-300 rounded shadow-sm border p-2"><?= htmlspecialchars($content['about']['content'] ?? '') ?></textarea>
        </div>
    </div>

    <!-- Contato e WhatsApp -->
    <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Contato e Redes</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Número WhatsApp (Ex: 5511999999999)</label>
                <input type="text" name="whatsapp[content]" value="<?= htmlspecialchars($content['whatsapp']['content'] ?? '') ?>" class="w-full border-gray-300 rounded shadow-sm border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Endereço Fiscal / Texto Contato</label>
                <input type="text" name="contact[content]" value="<?= htmlspecialchars($content['contact']['content'] ?? '') ?>" class="w-full border-gray-300 rounded shadow-sm border p-2">
            </div>
        </div>
    </div>

    <div class="flex justify-end sticky bottom-4">
        <button type="submit" class="bg-indigo-600 shadow-lg text-white px-6 py-3 rounded-md hover:bg-indigo-700 font-bold text-lg">
            Salvar Alterações do Site
        </button>
    </div>
</form>
