@extends('layout.user')
@section('title', 'Place Order')
@section('content')

    <div class="pb-8">

        {{-- Header --}}
        <div class="flex items-center justify-between px-4 pt-4 mb-4">
            <a href="{{ url()->previous() }}"
                class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 backdrop-blur-md border border-slate-700/50 shadow-sm hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-slate-200" style="font-size:1.2rem;">arrow_back</span>
            </a>
            <h2 class="text-sm font-bold text-slate-100 flex-1 text-center px-4">Place Order</h2>
            <div class="h-10 w-10"></div> {{-- Spacer --}}
        </div>

        <form action="{{ route('user.orders.store') }}" method="POST" id="orderForm">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="total_amount" id="hiddenTotal" value="{{ $product->price }}">

            <div class="px-4 space-y-4 pb-32">

                {{-- Delivery Address --}}
                <div class="bg-slate-800 rounded-2xl border border-slate-700/50 p-4 shadow-lg shadow-black/10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 text-slate-700/50">
                        <span class="material-symbols-outlined" style="font-size:4rem;">local_shipping</span>
                    </div>
                    <div class="flex items-center gap-2 mb-3 relative z-10">
                        <span class="material-symbols-outlined text-blue-500" style="font-size:1.2rem;">location_on</span>
                        <h3 class="font-bold text-slate-100 text-sm">Delivery Contact</h3>
                    </div>
                    <div class="space-y-4 relative z-10">
                        <div>
                            <input type="text" name="address" placeholder="Ex: John Doe - 081234..."
                                value="{{ old('address') }}" required
                                class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 shadow-inner">
                            @error('address')
                                <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Order Item --}}
                <div class="bg-slate-800 rounded-2xl border border-slate-700/50 p-4 shadow-lg shadow-black/10">
                    <h3 class="font-bold text-slate-100 text-sm mb-3">Order Items</h3>
                    <div class="flex gap-4">
                        <div class="w-20 h-20 rounded-xl bg-slate-700 flex items-center justify-center shrink-0 overflow-hidden">
                            @if ($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-slate-500">directions_bike</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-slate-100 text-sm pr-4">{{ $product->name }}</h4>
                            <p class="text-blue-400 font-bold mt-1 text-sm">Rp
                                {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="h-px bg-slate-700/50 my-4"></div>

                    {{-- Quantity Selector --}}
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-400 font-medium">Buying Quantity</span>
                        <div class="flex items-center gap-3">
                            <button type="button" id="btnDecrement"
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900/50 border border-slate-700 text-slate-200 font-bold text-xl hover:bg-slate-700 transition-colors shadow-inner">—</button>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', request('qty', 1)) }}" min="1"
                                max="{{ $product->stock }}"
                                class="w-12 text-center text-lg font-bold text-slate-100 border-0 focus:outline-none focus:ring-0 bg-transparent"
                                readonly>
                            <button type="button" id="btnIncrement"
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900/50 border border-slate-700 text-slate-200 font-bold text-xl hover:bg-slate-700 transition-colors shadow-inner">+</button>
                        </div>
                    </div>
                    @error('quantity')
                        <p class="text-rose-500 text-xs mt-2 text-right">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Payment Method --}}
                <div class="bg-slate-800 rounded-2xl border border-slate-700/50 p-4 shadow-lg shadow-black/10">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-emerald-500" style="font-size:1.2rem;">account_balance_wallet</span>
                        <h3 class="font-bold text-slate-100 text-sm">Payment Method</h3>
                    </div>

                    <div class="space-y-3">
                        <input type="hidden" name="payment_method" id="paymentMethod"
                            value="{{ old('payment_method', 'transfer') }}">

                        {{-- Transfer --}}
                        <div class="payment-option cursor-pointer rounded-xl border-2 p-3 transition-all duration-300 {{ old('payment_method', 'transfer') === 'transfer' ? 'border-blue-500 bg-blue-500/10' : 'border-slate-700 bg-slate-900/50' }}"
                            data-value="transfer">
                            <div class="flex items-center gap-3">
                                <div
                                    class="radio-circle flex h-5 w-5 items-center justify-center rounded-full border-2 transition-colors {{ old('payment_method', 'transfer') === 'transfer' ? 'border-blue-500' : 'border-slate-500' }}">
                                    <div
                                        class="h-2.5 w-2.5 rounded-full bg-blue-500 transition-transform {{ old('payment_method', 'transfer') === 'transfer' ? 'scale-100' : 'scale-0' }}">
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-slate-200">Bank Transfer</p>
                                    <p class="text-xs text-slate-400 mt-0.5">BCA, BNI, Mandiri</p>
                                </div>
                                <span class="material-symbols-outlined text-slate-500 text-2xl">account_balance</span>
                            </div>
                        </div>

                        {{-- Cash (COD) --}}
                        <div class="payment-option cursor-pointer rounded-xl border-2 p-3 transition-all duration-300 {{ old('payment_method') === 'cod' ? 'border-blue-500 bg-blue-500/10' : 'border-slate-700 bg-slate-900/50' }}"
                            data-value="cod">
                            <div class="flex items-center gap-3">
                                <div
                                    class="radio-circle flex h-5 w-5 items-center justify-center rounded-full border-2 transition-colors {{ old('payment_method') === 'cod' ? 'border-blue-500' : 'border-slate-500' }}">
                                    <div
                                        class="h-2.5 w-2.5 rounded-full bg-blue-500 transition-transform {{ old('payment_method') === 'cod' ? 'scale-100' : 'scale-0' }}">
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-slate-200">Cash on Delivery</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Pay when you receive</p>
                                </div>
                                <span class="material-symbols-outlined text-slate-500 text-2xl">payments</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Checkout Bottom Bar --}}
            <div class="fixed bottom-0 left-0 right-0 z-[60] bg-slate-900/80 backdrop-blur-xl border-t border-slate-800 p-4 shadow-[0_-10px_30px_rgba(0,0,0,0.5)]">
                <div class="mx-auto flex max-w-lg items-center justify-between gap-4">
                    <div class="flex-1">
                        <p class="text-xs text-slate-400">Total Payment</p>
                        <p id="totalPrice" class="text-xl font-black text-blue-500 mt-0.5 tracking-tight">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <button type="submit"
                        class="flex items-center justify-center gap-2 rounded-2xl bg-blue-600 px-8 py-3.5 font-bold text-white shadow-[0_0_20px_rgba(59,130,246,0.4)] hover:shadow-[0_0_25px_rgba(59,130,246,0.6)] hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden overflow-element group">
                        <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <span class="material-symbols-outlined text-xl">shopping_cart_checkout</span>
                        Confirm Order
                    </button>
                </div>
            </div>
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
            const total = price * qty;
            document.querySelectorAll('#totalPrice').forEach(el => el.textContent = formatRupiah(total));
            document.getElementById('hiddenTotal').value = total;
        }

        updateTotal();

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

        document.querySelectorAll('.payment-option').forEach(function(option) {
            option.addEventListener('click', function(e) {
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('border-blue-500', 'bg-blue-500/10');
                    opt.classList.add('border-slate-700', 'bg-slate-900/50');

                    const circle = opt.querySelector('.radio-circle');
                    circle.classList.remove('border-blue-500');
                    circle.classList.add('border-slate-500');

                    const dot = circle.querySelector('div');
                    dot.classList.remove('scale-100');
                    dot.classList.add('scale-0');
                });
                
                this.classList.add('border-blue-500', 'bg-blue-500/10');
                this.classList.remove('border-slate-700', 'bg-slate-900/50');
                
                const circle = this.querySelector('.radio-circle');
                circle.classList.add('border-blue-500');
                circle.classList.remove('border-slate-500');
                
                const dot = this.querySelector('div');
                dot.classList.add('scale-100');
                dot.classList.remove('scale-0');

                document.getElementById('paymentMethod').value = this.dataset.value;
            });
        });
    </script>

@endsection