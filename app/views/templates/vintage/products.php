<section class="py-40 px-6 vintage-gradient min-h-[50vh] flex flex-col justify-center border-b border-amber-100" x-data="cartApp()">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-end gap-12 reveal w-full">
        <div class="max-w-2xl space-y-6">
            <span class="text-[10px] uppercase tracking-[0.6em] font-black text-amber-700 block">Curadoria Exclusiva</span>
            <h1 class="text-7xl md:text-9xl font-serif italic text-amber-900 leading-none">Boutique.</h1>
            <p class="text-lg font-serif italic text-amber-800/60 leading-relaxed italic">Essenciais de beleza curados para o seu bem-estar, selecionados sob o rigor da tradição.</p>
        </div>
        <button @click="openCart = true" class="relative group vintage-border p-8 bg-white hover:bg-amber-900 transition-all duration-700 shadow-2xl">
            <svg class="w-10 h-10 text-amber-900 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <template x-if="cart.length > 0">
                <span class="absolute -top-3 -right-3 bg-amber-900 text-[#fcfaf7] text-[10px] font-black w-8 h-8 flex items-center justify-center rounded-full border-4 border-[#fcfaf7] shadow-lg" x-text="cart.length"></span>
            </template>
        </button>
    </div>

    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-20 mt-40 reveal px-6">
        <?php foreach ($products as $index => $product): ?>
        <div class="text-center group">
            <div class="vintage-border p-3 mb-10 bg-white shadow-xl group-hover:shadow-[0_40px_80px_rgba(151,111,54,0.15)] transition-all duration-1000 overflow-hidden relative">
                <div class="absolute inset-0 bg-amber-900/5 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                <div class="aspect-square bg-amber-50 flex items-center justify-center relative overflow-hidden">
                    <?php if ($product['image']): ?>
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover sepia-[0.4] group-hover:sepia-0 group-hover:scale-110 transition-all duration-1000">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center opacity-10">
                            <span class="text-amber-900 font-serif italic text-6xl">B</span>
                        </div>
                    <?php endif; ?>
                    <div class="absolute inset-0 border-[24px] border-white/40 pointer-events-none group-hover:border-white/10 transition-all duration-1000"></div>
                </div>
            </div>
            <div class="space-y-4">
                <h3 class="text-3xl font-serif italic font-bold text-amber-950 tracking-tight group-hover:text-amber-700 transition-colors italic"><?= htmlspecialchars($product['name']) ?></h3>
                <p class="text-base font-serif italic text-amber-800/60 max-w-[280px] mx-auto leading-relaxed italic"><?= htmlspecialchars($product['description'] ?? 'Tratamento exclusivo de nossa curadoria premium.') ?></p>
                <div class="flex flex-col space-y-6 pt-6">
                    <span class="text-2xl font-serif font-black text-amber-900 tracking-widest leading-none">R$ <?= number_format($product['price'], 2, ',', '.') ?></span>
                    <button @click="addToCart(<?= htmlspecialchars(json_encode([
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'image' => $product['image']
                    ])) ?>)" 
                            class="text-[10px] uppercase tracking-[0.5em] font-black text-amber-900 border-b-2 border-amber-900/10 pb-2 hover:border-amber-900 transition-all mx-auto italic">
                        Adicionar à Sacola
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Vintage Shopping Cart UI -->
    <div x-show="openCart" x-cloak class="fixed inset-0 z-[100] overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 bg-amber-950/40 backdrop-blur-sm transition-opacity" @click="openCart = false"></div>
        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <div class="pointer-events-auto w-screen max-w-md">
                <div class="flex h-full flex-col bg-[#fcfaf7] shadow-2xl border-l border-amber-200">
                    <div class="flex-1 overflow-y-auto px-10 py-20">
                        <div class="flex items-start justify-between border-b pb-12 border-amber-900/10 mb-16">
                            <h2 class="text-5xl font-serif italic font-bold text-amber-900 tracking-tight italic" id="slide-over-title">Sua Sacola</h2>
                            <button @click="openCart = false" class="text-amber-900/30 hover:text-amber-900 transition-colors">
                                <span class="sr-only">Fechar</span>
                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>

                        <div class="space-y-16">
                            <template x-for="item in cart" :key="item.id">
                                <div class="flex items-center justify-between group">
                                    <div class="flex items-center space-x-10">
                                        <div class="w-24 h-24 vintage-border p-2 bg-white flex-shrink-0 shadow-lg group-hover:scale-105 transition-transform duration-700">
                                            <div class="w-full h-full bg-amber-50 flex items-center justify-center font-serif italic text-amber-900/10 text-xs overflow-hidden">
                                                <template x-if="item.image">
                                                    <img :src="item.image" class="w-full h-full object-cover sepia-[0.4] group-hover:sepia-0 transition-all">
                                                </template>
                                                <template x-if="!item.image">
                                                    <span class="text-4xl text-amber-900/5">B</span>
                                                </template>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-2xl font-serif italic font-bold text-amber-950 leading-tight italic" x-text="item.name"></p>
                                            <p class="text-lg font-serif italic text-amber-800/60 mt-2" x-text="'R$ ' + parseFloat(item.price).toLocaleString('pt-BR', {minimumFractionDigits: 2})"></p>
                                        </div>
                                    </div>
                                    <button @click="removeFromCart(item.id)" class="text-amber-900/20 hover:text-red-800 transition-colors">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </template>
                            <template x-if="cart.length === 0">
                                <div class="text-center py-32 border-2 border-dashed border-amber-900/5 italic font-serif text-amber-800/30">
                                    <p class="text-xl">Sua sacola aguarda seu pedido.</p>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="border-t border-amber-900/10 bg-[#f7f0e4] p-12 space-y-12 shadow-[0_-20px_50px_rgba(151,111,54,0.05)]">
                        <div class="flex justify-between items-end text-3xl font-serif italic font-black text-amber-950">
                            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-800/40">Investimento</p>
                            <p x-text="'R$ ' + cartTotal().toLocaleString('pt-BR', {minimumFractionDigits: 2})"></p>
                        </div>
                        
                        <div class="space-y-8">
                            <div class="space-y-3">
                                <label class="block text-[8px] font-black uppercase tracking-[0.4em] text-amber-900/40 ml-1 italic">Vossa Identificação</label>
                                <input type="text" x-model="customer.name" placeholder="NOME COMPLETO" class="w-full bg-[#fcfaf7] vintage-border p-6 text-[10px] font-black tracking-widest placeholder:text-amber-900/10 focus:outline-none focus:border-amber-900 shadow-inner italic font-serif uppercase text-amber-900">
                            </div>
                            <div class="space-y-3">
                                <label class="block text-[8px] font-black uppercase tracking-[0.4em] text-amber-900/40 ml-1 italic">Contato Direto</label>
                                <input type="text" x-model="customer.phone" placeholder="TELEFONE" class="w-full bg-[#fcfaf7] vintage-border p-6 text-[10px] font-black tracking-widest placeholder:text-amber-900/10 focus:outline-none focus:border-amber-900 shadow-inner italic font-serif uppercase text-amber-900">
                            </div>
                            
                            <button @click="checkoutWhatsApp('<?= htmlspecialchars($whatsapp) ?>')"
                                    :disabled="cart.length === 0 || !customer.name || !customer.phone"
                                    class="w-full bg-amber-900 text-[#fcfaf7] p-8 text-[10px] font-black uppercase tracking-[0.6em] hover:bg-amber-800 disabled:opacity-20 disabled:grayscale disabled:cursor-not-allowed transition-all shadow-2xl">
                                Finalizar Encomenda
                            </button>
                            <button @click="openCart = false" class="w-full text-[10px] font-black uppercase tracking-[0.4em] text-amber-900/30 hover:text-amber-900 transition-colors italic">
                                Voltar à Boutique
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
            let message = `Estimada Boutique, gostaria de solicitar:\n\n`;
            this.cart.forEach(item => {
                message += `• ${item.name.toUpperCase()} — R$ ${parseFloat(item.price).toLocaleString('pt-BR', {minimumFractionDigits: 2})}\n`;
            });
            message += `\nInvestimento Total: R$ ${this.cartTotal().toLocaleString('pt-BR', {minimumFractionDigits: 2})}\n\n`;
            message += `Identificação: ${this.customer.name.toUpperCase()}\nContato: ${this.customer.phone}`;
            
            const encodedMessage = encodeURIComponent(message);
            const cleanPhone = whatsapp.replace(/\D/g, '');
            window.open(`https://wa.me/${cleanPhone}?text=${encodedMessage}`, '_blank');
        }
    }
}
</script>
