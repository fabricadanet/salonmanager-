<section class="max-w-6xl mx-auto px-6 py-20 lg:py-32" x-data="cartApp()">
    <div class="mb-20 flex flex-col md:flex-row justify-between items-end gap-12 reveal">
        <div class="max-w-2xl">
            <h1 class="text-6xl font-extrabold tracking-tighter text-slate-900 leading-none mb-6">BOUTIQUE.</h1>
            <p class="text-slate-500 font-medium text-lg leading-relaxed">Produtos selecionados para a manutenção do seu design em casa.</p>
        </div>
        <button @click="openCart = true" class="relative bg-slate-100 p-6 rounded-sm hover:bg-slate-200 transition-colors">
            <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <template x-if="cart.length > 0">
                <span class="absolute top-4 right-4 bg-slate-900 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full" x-text="cart.length"></span>
            </template>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 reveal">
        <?php foreach ($products as $product): ?>
        <div class="group border-b border-slate-50 pb-12">
            <div class="bg-slate-50 aspect-square rounded-3xl mb-8 flex items-center justify-center overflow-hidden relative shadow-sm hover:shadow-2xl transition-all duration-700">
                <?php if ($product['image']): ?>
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center opacity-20">
                         <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                    </div>
                <?php endif; ?>
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black text-slate-900 shadow-sm">
                    R$ <?= number_format($product['price'], 2, ',', '.') ?>
                </div>
            </div>
            <div class="space-y-4 mb-8">
                <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tighter group-hover:text-indigo-600 transition-colors"><?= htmlspecialchars($product['name']) ?></h3>
                <p class="text-slate-400 text-xs font-medium leading-relaxed italic line-clamp-2"><?= htmlspecialchars($product['description']) ?></p>
            </div>
            <button @click="addToCart(<?= htmlspecialchars(json_encode($product)) ?>)" 
                    class="w-full bg-slate-900 shadow-lg text-white py-5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-slate-800 hover:scale-[1.02] active:scale-[0.98] transition-all">
                Adicionar à Sacola
            </button>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Modern Shopping Cart UI -->
    <div x-show="openCart" x-cloak class="fixed inset-0 z-[100] overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" @click="openCart = false"></div>
        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <div class="pointer-events-auto w-screen max-w-md">
                <div class="flex h-full flex-col bg-white shadow-2xl">
                    <div class="flex-1 overflow-y-auto px-8 py-12">
                        <div class="flex items-start justify-between border-b pb-8 border-slate-100 mb-8">
                            <h2 class="text-2xl font-black text-slate-900 tracking-tighter uppercase" id="slide-over-title">Sua Sacola</h2>
                            <button @click="openCart = false" class="text-slate-400 hover:text-slate-900">
                                <span class="sr-only">Fechar</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>

                        <div class="space-y-8">
                            <template x-for="item in cart" :key="item.id">
                                <div class="flex items-center justify-between group">
                                    <div class="flex items-center space-x-6">
                                        <div class="w-16 h-16 bg-slate-50 flex-shrink-0 flex items-center justify-center font-bold text-slate-300 text-[10px] uppercase tracking-tighter overflow-hidden">
                                            <template x-if="item.image">
                                                <img :src="item.image" class="w-full h-full object-cover">
                                            </template>
                                            <template x-if="!item.image"><span>Shop</span></template>
                                        </div>
                                        <div>
                                            <p class="text-sm font-extrabold text-slate-900 uppercase tracking-tight" x-text="item.name"></p>
                                            <p class="text-xs font-bold text-slate-400 mt-1" x-text="'R$ ' + parseFloat(item.price).toLocaleString('pt-BR', {minimumFractionDigits: 2})"></p>
                                        </div>
                                    </div>
                                    <button @click="removeFromCart(item.id)" class="text-slate-300 hover:text-red-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </template>
                            <template x-if="cart.length === 0">
                                <div class="text-center py-20 bg-slate-50 border-2 border-dashed border-slate-200">
                                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Sua sacola está vazia.</p>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 bg-slate-50 p-8 sm:px-12">
                        <div class="flex justify-between text-base font-extrabold text-slate-900 uppercase tracking-tighter mb-8">
                            <p>Total Estimado</p>
                            <p x-text="'R$ ' + cartTotal().toLocaleString('pt-BR', {minimumFractionDigits: 2})"></p>
                        </div>
                        
                        <div class="space-y-4">
                            <input type="text" x-model="customer.name" placeholder="NOME COMPLETO" class="w-full bg-white border border-slate-200 p-4 text-xs font-bold placeholder:text-slate-300 focus:outline-none focus:border-slate-900">
                            <input type="text" x-model="customer.phone" placeholder="TELEFONE" class="w-full bg-white border border-slate-200 p-4 text-xs font-bold placeholder:text-slate-300 focus:outline-none focus:border-slate-900">
                            
                            <button @click="checkoutWhatsApp('<?= htmlspecialchars($whatsapp) ?>')"
                                    :disabled="cart.length === 0 || !customer.name || !customer.phone"
                                    class="w-full bg-slate-900 text-white p-5 font-black uppercase tracking-[0.2em] text-xs hover:bg-slate-800 disabled:opacity-30 disabled:cursor-not-allowed transition-all">
                                Finalizar via WhatsApp
                            </button>
                            <button @click="openCart = false" class="w-full text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-slate-900 transition-colors">
                                Continuar Escolhendo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function cartApp() {
    return {
        openCart: false,
        cart: [],
        customer: { name: '', phone: '' },
        addToCart(product) {
            if (!this.cart.find(item => item.id === product.id)) {
                this.cart.push(product);
            }
            this.openCart = true;
        },
        removeFromCart(id) {
            this.cart = this.cart.filter(item => item.id !== id);
        },
        cartTotal() {
            return this.cart.reduce((total, item) => total + parseFloat(item.price), 0);
        },
        checkoutWhatsApp(whatsapp) {
            let message = `Olá! Gostaria de fazer o seguinte pedido:\n\n`;
            this.cart.forEach(item => {
                message += `- ${item.name} (R$ ${parseFloat(item.price).toLocaleString('pt-BR', {minimumFractionDigits: 2})})\n`;
            });
            message += `\n*TOTAL: R$ ${this.cartTotal().toLocaleString('pt-BR', {minimumFractionDigits: 2})}*\n\n`;
            message += `Cliente: ${this.customer.name}\nTelefone: ${this.customer.phone}`;
            
            const encodedMessage = encodeURIComponent(message);
            const cleanPhone = whatsapp.replace(/\D/g, '');
            window.open(`https://wa.me/${cleanPhone}?text=${encodedMessage}`, '_blank');
        }
    }
}
</script>
