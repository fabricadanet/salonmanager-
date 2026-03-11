<!-- PDV / Frente de Caixa View using AlpineJS -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

<div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
    <div>
        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Frente de Caixa (PDV)</h2>
        <p class="text-sm text-gray-500 mt-1">Registre vendas rápidas de produtos e serviços.</p>
    </div>
    <a href="/admin/sales" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Histórico de Vendas
    </a>
</div>

<div x-data="posApp()" class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">
    
    <!-- Esquerda: Formulários -->
    <div class="xl:col-span-2 space-y-8">
        
        <!-- Cliente -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-indigo-50/50 px-6 py-4 border-b border-indigo-100 flex items-center">
                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">1. Identificação do Cliente</h3>
            </div>
            <div class="p-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Selecione o Cliente (Opcional)</label>
                <div class="relative">
                    <select x-model="customerId" class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-xl transition-shadow bg-gray-50 hover:bg-white border">
                        <option value="">-- Cliente Avulso --</option>
                        <?php foreach($customers as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?> (<?= htmlspecialchars($c['phone']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Adicionar Item -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-fuchsia-50/50 px-6 py-4 border-b border-fuchsia-100 flex items-center">
                <div class="bg-fuchsia-100 p-2 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-fuchsia-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">2. Lançamento de Itens</h3>
            </div>
            <div class="p-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo do Item</label>
                        <select x-model="newItem.type" @change="newItem.item_id = ''; updateNewItemPrice()" class="block w-full py-3 px-4 border-gray-300 bg-gray-50 focus:bg-white focus:ring-fuchsia-500 focus:border-fuchsia-500 rounded-xl border transition-colors shadow-sm">
                            <option value="product">📦 Produto Físico</option>
                            <option value="service">✂️ Serviço</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Item</label>
                        
                        <!-- Select para Produtos -->
                        <select x-show="newItem.type === 'product'" x-model="newItem.item_id" @change="updateNewItemPrice()" class="block w-full py-3 px-4 border-gray-300 bg-gray-50 focus:bg-white focus:ring-fuchsia-500 focus:border-fuchsia-500 rounded-xl border transition-colors shadow-sm">
                            <option value="">Selecione um Produto...</option>
                            <?php foreach($products as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= $p['stock_quantity'] <= 0 ? 'disabled' : '' ?>><?= htmlspecialchars($p['name']) ?> (Estoque: <?= $p['stock_quantity'] ?>) - R$ <?= number_format($p['price'], 2, ',', '.') ?></option>
                            <?php endforeach; ?>
                        </select>

                        <!-- Select para Serviços -->
                        <select x-show="newItem.type === 'service'" style="display: none;" x-model="newItem.item_id" @change="updateNewItemPrice()" class="block w-full py-3 px-4 border-gray-300 bg-gray-50 focus:bg-white focus:ring-fuchsia-500 focus:border-fuchsia-500 rounded-xl border transition-colors shadow-sm">
                            <option value="">Selecione um Serviço...</option>
                            <?php foreach($services as $s): ?>
                                <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?> - R$ <?= number_format($s['price'], 2, ',', '.') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 border-t border-gray-100 pt-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Qtd.</label>
                        <input type="number" min="1" x-model.number="newItem.quantity" class="block w-full py-3 px-4 border-gray-300 bg-gray-50 focus:bg-white focus:ring-fuchsia-500 focus:border-fuchsia-500 rounded-xl border transition-colors shadow-sm text-center font-bold text-lg">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Profissional (Para Comissão)</label>
                        <select x-model="newItem.professional_id" class="block w-full py-3 px-4 border-gray-300 bg-gray-50 focus:bg-white focus:ring-fuchsia-500 focus:border-fuchsia-500 rounded-xl border transition-colors shadow-sm">
                            <option value="">-- Sem Profissional (Venda de Balcão) --</option>
                            <?php foreach($professionals as $p): ?>
                                <option value="<?= $p['id'] ?>">⭐ <?= htmlspecialchars($p['name']) ?> (<?= $p['commission_percentage'] ?>%)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-center bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <div class="text-gray-500 mb-4 sm:mb-0">
                        Subtotal do Item: <br>
                        <span class="font-black text-2xl text-gray-900">R$ <span x-text="(newItemPrice * newItem.quantity).toFixed(2)"></span></span>
                    </div>
                    <button type="button" @click="addItem()" :disabled="!newItem.item_id || newItem.quantity < 1" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 disabled:opacity-50 transition-all shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        Adicionar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Direita: Carrinho e Checkout -->
    <div class="xl:col-span-1">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden sticky top-6 flex flex-col" style="max-height: calc(100vh - 3rem);">
            
            <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-5 flex items-center justify-between">
                <h3 class="text-xl font-black text-white flex items-center">
                    <svg class="w-6 h-6 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Resumo do Cupom
                </h3>
                <span class="bg-white text-gray-900 text-xs font-bold px-2 py-1 rounded-full shadow-sm" x-text="cart.length + ' Itens'"></span>
            </div>
            
            <div class="p-6 flex-1 overflow-y-auto bg-gray-50/50">
                <template x-if="cart.length === 0">
                    <div class="text-center py-10">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 font-medium">Carrinho vazio.<br>Adicione itens para continuar.</p>
                    </div>
                </template>

                <ul class="space-y-3">
                    <template x-for="(item, index) in cart" :key="index">
                        <li class="bg-white border text-sm border-gray-100 p-4 rounded-xl shadow-sm relative group hover:shadow-md transition-shadow">
                            <button @click="removeItem(index)" class="absolute -top-2 -right-2 bg-red-100 text-red-600 rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-200 focus:outline-none">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                            <div class="flex justify-between items-start mb-2">
                                <span class="font-bold text-gray-900 pr-4" x-text="item.name"></span>
                                <span class="font-black text-gray-900 whitespace-nowrap">R$ <span x-text="item.subtotal.toFixed(2)"></span></span>
                            </div>
                            <div class="flex justify-between items-center text-xs text-gray-500">
                                <span><span x-text="item.quantity"></span>x R$ <span x-text="item.unit_price.toFixed(2)"></span></span>
                                <template x-if="item.type === 'product'">
                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded font-medium">Produto</span>
                                </template>
                                <template x-if="item.type === 'service'">
                                    <span class="px-2 py-0.5 bg-fuchsia-100 text-fuchsia-700 rounded font-medium">Serviço</span>
                                </template>
                            </div>
                            <template x-if="item.professional_name">
                                <div class="mt-3 text-xs text-indigo-700 bg-indigo-50 border border-indigo-100 inline-block px-2 py-1.5 rounded-md font-medium">
                                    Profissional: <span x-text="item.professional_name"></span>
                                </div>
                            </template>
                        </li>
                    </template>
                </ul>
            </div>

            <div class="p-6 bg-white border-t border-gray-100 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-500 font-medium text-lg">Total a Pagar</span>
                    <span class="text-3xl font-black text-emerald-600 tracking-tight">R$ <span x-text="cartTotal.toFixed(2)"></span></span>
                </div>

                <!-- Pagamento -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Forma de Pagamento</label>
                    <select x-model="paymentMethod" class="block w-full py-3 px-4 border-gray-300 bg-gray-50 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 rounded-xl border transition-colors shadow-sm font-medium text-gray-900">
                        <option value="dinheiro">💵 Dinheiro</option>
                        <option value="pix">✨ PIX</option>
                        <option value="cartao credito">💳 Cartão de Crédito</option>
                        <option value="cartao debito">💳 Cartão de Débito</option>
                    </select>
                </div>

                <button type="button" @click="checkout()" :disabled="cart.length === 0 || isProcessing" class="w-full relative flex items-center justify-center px-8 py-4 border border-transparent text-lg font-black rounded-xl text-white bg-emerald-500 hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all shadow-lg hover:shadow-emerald-500/30 disabled:opacity-50 disabled:cursor-not-allowed group">
                    <span x-show="!isProcessing" class="flex items-center">
                        <svg class="w-6 h-6 mr-2 -ml-1 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        FINALIZAR VENDA
                    </span>
                    <span x-show="isProcessing" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processando...
                    </span>
                </button>
                
                <div x-show="errorMsg" x-transition class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg flex items-center">
                    <svg class="h-5 w-5 text-red-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p x-text="errorMsg" class="text-red-700 text-sm font-medium"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const productsData = <?= json_encode(array_map(function($p){ return ['id' => $p['id'], 'name' => $p['name'], 'price' => (float)$p['price'], 'stock' => (int)$p['stock_quantity']]; }, $products)) ?>;
    const servicesData = <?= json_encode(array_map(function($s){ return ['id' => $s['id'], 'name' => $s['name'], 'price' => (float)$s['price']]; }, $services)) ?>;
    const profsData = <?= json_encode(array_map(function($p){ return ['id' => $p['id'], 'name' => $p['name']]; }, $professionals)) ?>;

    document.addEventListener('alpine:init', () => {
        Alpine.data('posApp', () => ({
            products: productsData,
            services: servicesData,
            professionals: profsData,
            
            customerId: '',
            paymentMethod: 'dinheiro',
            
            newItem: {
                type: 'product',
                item_id: '',
                quantity: 1,
                professional_id: ''
            },
            newItemPrice: 0,
            
            cart: [],
            isProcessing: false,
            errorMsg: '',

            updateNewItemPrice() {
                this.newItemPrice = 0;
                if (!this.newItem.item_id) return;
                
                let source = this.newItem.type === 'product' ? this.products : this.services;
                let found = source.find(x => x.id == this.newItem.item_id);
                if (found) {
                    this.newItemPrice = found.price;
                }
            },

            addItem() {
                if (!this.newItem.item_id || this.newItem.quantity < 1) return;
                
                let source = this.newItem.type === 'product' ? this.products : this.services;
                let found = source.find(x => x.id == this.newItem.item_id);
                let profName = '';
                if (this.newItem.professional_id) {
                    let prof = this.professionals.find(x => x.id == this.newItem.professional_id);
                    if (prof) profName = prof.name;
                }

                if (!found) return;

                if (this.newItem.type === 'product' && this.newItem.quantity > found.stock) {
                    alert('Aviso: A quantidade inserida ('+this.newItem.quantity+') é maior que o estoque atual disponível ('+found.stock+').');
                }

                this.cart.push({
                    type: this.newItem.type,
                    item_id: this.newItem.item_id,
                    name: found.name,
                    quantity: this.newItem.quantity,
                    unit_price: found.price,
                    subtotal: found.price * this.newItem.quantity,
                    professional_id: this.newItem.professional_id,
                    professional_name: profName
                });

                // Reset form
                this.newItem.item_id = '';
                this.newItem.quantity = 1;
                this.newItem.professional_id = '';
                this.newItemPrice = 0;
            },

            removeItem(index) {
                this.cart.splice(index, 1);
            },

            get cartTotal() {
                return this.cart.reduce((total, item) => total + item.subtotal, 0);
            },

            async checkout() {
                if (this.cart.length === 0) return;
                
                this.isProcessing = true;
                this.errorMsg = '';

                let payload = {
                    customer_id: this.customerId,
                    payment_method: this.paymentMethod,
                    items: this.cart.map(i => ({
                        type: i.type,
                        item_id: i.item_id,
                        quantity: i.quantity,
                        professional_id: i.professional_id
                    }))
                };

                try {
                    let response = await fetch('/admin/sales/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });
                    
                    let result = await response.json();
                    
                    if (result.success) {
                        window.location.href = result.redirect;
                    } else {
                        this.errorMsg = result.message || 'Erro do servidor ao processar venda: ' + escapeHtml(result.message);
                        this.isProcessing = false;
                    }
                } catch (e) {
                    this.errorMsg = 'Erro de rede. Verifique o terminal PHP.';
                    this.isProcessing = false;
                }
            }
        }));
    });
    
    function escapeHtml(unsafe) {
        return (unsafe || '').toString()
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
    }
</script>
