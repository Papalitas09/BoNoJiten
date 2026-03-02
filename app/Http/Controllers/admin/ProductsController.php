<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,unavailable',
            'categories' => 'required|in:unit,spharepart',
        ]);

        $data = $request->except('image');

        // Handle file upload dengan BENAR
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Generate nama file unik
            $filename = time().'_'.$file->getClientOriginalName();

            // Simpan ke storage/app/public/products
            $path = $file->storeAs('products', $filename, 'public');

            // Simpan hanya nama file ke database (BUKAN path lengkap)
            $data['image'] = $filename;

            // Debug log (hapus setelah selesai)
            \Log::info('File uploaded:', [
                'original' => $file->getClientOriginalName(),
                'saved_as' => $filename,
                'path' => $path,
                'full_path' => storage_path('app/public/'.$path),
            ]);
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,unavailable',
            'categories' => 'required|in:unit,spharepart',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete('products/'.$product->image);
            }

            // Upload file baru
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('products', $filename, 'public');

            // Simpan nama file
            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        // Hapus file gambar jika ada
        if ($product->image) {
            Storage::disk('public')->delete('products/'.$product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}
