<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ExploreController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'available')
            ->when(request('category'), fn ($q, $cat) => $q->where('categories', $cat))
            ->when(request('search'), fn ($q, $s) => $q->where('name', 'like', "%{$s}%")
                ->orWhere('description', 'like', "%{$s}%"))
            ->get();

        return view('user.explore', compact('products'));
    }
}
