@extends('layout.user')
@section('title', 'My Orders')
@section('content')

    <div class="px-4 pt-4 pb-6">

        {{-- Header --}}
        <div class="mb-5">
            <h2 class="text-xl font-bold text-slate-100 drop-shadow-md">My Orders</h2>
            <p class="text-sm text-slate-400 mt-0.5">Track all your purchases</p>
        </div>

        {{-- Status Filter Tabs --}}
        <div class="no-scrollbar flex gap-2 overflow-x-auto mb-5">
            @php
                $tabs = [
                    ['label' => 'All', 'value' => ''],
                    ['label' => 'Pending', 'value' => 'pending'],
                    ['label' => 'Completed', 'value' => 'completed'],
                    ['label' => 'Cancelled', 'value' => 'cancelled'],
                ];
            @endphp

            @foreach ($tabs as $tab)
                <a href="{{ route('user.orders.index', array_filter(['status' => $tab['value']])) }}"
                    class="flex h-9 shrink-0 items-center justify-center px-4 rounded-xl text-xs font-bold transition-all duration-300
                      {{ request('status', '') === $tab['value']
                          ? 'bg-blue-600/20 text-blue-400 border border-blue-500/50 shadow-[0_0_15px_rgba(59,130,246,0.3)]'
                          : 'bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700' }}">
                    {{ $tab['label'] }}
                    @if ($tab['value'] !== '')
                        <span
                            class="ml-1.5 flex h-4 w-4 items-center justify-center rounded-full text-[10px]
                                 {{ request('status') === $tab['value'] ? 'bg-blue-500/30 text-blue-300' : 'bg-slate-700 text-slate-400' }}">
                            {{ $orders->where('status', $tab['value'])->count() }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- Flash --}}
        @if (session('success'))
            <div
                class="mb-4 px-4 py-3 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm flex items-center gap-2 shadow-inner">
                <span class="material-symbols-outlined" style="font-size:1.1rem;">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Orders List --}}
        @if ($orders->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-slate-500">
                <span class="material-symbols-outlined text-5xl mb-3">receipt_long</span>
                <p class="font-semibold text-slate-300">No orders yet</p>
                <p class="text-sm text-slate-500 mt-1">Start shopping to see your orders here</p>
                <a href="{{ route('user.explore.index') }}"
                    class="mt-5 px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl transition-colors shadow-lg shadow-blue-500/20">
                    Browse Products
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="bg-slate-800 rounded-2xl border border-slate-700/50 shadow-lg shadow-black/10 overflow-hidden hover:-translate-y-1 transition-transform group">

                        {{-- Order Header --}}
                        <div class="flex items-center justify-between px-4 py-3 border-b border-slate-700/50">
                            <div>
                                <p class="text-[10px] uppercase font-bold tracking-widest text-slate-500">Order Number</p>
                                <p class="text-sm font-black font-mono text-blue-400 mt-0.5">#{{ $order->order_number }}</p>
                            </div>
                            {{-- Status Badge --}}
                            @if ($order->status === 'pending')
                                <span
                                    class="flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] uppercase tracking-wide font-bold bg-amber-500/10 text-amber-400 ring-1 ring-inset ring-amber-500/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shadow-[0_0_5px_rgba(245,158,11,0.8)]"></span>
                                    Pending
                                </span>
                            @elseif($order->status === 'completed')
                                <span
                                    class="flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] uppercase tracking-wide font-bold bg-emerald-500/10 text-emerald-400 ring-1 ring-inset ring-emerald-500/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_5px_rgba(16,185,129,0.8)]"></span>
                                    Completed
                                </span>
                            @else
                                <span
                                    class="flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] uppercase tracking-wide font-bold bg-rose-500/10 text-rose-400 ring-1 ring-inset ring-rose-500/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shadow-[0_0_5px_rgba(244,63,94,0.8)]"></span>
                                    Cancelled
                                </span>
                            @endif
                        </div>

                        {{-- Product Info --}}
                        <div class="flex items-center gap-4 px-4 py-3 bg-slate-900/20">
                            <a href="{{ route('user.products.show', $order->product) }}" class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-slate-700 overflow-hidden">
                                @if ($order->product->image)
                                    <img src="{{ asset('storage/products/' . $order->product->image) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <span class="material-symbols-outlined text-slate-500 w-full"
                                        style="font-size: 2rem;">directions_bike</span>
                                @endif
                            </a>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('user.products.show', $order->product) }}" class="block">
                                   <p class="text-sm font-bold text-slate-100 truncate hover:text-blue-400 transition-colors">
                                        {{ $order->product->name ?? 'Product not found' }}
                                   </p>
                                </a>
                                <p class="text-xs text-blue-400/80 font-bold tracking-wider uppercase mt-1">
                                    {{ $order->product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                                </p>
                                <p class="text-xs text-slate-400 mt-1">Qty: <strong class="text-slate-300">{{ $order->quantity }}</strong></p>
                            </div>
                            <div class="text-right shrink-0 self-start mt-1">
                                <p class="text-sm font-extrabold text-slate-100">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        {{-- Order Details --}}
                        <div class="px-4 py-3 space-y-2 border-t border-slate-700/50 bg-slate-800">

                            <div class="flex items-center gap-3 text-xs text-slate-400">
                                <span class="material-symbols-outlined text-slate-500"
                                    style="font-size:1.1rem;">location_on</span>
                                <span class="truncate">{{ $order->address }}</span>
                            </div>

                            <div class="flex items-center gap-3 text-xs text-slate-400">
                                <span class="material-symbols-outlined text-slate-500"
                                    style="font-size:1.1rem;">payments</span>
                                <span>
                                    @if ($order->payment_method === 'transfer')
                                        Bank Transfer
                                    @elseif($order->payment_method === 'cash' || $order->payment_method === 'cod')
                                        Cash on Delivery
                                    @else
                                        {{ ucfirst($order->payment_method) }}
                                    @endif
                                </span>
                            </div>

                            <div class="flex items-center gap-3 text-xs text-slate-400">
                                <span class="material-symbols-outlined text-slate-500"
                                    style="font-size:1.1rem;">schedule</span>
                                <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

@endsection
