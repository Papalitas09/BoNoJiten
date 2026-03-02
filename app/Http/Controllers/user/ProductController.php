<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;

class ProductController extends Controller
{
    public function Show(Product $product)
    {
        $totalSold = Order::where('product_id', $product->id)
            ->where('status', 'completed')->sum('quantity');
        $totalFavorites = Favorite::where('product_id', $product->id)->count();
        $relatedProducts = Product::where('categories', $product->categories)
            ->where('id', '!=', $product->id)
            ->where('status', 'available')
            ->take(5)
            ->get();

        return view('user.products.show', compact('product', 'totalSold', 'totalFavorites', 'relatedProducts'));
    }
}
