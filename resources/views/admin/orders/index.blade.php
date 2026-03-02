@extends('layout.admin')
@section('title', 'Orders')
@section('content')
    <div class="p-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Orders</h1>
        </div>

        @if (session('success'))
            <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200 text-gray-500 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3">Order #</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Qty</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Address</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">

                                <td class="px-4 py-3 font-mono text-gray-600">
                                    #{{ $order->order_number }}
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $order->user->username ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $order->product->name ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $order->quantity }}
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-800">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 text-gray-500 max-w-xs">
                                    <span title="{{ $order->address }}">
                                        {{ Str::limit($order->address, 30) }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    @if ($order->status === 'pending')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                            Pending
                                        </span>
                                    @elseif($order->status === 'completed')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            Completed
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            Cancelled
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-gray-400">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.orders.edit', $order) }}"
                                            class="text-xs text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                            Edit
                                        </a>
                                        <span class="text-gray-300">|</span>
                                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST"
                                            onsubmit="return confirm('Delete order #{{ $order->order_number }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-xs text-red-500 hover:text-red-700 font-medium hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-12 text-center text-gray-400">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
