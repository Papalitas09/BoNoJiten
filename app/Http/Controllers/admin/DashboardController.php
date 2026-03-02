<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       return view('admin.dashboard', [
            'totalProducts'   => Product::count(),
            'totalOrders'     => Order::count(),
            'totalUsers'      => User::where('role', 'user')->count(),
            'pendingOrders'   => Order::where('status', 'pending')->count(),
            'completedOrders' => Order::where('status', 'completed')->count(),
            'cancelledOrders' => Order::where('status', 'cancelled')->count(),
            'recentOrders'    => Order::with(['user', 'product'])
                                    ->latest()
                                    ->take(5)
                                    ->get(),
            'chartData'       => Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                                    ->whereMonth('created_at', now()->month)
                                    ->groupBy('date')
                                    ->orderBy('date')
                                    ->get(),
        ]);
    }
}
