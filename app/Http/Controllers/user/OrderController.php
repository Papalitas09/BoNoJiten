<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->when(request('status'), fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->get();

        return view('user.orders.index', compact('orders'));
    }

    public function CreateOrder(Product $product)
    {
        return view('user.orders.create', compact('product'));
    }

    public function StoreOrder(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string|min:5',
            'payment_method' => 'required|in:transfer,cod,ewallet',
        ], [
            'product_id.required' => 'Product ID is required',
            'product_id.exists' => 'Product not found',
            'quantity.required' => 'Quantity is required',
            'quantity.integer' => 'Quantity must be a number',
            'quantity.min' => 'Quantity must be at least 1',
            'address.required' => 'Address is required',
            'address.min' => 'Address must be at least 5 characters',
            'payment_method.required' => 'Payment method is required',
            'payment_method.in' => 'Invalid payment method selected',
        ]);

        // Ambil product
        $product = Product::findOrFail($validated['product_id']);

        // Cek stok
        if ($validated['quantity'] > $product->stock) {
            return back()->withInput()->withErrors(['quantity' => 'Quantity exceeds available stock']);
        }

        // Generate order number unik
        $orderNumber = 'ORD-'.date('Ymd').'-'.rand(10000, 99999);

        // Buat order
        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'total_price' => $product->price * $validated['quantity'],
            'address' => $validated['address'],
            'payment_method' => $validated['payment_method'],
            'order_number' => $orderNumber,
            'status' => 'pending',
        ]);

        // Optional: Kurangi stok produk
        $product->update([
            'stock' => $product->stock - $validated['quantity'],
        ]);

        // Hapus produk dari keranjang jika ada
        $cart = \App\Models\Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->where('product_id', $validated['product_id'])->delete();
        }

        return redirect()->route('user.orders.index')->with('success', 'Order placed successfully! Order Number: '.$orderNumber);
    }
}
