@extends('layout.admin')
@section('title', 'Orders')
@section('page_title', 'Orders')
@section('content')

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-100 drop-shadow-md">Orders</h1>
    </div>

    <div class="bg-slate-800/80 backdrop-blur-md rounded-xl shadow-lg shadow-black/10 border border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" style="min-width: 820px;">
                <thead class="bg-slate-700/50 border-b border-slate-700/50 text-slate-300 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 whitespace-nowrap">Order #</th>
                        <th class="px-4 py-3 whitespace-nowrap">Customer</th>
                        <th class="px-4 py-3 whitespace-nowrap">Product</th>
                        <th class="px-4 py-3 whitespace-nowrap">Qty</th>
                        <th class="px-4 py-3 whitespace-nowrap">Total</th>
                        <th class="px-4 py-3 whitespace-nowrap">Address</th>
                        <th class="px-4 py-3 whitespace-nowrap">Status</th>
                        <th class="px-4 py-3 whitespace-nowrap">Date</th>
                        <th class="px-4 py-3 text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-700/30 transition-colors">

                            <td class="px-4 py-3 font-mono text-slate-400 whitespace-nowrap">
                                #{{ $order->order_number }}
                            </td>

                            <td class="px-4 py-3 font-medium text-slate-100 whitespace-nowrap">
                                {{ $order->user->username ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-slate-300 whitespace-nowrap">
                                {{ $order->product->name ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-slate-300 whitespace-nowrap">
                                {{ $order->quantity }}
                            </td>

                            <td class="px-4 py-3 font-medium text-slate-200 whitespace-nowrap">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 text-slate-400" style="max-width: 160px;">
                                <span class="block truncate" title="{{ $order->address }}">
                                    {{ Str::limit($order->address, 30) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @if ($order->status === 'pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">Pending</span>
                                @elseif($order->status === 'completed')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Completed</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">Cancelled</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-slate-400 whitespace-nowrap">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.orders.edit', $order) }}"
                                        class="text-xs text-blue-400 hover:text-blue-300 font-medium hover:underline">
                                        Edit
                                    </a>
                                    <span class="text-slate-600">|</span>
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST"
                                        onsubmit="return confirm('Delete order #{{ $order->order_number }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs text-rose-400 hover:text-rose-300 font-medium hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-12 text-center text-slate-400">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
