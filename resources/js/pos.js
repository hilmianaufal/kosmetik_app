window.posApp = function (products = []) {
    return {
        search: '',
        notice: '',
        selectedCategory: 'all',
        scannerOpen: false,
        scanner: null,

        cart: [],
        checkoutOpen: false,
        successOpen: false,
        payment: 0,
        discount: 0,
        lastTransaction: null,

        products,

        categories() {
            return [...new Set(this.products.map(product => product.category).filter(Boolean))];
        },

        filteredProducts() {
            return this.products.filter(product => {
                const keyword = this.search.toLowerCase();

                const matchSearch =
                    product.name.toLowerCase().includes(keyword) ||
                    (product.brand ?? '').toLowerCase().includes(keyword) ||
                    (product.barcode ?? '').includes(this.search);

                const matchCategory =
                    this.selectedCategory === 'all' ||
                    product.category === this.selectedCategory;

                return matchSearch && matchCategory;
            });
        },

        imageUrl(image) {
            if (!image) return '';

            return image.startsWith('http') ? image : `/storage/${image}`;
        },

        addToCart(product) {
            if (product.stock <= 0) return;

            const item = this.cart.find(i => i.id === product.id);

            if (item) {
                if (item.qty < product.stock) {
                    item.qty++;
                }
            } else {
                this.cart.push({
                    ...product,
                    qty: 1
                });
            }
        },

        increaseQty(id) {
            const item = this.cart.find(i => i.id === id);

            if (item && item.qty < item.stock) {
                item.qty++;
            }
        },

        decreaseQty(id) {
            const item = this.cart.find(i => i.id === id);

            if (item && item.qty > 1) {
                item.qty--;
            } else {
                this.cart = this.cart.filter(i => i.id !== id);
            }
        },

        clearCart() {
            if (!confirm('Yakin ingin mengosongkan keranjang?')) {
                return;
            }

            this.cart = [];
            this.discount = 0;
            this.payment = 0;
            this.showNotice('Keranjang dikosongkan');
        },

        total() {
            return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        },

        grandTotal() {
            return Math.max(this.total() - this.discount, 0);
        },

        change() {
            return this.payment - this.grandTotal();
        },

        async finishPayment() {
            if (this.payment < this.grandTotal()) return;

            const response = await fetch('/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                },
                body: JSON.stringify({
                    items: this.cart,
                    total: this.grandTotal(),
                    payment: this.payment,
                    change: this.change()
                })
            });

            const result = await response.json();
                if (!response.ok) {
                    this.showNotice(result.message || 'Checkout gagal');
                    return;
                }
            if (result.success) {
                this.cart.forEach(cartItem => {
                        const product = this.products.find(product => product.id === cartItem.id);

                        if (product) {
                            product.stock = product.stock - cartItem.qty;
                        }
                    });
                this.lastTransaction = {
                    items: [...this.cart],
                    subtotal: this.total(),
                    discount: this.discount,
                    total: this.grandTotal(),
                    payment: this.payment,
                    change: this.change(),
                    date: new Date().toLocaleString('id-ID')
                };

                this.checkoutOpen = false;
                this.successOpen = true;

                const sound = document.getElementById('successSound');
                if (sound) {
                    sound.play().catch(() => {});
                }

                this.cart = [];
                this.payment = 0;
                this.discount = 0;
            }
        },

        printReceipt() {
            if (!this.lastTransaction) return;

            const receipt = `
                <div style="font-family: Arial; width: 280px; padding: 10px;">
                    <h2 style="text-align:center;">MATANU BEAUTY STORE</h2>
                    <p style="text-align:center;">${this.lastTransaction.date}</p>
                    <hr>

                    ${this.lastTransaction.items.map(item => `
                        <div style="display:flex; justify-content:space-between; margin-bottom:6px;">
                            <span>${item.name} x${item.qty}</span>
                            <span>Rp ${this.formatRupiah(item.price * item.qty)}</span>
                        </div>
                    `).join('')}

                    <hr>
                    <p>Subtotal: Rp ${this.formatRupiah(this.lastTransaction.subtotal)}</p>
                    <p>Diskon: Rp ${this.formatRupiah(this.lastTransaction.discount)}</p>
                    <p><strong>Total: Rp ${this.formatRupiah(this.lastTransaction.total)}</strong></p>
                    <p>Bayar: Rp ${this.formatRupiah(this.lastTransaction.payment)}</p>
                    <p>Kembali: Rp ${this.formatRupiah(this.lastTransaction.change)}</p>
                    <hr>
                    <p style="text-align:center;">Terima kasih 💖</p>
                </div>
            `;

            const printWindow = window.open('', '', 'width=400,height=600');

            printWindow.document.write(receipt);
            printWindow.document.close();
            printWindow.print();
        },

        openScanner() {
            this.scannerOpen = true;

            setTimeout(() => {
                this.scanner = new window.Html5Qrcode('reader');

                this.scanner.start(
                    { facingMode: 'environment' },
                    {
                        fps: 10,
                        qrbox: { width: 250, height: 250 }
                    },
                    (decodedText) => {
                        this.search = decodedText;

                        const product = this.products.find(product =>
                            product.barcode === decodedText
                        );

                        if (product) {
                            this.addToCart(product);
                            this.search = '';
                            this.showNotice('Produk berhasil ditambahkan ke keranjang');
                        } else {
                            this.showNotice('Barcode tidak ditemukan');
                        }

                        this.closeScanner();
                    }
                );
            }, 300);
        },

        closeScanner() {
            this.scannerOpen = false;

            if (this.scanner) {
                this.scanner.stop()
                    .then(() => {
                        this.scanner = null;
                    })
                    .catch(() => {
                        this.scanner = null;
                    });
            }
        },

        formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        },

        showNotice(message) {
            this.notice = message;

            setTimeout(() => {
                this.notice = '';
            }, 2500);
        },
    };
};