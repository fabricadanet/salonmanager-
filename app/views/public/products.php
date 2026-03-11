<div class="py-12 bg-gray-50" x-data="cartApp()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Nossos Produtos</h1>
            <p class="mt-4 text-lg text-gray-500">Compre com facilidade. Seu pedido será enviado diretamente ao nosso WhatsApp.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($products as $product): ?>
                <div class="bg-white border rounded-lg shadow-sm overflow-hidden flex flex-col">
                    <?php if ($product['image']): ?>
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-64 object-cover">
                    <?php else: ?>
                        <div class="w-full h-64 bg-gray-200"></div>
                    <?php endif; ?>
                    
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900"><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="mt-2 text-sm text-gray-500"><?= htmlspecialchars($product['description']) ?></p>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xl font-bold text-gray-900">R$ <?= number_format($product['price'], 2, ',', '.') ?></span>
                            <!-- Alpine JS event dispatch to add item to cart -->
                            <button @click="addToCart(<?= htmlspecialchars(json_encode([
                                'id' => $product['id'],
                                'name' => $product['name'],
                                'price' => $product['price']
                            ])) ?>)" 
                                class="bg-indigo-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-indigo-700 transition">
                                Adicionar
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Floating Cart Button -->
        <button @click="isCartOpen = true" x-show="cartTotalItems > 0" class="fixed bottom-8 right-8 bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-lg flex items-center justify-center transition" style="display: none;">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center" x-text="cartTotalItems"></span>
        </button>

        <!-- Cart Sidebar / Modal -->
        <div x-show="isCartOpen" style="display: none;" class="fixed inset-0 z-50 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <div class="absolute inset-0 overflow-hidden">
                <div x-show="isCartOpen" class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="isCartOpen = false"></div>
                <div class="fixed inset-y-0 right-0 max-w-full flex">
                    <div x-show="isCartOpen" class="w-screen max-w-md transform transition ease-in-out duration-500">
                        <div class="h-full flex flex-col bg-white shadow-xl overflow-y-scroll">
                            <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Seu Carrinho</h2>
                                    <div class="ml-3 h-7 flex items-center">
                                        <button type="button" @click="isCartOpen = false" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Fechar</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <div class="flow-root">
                                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                                            <template x-for="item in cart" :key="item.id">
                                                <li class="py-6 flex">
                                                    <div class="ml-4 flex-1 flex flex-col">
                                                        <div>
                                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                                <h3 x-text="item.name"></h3>
                                                                <p class="ml-4" x-text="'R$ ' + (item.price * item.quantity).toFixed(2)"></p>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 flex items-end justify-between text-sm">
                                                            <p class="text-gray-500">Qtd <span x-text="item.quantity"></span></p>
                                                            <div class="flex text-indigo-600 font-bold justify-between w-20">
                                                                <button type="button" @click="decreaseQuantity(item.id)">-</button>
                                                                <button type="button" @click="increaseQuantity(item.id)">+</button>
                                                            </div>
                                                            <div class="flex">
                                                                <button type="button" @click="removeFromCart(item.id)" class="font-medium text-red-600 hover:text-red-500">Remover</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </template>
                                            
                                            <li x-show="cartTotalItems === 0" class="py-6 text-center text-gray-500">
                                                Seu carrinho está vazio.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                                <div class="flex justify-between text-base font-medium text-gray-900 mb-4">
                                    <p>Subtotal</p>
                                    <p x-text="'R$ ' + cartTotalValue.toFixed(2)"></p>
                                </div>
                                
                                <div class="space-y-4">
                                    <input type="text" x-model="customerName" placeholder="Seu Nome Completo" class="w-full border-gray-300 rounded shadow-sm border p-2 text-sm">
                                    <input type="text" x-model="customerPhone" placeholder="Seu Telefone" class="w-full border-gray-300 rounded shadow-sm border p-2 text-sm">
                                </div>

                                <div class="mt-6">
                                    <button @click="sendWhatsAppOrder()" :disabled="cartTotalItems === 0 || !customerName || !customerPhone" 
                                            class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-green-600 hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed">
                                        Enviar Pedido (WhatsApp)
                                    </button>
                                </div>
                                <div class="mt-6 flex justify-center text-sm text-center text-gray-500">
                                    <p>
                                        ou <button type="button" @click="isCartOpen = false" class="text-indigo-600 font-medium hover:text-indigo-500">Continuar comprando <span aria-hidden="true">&rarr;</span></button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    alert('Por favor, preencha nome e telefone, e tenha itens no carrinho.');
                    return;
                }
                
                let message = `Olá! Gostaria de comprar:\n\n`;
                this.cart.forEach(item => {
                    message += `- ${item.name} - Qtd ${item.quantity}\n`;
                });
                
                message += `\nTotal: R$ ${this.cartTotalValue.toFixed(2)}\n`;
                message += `\nNome: ${this.customerName}`;
                message += `\nTelefone: ${this.customerPhone}`;
                
                const encodedMessage = encodeURIComponent(message);
                const url = `https://wa.me/${this.salonPhone}?text=${encodedMessage}`;
                
                window.open(url, '_blank');
            }
        }
    }
</script>
