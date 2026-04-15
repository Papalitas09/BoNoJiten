<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,unavailable',
            'categories' => 'required|in:unit,sparepart,equipment',
        ]);

        $data = $request->except(['image', 'images']);

        // Handle cover image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_cover_'.$file->getClientOriginalName();
            $file->storeAs('products', $filename, 'public');
            $data['image'] = $filename;
        }

        $product = Product::create($data);

        // Handle gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time().'_gallery_'.$file->getClientOriginalName();
                $file->storeAs('products', $filename, 'public');
                $product->images()->create(['image_path' => $filename]);
            }
        }

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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:available,unavailable',
            'categories' => 'required|in:unit,sparepart,equipment',
        ]);

        $data = $request->except(['image', 'images']);

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete('products/'.$product->image);
            }

            // Upload file baru
            $file = $request->file('image');
            $filename = time().'_cover_'.$file->getClientOriginalName();
            $file->storeAs('products', $filename, 'public');
            $data['image'] = $filename;
        }

        $product->update($data);

        // Handle extra gallery images (append)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time().'_gallery_'.$file->getClientOriginalName();
                $file->storeAs('products', $filename, 'public');
                $product->images()->create(['image_path' => $filename]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        // Hapus file gambar cover jika ada
        if ($product->image) {
            Storage::disk('public')->delete('products/'.$product->image);
        }

        // Hapus gallery images dari storage
        foreach ($product->images as $img) {
            Storage::disk('public')->delete('products/'.$img->image_path);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}
