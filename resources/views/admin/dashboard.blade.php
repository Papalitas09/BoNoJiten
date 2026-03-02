@extends('layout.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- Greeting --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Welcome back, {{ Auth::user()->username }} 👋</h2>
        <p class="text-sm text-gray-500 mt-1">{{ now()->format('l, d F Y') }}</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Total Products --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-600" style="font-size:1.25rem;">directions_bike</span>
                </div>
                <span class="text-xs font-medium text-gray-400">Products</span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $totalProducts }}</p>
            <p class="text-xs text-gray-400 mt-1">Total products listed</p>
        </div>

        {{-- Total Orders --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-green-600" style="font-size:1.25rem;">shopping_cart</span>
                </div>
                <span class="text-xs font-medium text-gray-400">Orders</span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $totalOrders }}</p>
            <p class="text-xs text-gray-400 mt-1">All time orders</p>
        </div>

        {{-- Pending Orders --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-yellow-600" style="font-size:1.25rem;">pending</span>
                </div>
                <span class="text-xs font-medium text-gray-400">Pending</span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $pendingOrders }}</p>
            <p class="text-xs text-gray-400 mt-1">Awaiting processing</p>
        </div>

        {{-- Total Users --}}
        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-600" style="font-size:1.25rem;">group</span>
                </div>
                <span class="text-xs font-medium text-gray-400">Users</span>
            </div>
            <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
            <p class="text-xs text-gray-400 mt-1">Registered accounts</p>
        </div>

    </div>

    {{-- Chart + Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Orders Chart --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-bold text-gray-800">Orders This Month</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Daily order count</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-blue-600">{{ $totalOrders }}</p>
                    <p class="text-xs text-gray-400">total orders</p>
                </div>
            </div>
            <div class="relative h-48">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <h3 class="text-base font-bold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-2">
                <a href="{{ route('admin.products.create') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                    <span class="material-symbols-outlined text-blue-600" style="font-size:1.1rem;">add_circle</span>
                    <span class="text-sm font-medium text-blue-700">Add New Product</span>
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-green-50 hover:bg-green-100 transition-colors">
                    <span class="material-symbols-outlined text-green-600" style="font-size:1.1rem;">shopping_cart</span>
                    <span class="text-sm font-medium text-green-700">View All Orders</span>
                </a>
                <a href="{{ route('admin.accounts.create') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors">
                    <span class="material-symbols-outlined text-purple-600" style="font-size:1.1rem;">person_add</span>
                    <span class="text-sm font-medium text-purple-700">Add New User</span>
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-yellow-50 hover:bg-yellow-100 transition-colors">
                    <span class="material-symbols-outlined text-yellow-600" style="font-size:1.1rem;">inventory_2</span>
                    <span class="text-sm font-medium text-yellow-700">Manage Inventory</span>
                </a>
            </div>

            {{-- Order Status Breakdown --}}
            <div class="mt-6 pt-4 border-t border-gray-100">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Order Status</p>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                            <span class="text-gray-600">Pending</span>
                        </span>
                        <span class="font-semibold text-gray-800">{{ $pendingOrders }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-400"></span>
                            <span class="text-gray-600">Completed</span>
                        </span>
                        <span class="font-semibold text-gray-800">{{ $completedOrders }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-red-400"></span>
                            <span class="text-gray-600">Cancelled</span>
                        </span>
                        <span class="font-semibold text-gray-800">{{ $cancelledOrders }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Orders --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-base font-bold text-gray-800">Recent Orders</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 hover:underline font-medium">View all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-3">Order #</th>
                        <th class="px-6 py-3">Customer</th>
                        <th class="px-6 py-3">Product</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-mono text-blue-600">#{{ $order->order_number }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $order->user->username ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $order->product->name ?? '-' }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($order->status === 'pending')
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">Pending</span>
                                @elseif($order->status === 'completed')
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Completed</span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Cancelled</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-400">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-400">No orders yet.</td>
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
                    grid: { color: '#f1f5f9' }
                }
            }
        }
    });
</script>
@endpush