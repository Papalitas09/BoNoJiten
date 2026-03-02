<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class FavoriteController extends Controller
{
    // Show all favorites
    public function index()
    {
        $favorites = Favorite::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.products.favorites', compact('favorites'));
    }

    // Toggle favorite (add/remove)
    public function toggle(Product $product)
    {
        $existing = Favorite::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Removed from favorites';
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
            $message = 'Added to favorites';
        }

        return back()->with('success', $message);
    }
}
