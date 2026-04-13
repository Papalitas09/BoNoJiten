<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 🛒 Tampilkan cart
    public function index()
    {
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();

        return view('user.cart', compact('cart'));
    }

    // ➕ Add to cart
    public function add(Product $product)
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first');
        }

        // Ambil / buat cart
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        $item = $cart->items()->where('product_id', $product->id)->first();
        if ($product->stock < 1) {
            return back()->with('error', 'Stock not available');
        } else {
            if ($item) {
                $item->increment('quantity');
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity' => 1,
                ]);
            }

            return back()->with('success', 'Product added to cart');
        }
    }

    // ➖ Update quantity
    public function update(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$item->product->stock,
        ], [
            'quantity.max' => 'Quantity exceeds available stock (Max: '.$item->product->stock.').'
        ]);

        $item->update([
            'quantity' => $request->quantity,
        ]);

        return back()->with('success', 'Cart updated');
    }

    // ❌ Remove item
    public function remove(CartItem $item)
    {
        $item->delete();

        return back()->with('success', 'Item removed');
    }
}
