<section class="py-24 bg-noir px-6 lg:px-12" x-data="cartApp()">
    <div class="max-w-7xl mx-auto">
        <div class="mb-24 flex flex-col md:flex-row justify-between items-end gap-12 reveal">
            <div class="space-y-4 max-w-2xl">
                <span class="text-[10px] uppercase tracking-[0.5em] text-gold font-bold">Sélection Boutique</span>
                <h1 class="text-6xl md:text-7xl font-serif italic text-white leading-tight uppercase">Boutique.</h1>
                <p class="text-gray-500 font-light text-lg italic">Produtos exclusivos selecionados por nossos especialistas para prolongar a experiência premium do salão em sua casa.</p>
            </div>
            
            <button @click="isCartOpen = true" class="relative group p-6 border border-white/10 hover:border-gold transition-all shadow-2xl">
                <svg class="h-8 w-8 text-white group-hover:text-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span x-show="cartTotalItems > 0" class="absolute -top-2 -right-2 bg-gold text-noir text-[10px] font-black rounded-full h-6 w-6 flex items-center justify-center border-2 border-noir" x-text="cartTotalItems"></span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 reveal">
            <?php foreach ($products as $product): ?>
                <div class="group flex flex-col bg-noir p-0 border border-white/5 hover:border-gold/20 transition-all duration-1000">
                    <div class="relative aspect-square overflow-hidden bg-noir-light group-hover:bg-noir transition-colors">
                        <?php if ($product['image']): ?>
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-110 transition-all duration-1000">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center opacity-10">
                                <span class="text-[10px] uppercase tracking-[0.4em] text-gray-400 italic">Portrait Product</span>
                            </div>
                        <?php endif; ?>
                        <div class="absolute bottom-6 right-6 bg-noir/90 backdrop-blur-md px-4 py-2 border border-gold/10 opacity-0 group-hover:opacity-100 transition-all duration-500">
                             <span class="text-xs font-bold text-gold tracking-widest">R$ <?= number_format($product['price'], 2, ',', '.') ?></span>
                        </div>
                    </div>
                    
                    <div class="p-10 flex-1 flex flex-col space-y-6">
                        <div class="space-y-4">
                            <h3 class="text-3xl font-serif italic text-white group-hover:text-gold transition-colors"><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="text-gray-500 font-light text-sm leading-relaxed line-clamp-2 italic"><?= htmlspecialchars($product['description']) ?></p>
                        </div>
                        
                        <div class="pt-8 mt-auto">
                            <button @click="addToCart(<?= htmlspecialchars(json_encode([
                                'id' => $product['id'],
                                'name' => $product['name'],
                                'price' => $product['price'],
                                'image' => $product['image']
                            ])) ?>)" 
                                class="w-full py-5 bg-noir-lighter border border-white/10 text-[10px] uppercase tracking-[0.4em] font-black text-gray-400 hover:bg-gold hover:text-noir hover:border-gold transition-all duration-500 shadow-xl">
                                Adicionar à Sacola
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($products)): ?>
            <p class="py-24 text-center text-gray-600 uppercase tracking-widest text-xs italic">Aguardando reposição de estoque.</p>
        <?php endif; ?>

        <!-- Cart Sidebar -->
        <div x-show="isCartOpen" x-cloak class="fixed inset-0 z-[100] overflow-hidden" role="dialog" aria-modal="true">
            <div class="absolute inset-0 overflow-hidden">
                <div x-show="isCartOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 bg-noir/90 backdrop-blur-md transition-opacity" @click="isCartOpen = false"></div>
                
                <div class="fixed inset-y-0 right-0 max-w-full flex">
                    <div x-show="isCartOpen" x-transition:enter="transform transition ease-in-out duration-500" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="w-screen max-w-md transform transition ease-in-out duration-500">
                        <div class="h-full flex flex-col bg-noir-light border-l border-white/5 shadow-2xl">
                            <div class="flex-1 py-16 overflow-y-auto px-10">
                                <div class="flex items-start justify-between mb-16 border-b border-white/5 pb-10">
                                    <h2 class="text-4xl font-serif italic text-white uppercase tracking-tighter">Sua Sacola</h2>
                                    <button type="button" @click="isCartOpen = false" class="text-gray-500 hover:text-gold transition-colors">
                                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="flow-root">
                                    <ul role="list" class="-my-6 divide-y divide-white/5">
                                        <template x-for="item in cart" :key="item.id">
                                            <li class="py-12 flex space-x-8 group">
                                                <div class="w-20 h-20 bg-noir flex-shrink-0 overflow-hidden border border-white/5 group-hover:border-gold/20 transition-colors">
                                                    <template x-if="item.image">
                                                        <img :src="item.image" class="w-full h-full object-cover grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                                                    </template>
                                                    <template x-if="!item.image">
                                                        <div class="w-full h-full flex items-center justify-center opacity-10">
                                                            <span class="text-[8px] uppercase tracking-tighter">Shop</span>
                                                        </div>
                                                    </template>
                                                </div>
                                                <div class="flex-1 flex flex-col">
                                                    <div class="flex justify-between items-start">
                                                        <h3 class="text-xl font-serif italic text-white group-hover:text-gold transition-colors" x-text="item.name"></h3>
                                                        <p class="text-gold font-bold ml-4" x-text="'R$ ' + (item.price * item.quantity).toFixed(2)"></p>
                                                    </div>
                                                    <div class="flex-1 flex items-end justify-between mt-8">
                                                        <div class="flex items-center space-x-6 border border-white/10 px-4 py-2">
                                                            <button type="button" @click="decreaseQuantity(item.id)" class="text-gray-500 hover:text-white transition-colors">-</button>
                                                            <span class="text-xs font-black text-white w-4 text-center" x-text="item.quantity"></span>
                                                            <button type="button" @click="increaseQuantity(item.id)" class="text-gray-500 hover:text-white transition-colors">+</button>
                                                        </div>
                                                        <button type="button" @click="removeFromCart(item.id)" class="text-[10px] uppercase tracking-[0.3em] font-black text-red-500/30 hover:text-red-500 transition-colors">Remover</button>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                        
                                        <li x-show="cartTotalItems === 0" class="py-32 text-center">
                                            <p class="text-gray-700 uppercase tracking-[0.4em] text-[10px] italic">Sua sacola está vazia.</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="border-t border-white/10 bg-noir py-16 px-10 space-y-10">
                                <div class="flex justify-between items-end">
                                    <p class="text-[10px] uppercase tracking-[0.5em] text-gray-500 font-black italic">Total Estimado</p>
                                    <p class="text-5xl font-serif italic text-gold drop-shadow-2xl" x-text="'R$ ' + cartTotalValue.toFixed(2)"></p>
                                </div>
                                
                                <div class="space-y-6">
                                    <div class="space-y-2">
                                        <label class="block text-[8px] font-black uppercase tracking-[0.4em] text-gray-600 ml-1">Identificação</label>
                                        <input type="text" x-model="customerName" placeholder="NOME COMPLETO" class="w-full bg-noir-light border-white/5 p-5 text-[10px] tracking-widest placeholder:text-gray-800 focus:border-gold/50 transition-all outline-none uppercase font-black text-white shadow-inner italic">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-[8px] font-black uppercase tracking-[0.4em] text-gray-600 ml-1">Contato</label>
                                        <input type="text" x-model="customerPhone" placeholder="TELEFONE" class="w-full bg-noir-light border-white/5 p-5 text-[10px] tracking-widest placeholder:text-gray-800 focus:border-gold/50 transition-all outline-none uppercase font-black text-white shadow-inner italic">
                                    </div>
                                </div>

                                <button @click="sendWhatsAppOrder()" :disabled="cartTotalItems === 0 || !customerName || !customerPhone" 
                                        class="w-full py-8 bg-gold text-noir font-black uppercase tracking-[0.5em] text-xs transition-all hover:bg-gold-light disabled:opacity-10 disabled:grayscale disabled:cursor-not-allowed shadow-[0_20px_50px_rgba(212,175,55,0.2)]">
                                    Finalizar pelo WhatsApp
                                </button>
                                
                                <button type="button" @click="isCartOpen = false" class="w-full text-[10px] uppercase tracking-[0.4em] font-black text-gray-700 hover:text-white transition-colors italic">
                                    Continuar Escolhendo
                                </button>
                            </div>
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
            isCartOpen: false,
            cart: [],
            customerName: '',
            customerPhone: '',
            salonPhone: '<?= preg_replace('/[^0-9]/', '', $whatsapp) ?>',
            
            get cartTotalItems() {
                return this.cart.reduce((total, item) => total + item.quantity, 0);
            },
            
            get cartTotalValue() {
                return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
            },
            
            addToCart(product) {
                const index = this.cart.findIndex(i => i.id === product.id);
                if (index > -1) {
                    this.cart[index].quantity++;
                } else {
                    this.cart.push({...product, quantity: 1});
                }
                this.isCartOpen = true;
            },
            
            increaseQuantity(id) {
                const item = this.cart.find(i => i.id === id);
                if (item) item.quantity++;
            },

            decreaseQuantity(id) {
                const index = this.cart.findIndex(i => i.id === id);
                if (index > -1) {
                    if (this.cart[index].quantity > 1) {
                        this.cart[index].quantity--;
                    } else {
                        this.cart.splice(index, 1);
                    }
                }
            },

            removeFromCart(id) {
                this.cart = this.cart.filter(i => i.id !== id);
            },
            
            sendWhatsAppOrder() {
                if (this.cart.length === 0 || !this.customerName || !this.customerPhone) {
                    return;
                }
                
                let message = `*SOLONMANAGER - NOVO PEDIDO*\n\n`;
                message += `Olá! Gostaria de comprar:\n\n`;
                this.cart.forEach(item => {
                    message += `• ${item.name.toUpperCase()} (Qtd: ${item.quantity})\n`;
                });
                
                message += `\n*TOTAL: R$ ${this.cartTotalValue.toFixed(2)}*\n\n`;
                message += `*CLIENTE:* ${this.customerName.toUpperCase()}\n`;
                message += `*CONTATO:* ${this.customerPhone}`;
                
                const encodedMessage = encodeURIComponent(message);
                const url = `https://wa.me/${this.salonPhone}?text=${encodedMessage}`;
                
                window.open(url, '_blank');
            }
        }
    }
</script>
