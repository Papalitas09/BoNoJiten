@extends('layout.user')
@section('title', 'My Orders')
@section('content')

    <div class="px-4 pt-4 pb-6">

        {{-- Header --}}
        <div class="mb-5">
            <h2 class="text-xl font-bold text-gray-900">My Orders</h2>
            <p class="text-sm text-gray-400 mt-0.5">Track all your purchases</p>
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
                    class="flex h-9 shrink-0 items-center justify-center px-4 rounded-full text-xs font-bold transition-colors
                      {{ request('status', '') === $tab['value']
                          ? 'bg-blue-600 text-white'
                          : 'bg-white text-gray-500 border border-gray-200' }}">
                    {{ $tab['label'] }}
                    @if ($tab['value'] !== '')
                        <span
                            class="ml-1.5 flex h-4 w-4 items-center justify-center rounded-full text-[10px]
                                 {{ request('status') === $tab['value'] ? 'bg-white/30 text-white' : 'bg-gray-100 text-gray-500' }}">
                            {{ $orders->where('status', $tab['value'])->count() }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- Flash --}}
        @if (session('success'))
            <div
                class="mb-4 px-4 py-3 bg-green-100 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-2">
                <span class="material-symbols-outlined" style="font-size:1rem;">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        {{-- Orders List --}}
        @if ($orders->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                <span class="material-symbols-outlined text-5xl mb-3">receipt_long</span>
                <p class="font-semibold text-gray-500">No orders yet</p>
                <p class="text-sm text-gray-400 mt-1">Start shopping to see your orders here</p>
                <a href="{{ route('user.explore.index') }}"
                    class="mt-5 px-6 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl">
                    Browse Products
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

                        {{-- Order Header --}}
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-50">
                            <div>
                                <p class="text-xs text-gray-400">Order Number</p>
                                <p class="text-sm font-bold font-mono text-blue-600">#{{ $order->order_number }}</p>
                            </div>
                            {{-- Status Badge --}}
                            @if ($order->status === 'pending')
                                <span
                                    class="flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                    Pending
                                </span>
                            @elseif($order->status === 'completed')
                                <span
                                    class="flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Completed
                                </span>
                            @else
                                <span
                                    class="flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Cancelled
                                </span>
                            @endif
                        </div>

                        {{-- Product Info --}}
                        <div class="flex items-center gap-3 px-4 py-3">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-gray-100">
                                @if ($order->product->image)
                                    <img src="{{ asset('storage/products/' . $order->product->image) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="material-symbols-outlined text-gray-300 w-full"
                                        style="font-size: 3rem;">directions_bike</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-900 truncate">
                                    {{ $order->product->name ?? 'Product not found' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-0.5">
                                    {{ $order->product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                                </p>
                                <p class="text-xs text-gray-500 mt-0.5">Qty: {{ $order->quantity }}</p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-sm font-bold text-gray-900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        {{-- Order Details --}}
                        <div class="px-4 pb-3 space-y-1.5 border-t border-gray-50 pt-3">

                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-gray-400"
                                    style="font-size:0.9rem;">location_on</span>
                                <span class="truncate">{{ $order->address }}</span>
                            </div>

                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-gray-400"
                                    style="font-size:0.9rem;">payments</span>
                                <span>
                                    @if ($order->payment_method === 'transfer')
                                        Bank Transfer
                                    @elseif($order->payment_method === 'ewallet')
                                        E-Wallet
                                    @else
                                        Cash on Delivery
                                    @endif
                                </span>
                            </div>

                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <span class="material-symbols-outlined text-gray-400"
                                    style="font-size:0.9rem;">schedule</span>
                                <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

@endsection
