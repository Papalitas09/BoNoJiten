@extends('layout.user')
@section('title', 'Cart')

@section('content')

    <div class="max-w-5xl mx-auto pb-24 px-4">

        {{-- Header --}}
        <div class="flex items-center justify-between pt-4 mb-6">
            <a href="{{ url()->previous() }}"
                class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 backdrop-blur-md border border-slate-700/50 shadow-sm hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-slate-200" style="font-size:1.2rem;">arrow_back</span>
            </a>
            <h2 class="text-lg font-bold text-slate-100 flex-1 text-center px-4 truncate">Your Cart</h2>
            <div class="flex h-10 w-10 items-center justify-center text-slate-400">
                <span class="material-symbols-outlined">shopping_cart</span>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 py-3 px-4 bg-rose-500/10 border border-rose-500/20 rounded-xl text-sm text-rose-400 font-medium">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined" style="font-size:1.1rem;">error</span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!$cart || $cart->items->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-slate-500">
                <div class="w-24 h-24 rounded-full bg-slate-800 flex items-center justify-center mb-6">
                     <span class="material-symbols-outlined text-5xl text-slate-600">shopping_cart</span>
                </div>
                <p class="text-xl font-bold text-slate-300">Your cart is empty</p>
                <p class="text-sm text-slate-500 mt-2 text-center max-w-[250px]">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('user.home') }}"
                    class="mt-8 px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/30">
                    Start Shopping
                </a>
            </div>
        @else
            {{-- Desktop: 2-column, Mobile: stacked --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-3">
                    @php $totalAmount = 0; @endphp
                    @foreach ($cart->items as $item)
                        @php
                            $subtotal = $item->product->price * $item->quantity;
                            $totalAmount += $subtotal;
                        @endphp
                        <div class="flex gap-4 p-4 bg-slate-800 rounded-2xl border border-slate-700/50 shadow-lg shadow-black/10 transition-transform duration-300 hover:-translate-y-0.5 group">
                            {{-- Image --}}
                            <a href="{{ route('user.products.show', $item->product) }}" class="block w-24 h-24 shrink-0">
                                <div class="w-full h-full rounded-xl bg-slate-700/50 flex items-center justify-center overflow-hidden">
                                    @if ($item->product->image)
                                        <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <span class="material-symbols-outlined text-slate-500">directions_bike</span>
                                    @endif
                                </div>
                            </a>

                            {{-- Details --}}
                            <div class="flex-1 flex flex-col">
                                <div class="flex items-start justify-between">
                                    <a href="{{ route('user.products.show', $item->product) }}">
                                        <h3 class="font-bold text-slate-100 text-sm leading-tight line-clamp-2 pr-2">
                                            {{ $item->product->name }}
                                        </h3>
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-blue-400 mt-1">
                                            {{ $item->product->categories === 'unit' ? 'Full Bike' : ($item->product->categories === 'sparepart' ? 'Spare Part' : 'Equipment') }}
                                        </p>
                                    </a>
                                    {{-- Remove Button --}}
                                    <form action="{{ route('user.cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-slate-500 hover:text-rose-500 transition-colors p-1" title="Remove">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                </div>

                                <p class="text-sm font-extrabold text-blue-400 mt-2 mb-3">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                    <span class="text-xs font-medium text-slate-500 ml-1">/ item</span>
                                </p>

                                <div class="flex items-center justify-between mt-auto">
                                    {{-- Quantity --}}
                                    <form action="{{ route('user.cart.update', $item) }}" method="POST"
                                        class="flex items-center gap-2">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                            class="w-16 h-8 rounded-lg border border-slate-700 bg-slate-900/50 text-slate-200 text-center text-sm font-bold focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                        <button type="submit" class="flex items-center justify-center h-8 w-8 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white transition-colors" title="Update">
                                            <span class="material-symbols-outlined text-[18px]">sync</span>
                                        </button>
                                    </form>

                                    @if ($item->product->stock > 0 && $item->product->status === 'available')
                                        <a href="{{ route('user.orders.create', ['product' => $item->product->id, 'qty' => $item->quantity]) }}"
                                            class="h-8 px-4 flex items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-400 text-xs font-bold ring-1 ring-inset ring-emerald-500/30 hover:bg-emerald-500 hover:text-white transition-colors">
                                            Order
                                        </a>
                                    @else
                                        <span class="text-[10px] font-bold px-2 py-1 bg-rose-500/10 text-rose-400 rounded">Sold Out</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Sticky Summary Sidebar (desktop) / bottom bar (mobile) --}}
                {{-- Mobile bottom bar --}}
                <div class="lg:hidden fixed bottom-0 left-0 right-0 z-[60] bg-slate-900/90 backdrop-blur-xl border-t border-slate-800 p-4 shadow-[0_-10px_30px_rgba(0,0,0,0.5)]">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-slate-400 font-medium text-sm">Total Value</span>
                        <span class="font-black text-xl text-blue-400 tracking-tight">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-xs text-slate-500 bg-blue-500/10 rounded-lg p-2 border border-blue-500/20">
                        <span class="font-bold text-blue-400">Note:</span> Tap <strong class="text-slate-300">Order</strong> on each item to checkout individually.
                    </p>
                </div>

                {{-- Desktop sticky sidebar --}}
                <div class="hidden lg:block lg:col-span-1">
                    <div class="sticky top-6 bg-slate-800 rounded-3xl border border-slate-700/50 shadow-xl shadow-black/20 overflow-hidden">
                        <div class="px-6 py-5 border-b border-slate-700/50">
                            <h3 class="text-sm font-bold uppercase tracking-widest text-slate-400 flex items-center gap-2">
                                <span class="material-symbols-outlined text-slate-500" style="font-size:1.1rem;">receipt_long</span>
                                Order Summary
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-400">Items</span>
                                <span class="font-bold text-slate-200">{{ $cart->items->count() }}</span>
                            </div>
                            <div class="border-t border-slate-700/50 pt-4 flex justify-between items-center">
                                <span class="text-slate-300 font-bold">Total</span>
                                <span class="text-xl font-extrabold text-blue-400 tracking-tight">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                            </div>
                            <div class="bg-blue-500/10 rounded-2xl p-4 border border-blue-500/20">
                                <p class="text-xs text-slate-400 leading-relaxed">
                                    <span class="font-bold text-blue-400">How to order:</span> Tap the
                                    <strong class="text-slate-200">Order</strong> button on each item to proceed to checkout individually.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif

    </div>

@endsection
