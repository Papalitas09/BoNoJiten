@extends('layout.admin')
@section('title', 'Edit Product')
@section('content')
    <div class="p-6 max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.products.update', $product) }}" method="POST"
            class="bg-white rounded-xl shadow-sm border border-gray-200 divide-y divide-gray-100" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="p-6 space-y-5">

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Product Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}"
                        placeholder="e.g. Shimano Brake Pad"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           {{ $errors->has('name') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}" />
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4" placeholder="Write a short product description..."
                        class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none
                           {{ $errors->has('description') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Price & Stock --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                            Price (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm pointer-events-none">
                                Rp
                            </span>
                            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                                placeholder="0" min="0" step="0.01"
                                class="w-full pl-9 pr-3 py-2 border rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   {{ $errors->has('price') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}" />
                        </div>
                        @error('price')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">
                            Stock <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}"
                            placeholder="0" min="0"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                               {{ $errors->has('stock') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}" />
                        @error('stock')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Category & Status --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="categories" class="block text-sm font-medium text-gray-700 mb-1">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="categories" name="categories"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white
                               {{ $errors->has('categories') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                            <option value="unit"
                                {{ old('categories', $product->categories) === 'unit' ? 'selected' : '' }}>Unit
                            </option>
                            <option value="sparepart"
                                {{ old('categories', $product->categories) === 'sparepart' ? 'selected' : '' }}>Sparepart
                            </option>
                        </select>
                        @error('categories')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white
                               {{ $errors->has('status') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                            <option value="available"
                                {{ old('status', $product->status) === 'available' ? 'selected' : '' }}>Available
                            </option>
                            <option value="unavailable"
                                {{ old('status', $product->status) === 'unavailable' ? 'selected' : '' }}>Unavailable
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Images --}}
                </div>
                
                <div class="space-y-4 pt-4 border-t border-gray-100">
                    <h3 class="text-sm font-bold text-gray-800">Media & Images</h3>
                    <div class="grid grid-cols-2 gap-4">
                        {{-- Cover Image --}}
                        <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl">
                            <label for="image" class="block text-sm font-medium text-blue-900 mb-2">
                                Cover Image (Primary)
                            </label>
                            
                            @if (isset($product) && $product->image)
                                <div class="mb-3">
                                    <div class="w-24 h-24 rounded-lg overflow-hidden border border-blue-200">
                                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="Current image"
                                            class="w-full h-full object-cover">
                                    </div>
                                </div>
                            @endif

                            <input type="file" class="w-full text-sm text-blue-700
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-white file:text-blue-700
                                hover:file:bg-blue-50" 
                                id="image" name="image" accept="image/*">
                            @error('image')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Gallery Images --}}
                        <div class="bg-purple-50 border border-purple-100 p-4 rounded-xl">
                            <label for="images" class="block text-sm font-medium text-purple-900 mb-2">
                                Add Gallery Images (Multiple)
                            </label>
                            
                            @if (isset($product) && $product->images->isNotEmpty())
                                <div class="mb-3 flex flex-wrap gap-2">
                                    @foreach($product->images as $img)
                                        <div class="w-16 h-16 rounded-md overflow-hidden border border-purple-200 relative group">
                                            <img src="{{ asset('storage/products/' . $img->image_path) }}" alt="Gallery" class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <input type="file" class="w-full text-sm text-purple-700
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-lg file:border-0
                                file:text-sm file:font-semibold
                                file:bg-white file:text-purple-700
                                hover:file:bg-purple-50" 
                                id="images" name="images[]" multiple accept="image/*">
                            @error('images.*')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-purple-400">Appending new images. Existing images stay.</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Footer Buttons --}}
            <div class="px-6 py-4 flex items-center justify-between">
                <button type="button" onclick="document.getElementById('delete-form').submit()"
                    class="px-4 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                    Delete Product
                </button>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                        Update Product
                    </button>
                </div>
            </div>

        </form>

        {{-- Delete form OUTSIDE the update form --}}
        <form id="delete-form" action="{{ route('admin.products.destroy', $product) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete {{ addslashes($product->name) }}?')">
            @csrf
            @method('DELETE')
        </form>

    </div>

@endsection
