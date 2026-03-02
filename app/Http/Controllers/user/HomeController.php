<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'available')
            ->when(request('category'), fn ($q, $cat) => $q->where('categories', $cat))
            ->get();

        $orderCount = Order::where('user_id', Auth::id())
            ->where('status', 'pending')->count();

        return view('user.home', compact('products', 'orderCount'));
    }
}
