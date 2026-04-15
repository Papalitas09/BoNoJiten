@extends('layout.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- Greeting --}}
    <div>
        <h2 class="text-xl sm:text-2xl font-bold text-slate-100">Welcome back, {{ Auth::user()->username }} 👋</h2>
        <p class="text-sm text-slate-400 mt-1">{{ now()->format('l, d F Y') }}</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

        {{-- Total Products --}}
        <div class="bg-slate-800/80 backdrop-blur-md rounded-xl border border-slate-700/50 p-4 sm:p-5 shadow-lg shadow-black/10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-blue-500/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-400" style="font-size:1.1rem;">directions_bike</span>
                </div>
                <span class="text-xs font-medium text-slate-400">Products</span>
            </div>
            <p class="text-2xl sm:text-3xl font-bold text-slate-100">{{ $totalProducts }}</p>
            <p class="text-xs text-slate-400 mt-1">Total listed</p>
        </div>

        {{-- Total Orders --}}
        <div class="bg-slate-800/80 backdrop-blur-md rounded-xl border border-slate-700/50 p-4 sm:p-5 shadow-lg shadow-black/10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-400" style="font-size:1.1rem;">shopping_cart</span>
                </div>
                <span class="text-xs font-medium text-slate-400">Orders</span>
            </div>
            <p class="text-2xl sm:text-3xl font-bold text-slate-100">{{ $totalOrders }}</p>
            <p class="text-xs text-slate-400 mt-1">All time</p>
        </div>

        {{-- Pending Orders --}}
        <div class="bg-slate-800/80 backdrop-blur-md rounded-xl border border-slate-700/50 p-4 sm:p-5 shadow-lg shadow-black/10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-amber-500/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-amber-400" style="font-size:1.1rem;">pending</span>
                </div>
                <span class="text-xs font-medium text-slate-400">Pending</span>
            </div>
            <p class="text-2xl sm:text-3xl font-bold text-slate-100">{{ $pendingOrders }}</p>
            <p class="text-xs text-slate-400 mt-1">Processing</p>
        </div>

        {{-- Total Users --}}
        <div class="bg-slate-800/80 backdrop-blur-md rounded-xl border border-slate-700/50 p-4 sm:p-5 shadow-lg shadow-black/10">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-purple-500/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-400" style="font-size:1.1rem;">group</span>
                </div>
                <span class="text-xs font-medium text-slate-400">Users</span>
            </div>
            <p class="text-2xl sm:text-3xl font-bold text-slate-100">{{ $totalUsers }}</p>
            <p class="text-xs text-slate-400 mt-1">Registered</p>
        </div>

    </div>

    {{-- Chart + Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">

        {{-- Orders Chart --}}
        <div class="lg:col-span-2 bg-slate-800/80 backdrop-blur-md rounded-xl border border-slate-700/50 p-4 sm:p-6 shadow-lg shadow-black/10">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-100">Orders This Month</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Daily order count</p>
                </div>
                <div class="text-right">
                    <p class="text-xl sm:text-2xl font-bold text-blue-400">{{ $totalOrders }}</p>
                    <p class="text-xs text-slate-400">total orders</p>
                </div>
            </div>
            <div class="relative h-40 sm:h-48">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-slate-800/80 backdrop-blur-md rounded-xl border border-slate-700/50 p-4 sm:p-6 shadow-lg shadow-black/10">
            <h3 class="text-sm sm:text-base font-bold text-slate-100 mb-4">Quick Actions</h3>
            <div class="space-y-2">
                <a href="{{ route('admin.products.create') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-500/10 hover:bg-blue-500/20 transition-colors">
                    <span class="material-symbols-outlined text-blue-400 shrink-0" style="font-size:1.1rem;">add_circle</span>
                    <span class="text-sm font-medium text-blue-400">Add New Product</span>
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-emerald-500/10 hover:bg-emerald-500/20 transition-colors">
                    <span class="material-symbols-outlined text-emerald-400 shrink-0" style="font-size:1.1rem;">shopping_cart</span>
                    <span class="text-sm font-medium text-emerald-400">View All Orders</span>
                </a>
                <a href="{{ route('admin.accounts.create') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-purple-500/10 hover:bg-purple-500/20 transition-colors">
                    <span class="material-symbols-outlined text-purple-400 shrink-0" style="font-size:1.1rem;">person_add</span>
                    <span class="text-sm font-medium text-purple-400">Add New User</span>
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-amber-500/10 hover:bg-amber-500/20 transition-colors">
                    <span class="material-symbols-outlined text-amber-400 shrink-0" style="font-size:1.1rem;">inventory_2</span>
                    <span class="text-sm font-medium text-amber-400">Manage Inventory</span>
                </a>
            </div>

            {{-- Order Status Breakdown --}}
            <div class="mt-6 pt-4 border-t border-slate-700/50">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Order Status</p>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-amber-400 shrink-0"></span>
                            <span class="text-slate-300">Pending</span>
                        </span>
                        <span class="font-semibold text-slate-100">{{ $pendingOrders }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 shrink-0"></span>
                            <span class="text-slate-300">Completed</span>
                        </span>
                        <span class="font-semibold text-slate-100">{{ $completedOrders }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-rose-400 shrink-0"></span>
                            <span class="text-slate-300">Cancelled</span>
                        </span>
                        <span class="font-semibold text-slate-100">{{ $cancelledOrders }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Orders --}}
    <div class="bg-slate-800/80 backdrop-blur-md rounded-xl border border-slate-700/50 shadow-lg shadow-black/10 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-slate-700/50 flex items-center justify-between">
            <h3 class="text-sm sm:text-base font-bold text-slate-100">Recent Orders</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-400 hover:text-blue-300 hover:underline font-medium">View all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" style="min-width: 640px;">
                <thead class="bg-slate-700/50 text-slate-300 uppercase text-xs tracking-wider border-b border-slate-700/50">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 whitespace-nowrap">Order #</th>
                        <th class="px-4 sm:px-6 py-3 whitespace-nowrap">Customer</th>
                        <th class="px-4 sm:px-6 py-3 whitespace-nowrap">Product</th>
                        <th class="px-4 sm:px-6 py-3 whitespace-nowrap">Total</th>
                        <th class="px-4 sm:px-6 py-3 whitespace-nowrap">Status</th>
                        <th class="px-4 sm:px-6 py-3 whitespace-nowrap">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-4 sm:px-6 py-4 font-mono text-blue-400 whitespace-nowrap">#{{ $order->order_number }}</td>
                            <td class="px-4 sm:px-6 py-4 font-medium text-slate-200 whitespace-nowrap">{{ $order->user->username ?? '-' }}</td>
                            <td class="px-4 sm:px-6 py-4 text-slate-300 whitespace-nowrap">{{ $order->product->name ?? '-' }}</td>
                            <td class="px-4 sm:px-6 py-4 font-medium text-slate-200 whitespace-nowrap">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                @if($order->status === 'pending')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">Pending</span>
                                @elseif($order->status === 'completed')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Completed</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">Cancelled</span>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-slate-400 whitespace-nowrap">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-400">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const chartData = @json($chartData);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map(d => d.date),
            datasets: [{
                label: 'Orders',
                data: chartData.map(d => d.count),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.08)',
                borderWidth: 2.5,
                pointBackgroundColor: '#2563eb',
                pointRadius: 3,
                pointHoverRadius: 5,
                fill: true,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#94a3b8',
                    bodyColor: '#f1f5f9',
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 11 } }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#94a3b8',
                        font: { size: 11 },
                        stepSize: 1,
                        precision: 0
                    },
                    grid: { color: 'rgba(241,245,249,0.05)' }
                }
            }
        }
    });
</script>
@endpush