@extends('layout.user')
@section('title', 'Place Order')
@section('content')

    <div class="pb-8">

        {{-- Header --}}
        <div class="flex items-center gap-3 px-4 pt-4 mb-5">
            <a href="{{ url()->previous() }}"
                class="flex h-10 w-10 items-center justify-center rounded-full bg-white border border-gray-200 shadow-sm shrink-0">
                <span class="material-symbols-outlined text-gray-700" style="font-size:1.2rem;">arrow_back</span>
            </a>
            <h2 class="text-lg font-bold text-gray-900">Place Order</h2>
        </div>

        {{-- Product Summary --}}
        <div class="mx-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-5">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Product</p>
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-xl bg-gray-100 overflow-hidden flex items-center justify-center shrink-0">
                    @if ($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}" class="w-full h-full object-cover">
                    @else
                        <span class="material-symbols-outlined text-gray-300"
                            style="font-size:1.8rem;">directions_bike</span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-blue-600 font-bold uppercase tracking-widest">
                        {{ $product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                    </p>
                    <h3 class="font-bold text-gray-900 truncate">{{ $product->name }}</h3>
                    <p class="text-blue-600 font-bold text-sm mt-0.5">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>
                <span class="text-xs text-gray-400 shrink-0">Stock: {{ $product->stock }}</span>
            </div>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mx-4 mb-4 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-600">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined" style="font-size:0.9rem;">error</span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.orders.store') }}" method="POST" class="px-4 space-y-4" id="orderForm">
            @csrf
            <!-- FIX #1: Pastikan product_id dikirim dengan benar -->
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            {{-- Quantity --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                <label class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 block">Quantity</label>
                <div class="flex items-center gap-4">
                    <button type="button" id="btnDecrement"
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-700 font-bold text-xl hover:bg-gray-200 transition-colors">−</button>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1"
                        max="{{ $product->stock }}"
                        class="w-16 text-center text-lg font-bold text-gray-900 border-0 focus:outline-none focus:ring-0 bg-transparent"
                        readonly>
                    <button type="button" id="btnIncrement"
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-700 font-bold text-xl hover:bg-gray-200 transition-colors">+</button>
                    <div class="flex-1 text-right">
                        <p class="text-xs text-gray-400">Subtotal</p>
                        <p id="totalPrice" class="font-bold text-blue-600 text-sm">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Address --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                <label class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 block">Delivery Address</label>
                <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap pengiriman..."
                    class="w-full text-sm text-gray-800 placeholder-gray-400 border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none @error('address') border-red-400 @enderror">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Payment Method --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                <label class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3 block">Payment Method</label>
                <div class="space-y-2">

                    <!-- FIX #2: Tambahkan data-payment attribute untuk memudahkan selector -->
                    <label class="payment-option flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition-all border-blue-500 bg-blue-50"
                        data-payment="cod">
                        <input type="radio" name="payment_method" value="cod" checked class="hidden" required>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100 shrink-0">
                            <span class="material-symbols-outlined text-green-600"
                                style="font-size:1.2rem;">local_shipping</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-800">Cash on Delivery</p>
                            <p class="text-xs text-gray-400">Bayar saat barang tiba</p>
                        </div>
                        <div
                            class="payment-dot w-5 h-5 rounded-full border-2 border-blue-500 flex items-center justify-center shrink-0">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                        </div>
                    </label>

                    <label class="payment-option flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition-all border-gray-200"
                        data-payment="transfer">
                        <input type="radio" name="payment_method" value="transfer" class="hidden" required>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 shrink-0">
                            <span class="material-symbols-outlined text-blue-600"
                                style="font-size:1.2rem;">account_balance</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-800">Bank Transfer</p>
                            <p class="text-xs text-gray-400">Transfer ke rekening kami</p>
                        </div>
                        <div
                            class="payment-dot w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500 hidden"></span>
                        </div>
                    </label>

                    <label class="payment-option flex items-center gap-3 p-3 rounded-xl border-2 cursor-pointer transition-all border-gray-200"
                        data-payment="ewallet">
                        <input type="radio" name="payment_method" value="ewallet" class="hidden" required>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100 shrink-0">
                            <span class="material-symbols-outlined text-purple-600"
                                style="font-size:1.2rem;">account_balance_wallet</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-800">E-Wallet</p>
                            <p class="text-xs text-gray-400">GoPay, OVO, Dana, dll</p>
                        </div>
                        <div
                            class="payment-dot w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500 hidden"></span>
                        </div>
                    </label>

                </div>
            </div>

            {{-- Order Summary --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Order Summary</p>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Product</span>
                        <span class="font-medium text-gray-800 truncate ml-4 text-right">{{ $product->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Price</span>
                        <span class="font-medium text-gray-800">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Quantity</span>
                        <span class="font-medium text-gray-800" id="summaryQty">1</span>
                    </div>
                    <div class="h-px bg-gray-100"></div>
                    <div class="flex justify-between">
                        <span class="font-bold text-gray-800">Total</span>
                        <span class="font-bold text-blue-600" id="summaryTotal">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl transition-colors shadow-lg shadow-blue-200">
                <span class="material-symbols-outlined" style="font-size:1.1rem;">shopping_cart</span>
                Confirm Order
            </button>

        </form>

    </div>

    <script>
        const price = {{ $product->price }};
        const maxStock = {{ $product->stock }};
        const qtyInput = document.getElementById('quantity');
        const btnIncrement = document.getElementById('btnIncrement');
        const btnDecrement = document.getElementById('btnDecrement');

        function formatRupiah(n) {
            return 'Rp ' + n.toLocaleString('id-ID');
        }

        function updateTotal() {
            const qty = parseInt(qtyInput.value);
            document.getElementById('totalPrice').textContent = formatRupiah(price * qty);
            document.getElementById('summaryQty').textContent = qty;
            document.getElementById('summaryTotal').textContent = formatRupiah(price * qty);
        }

        // FIX #3: Gunakan prevent default dan event listener yang lebih jelas
        btnIncrement.addEventListener('click', function(e) {
            e.preventDefault();
            let qty = parseInt(qtyInput.value);
            if (qty < maxStock) {
                qtyInput.value = qty + 1;
                updateTotal();
            }
        });

        btnDecrement.addEventListener('click', function(e) {
            e.preventDefault();
            let qty = parseInt(qtyInput.value);
            if (qty > 1) {
                qtyInput.value = qty - 1;
                updateTotal();
            }
        });

        // FIX #4: Perbaiki payment method selection dengan selector yang lebih reliable
        document.querySelectorAll('.payment-option').forEach(function(option) {
            option.addEventListener('click', function(e) {
                // Remove active state dari semua option
                document.querySelectorAll('.payment-option').forEach(function(o) {
                    o.classList.remove('border-blue-500', 'bg-blue-50');
                    o.classList.add('border-gray-200');
                    o.querySelector('.payment-dot').classList.remove('border-blue-500');
                    o.querySelector('.payment-dot').classList.add('border-gray-300');
                    o.querySelector('.payment-dot span').classList.add('hidden');
                });

                // Add active state ke clicked option
                this.classList.add('border-blue-500', 'bg-blue-50');
                this.classList.remove('border-gray-200');
                this.querySelector('.payment-dot').classList.add('border-blue-500');
                this.querySelector('.payment-dot').classList.remove('border-gray-300');
                this.querySelector('.payment-dot span').classList.remove('hidden');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        // Optional: Debug - log form data saat submit
        document.getElementById('orderForm').addEventListener('submit', function(e) {
            console.log('Form Data:', {
                product_id: document.querySelector('input[name="product_id"]').value,
                quantity: document.querySelector('input[name="quantity"]').value,
                address: document.querySelector('textarea[name="address"]').value,
                payment_method: document.querySelector('input[name="payment_method"]:checked').value,
            });
        });
    </script>

@endsection