<div class="py-16 bg-white min-h-[60vh]">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center" x-data="contactApp()">
        <h1 class="text-3xl font-extrabold text-gray-900">Fale Conosco</h1>
        <p class="mt-4 text-lg text-gray-500 mb-10">Envie-nos uma mensagem diretamente pelo WhatsApp.</p>
        
        <?php if (!empty($data['contact']['content'])): ?>
            <div class="mb-8 p-4 bg-gray-50 rounded-lg text-gray-600">
                <?= htmlspecialchars($data['contact']['content']) ?>
            </div>
        <?php endif; ?>

        <div class="space-y-6 text-left">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Seu Nome</label>
                <input type="text" x-model="name" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                <input type="text" x-model="phone" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mensagem</label>
                <textarea x-model="message" rows="4" class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            </div>

            <button @click="sendMessage()" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                Enviar pelo WhatsApp
            </button>
        </div>
    </div>
</div>

<script>
    function contactApp() {
        return {
            name: '',
            phone: '',
            message: '',
            salonPhone: '<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>',
            
            sendMessage() {
                if (!this.name || !this.message) {
                    alert("Preencha nome e mensagem.");
                    return;
                }
                
                let text = `Olá! Entrei em contato através do site.\n\n`;
                text += `Nome: ${this.name}\n`;
                if(this.phone) text += `Telefone: ${this.phone}\n`;
                text += `Mensagem: ${this.message}`;
                
                const encoded = encodeURIComponent(text);
                const url = `https://wa.me/${this.salonPhone}?text=${encoded}`;
                window.open(url, '_blank');
            }
        }
    }
</script>
