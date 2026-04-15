@extends('layout.admin')
@section('title', 'Create Product')
@section('page_title', 'Add New Product')
@section('content')
    <div class="max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.products.index') }}" class="text-slate-400 hover:text-slate-200 transition-colors p-1 rounded-lg hover:bg-slate-700/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-100 drop-shadow-md">Add New Product</h1>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.products.store') }}" method="POST"
            class="bg-slate-800/80 backdrop-blur-md rounded-xl shadow-lg shadow-black/10 border border-slate-700/50 divide-y divide-slate-700/50"
            enctype="multipart/form-data">

            @csrf

            <div class="p-4 sm:p-6 space-y-5">

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-300 mb-1">
                        Product Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="e.g. Shimano Brake Pad"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           {{ $errors->has('name') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}" />
                    @error('name')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-300 mb-1">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4" placeholder="Write a short product description..."
                        class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none
                           {{ $errors->has('description') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Price & Stock --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block text-sm font-medium text-slate-300 mb-1">
                            Price (Rp) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500 text-sm pointer-events-none">Rp</span>
                            <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="0"
                                min="0" step="0.01"
                                class="w-full pl-9 pr-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                   {{ $errors->has('price') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}" />
                        </div>
                        @error('price')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-slate-300 mb-1">
                            Stock <span class="text-rose-500">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" placeholder="0"
                            min="0"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                               {{ $errors->has('stock') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}" />
                        @error('stock')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Category & Status --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="categories" class="block text-sm font-medium text-slate-300 mb-1">
                            Category <span class="text-rose-500">*</span>
                        </label>
                        <select id="categories" name="categories"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-900/50
                               {{ $errors->has('categories') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}">
                            <option value="" disabled {{ old('categories') ? '' : 'selected' }}>Select category</option>
                            <option value="unit" {{ old('categories') === 'unit' ? 'selected' : '' }} class="bg-slate-800">Unit</option>
                            <option value="sparepart" {{ old('categories') === 'sparepart' ? 'selected' : '' }} class="bg-slate-800">Sparepart</option>
                            <option value="equipment" {{ old('categories') === 'equipment' ? 'selected' : '' }} class="bg-slate-800">Equipment</option>
                        </select>
                        @error('categories')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-300 mb-1">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select id="status" name="status"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-slate-900/50
                               {{ $errors->has('status') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}">
                            <option value="available" {{ old('status', 'available') === 'available' ? 'selected' : '' }} class="bg-slate-800">Available</option>
                            <option value="unavailable" {{ old('status') === 'unavailable' ? 'selected' : '' }} class="bg-slate-800">Unavailable</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Images --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="image" class="block text-sm font-medium text-slate-300 mb-1">
                            Cover Image (Primary)
                        </label>
                        <input type="file" class="w-full text-sm text-slate-400
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-500/10 file:text-blue-400
                            hover:file:bg-blue-500/20 {{ $errors->has('image') ? 'border-rose-500 bg-rose-500/10' : '' }}"
                            id="image" name="image" accept="image/*">
                        @error('image')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="images" class="block text-sm font-medium text-slate-300 mb-1">
                            Gallery Images (Multiple)
                        </label>
                        <input type="file" class="w-full text-sm text-slate-400
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-purple-500/10 file:text-purple-400
                            hover:file:bg-purple-500/20"
                            id="images" name="images[]" multiple accept="image/*">
                        @error('images.*')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-slate-500">Hold Ctrl/Cmd to select multiple files.</p>
                    </div>
                </div>

            </div>

            {{-- Footer Buttons --}}
            <div class="px-4 sm:px-6 py-4 flex items-center justify-end gap-3 bg-slate-800/30">
                <a href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 text-sm font-medium text-slate-200 bg-slate-700 hover:bg-slate-600 rounded-xl transition-colors shadow-sm">
                    Cancel
                </a>
                <button type="submit"
                    class="px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 rounded-xl transition-all duration-300 shadow-lg">
                    Save Product
                </button>
            </div>

        </form>

    </div>

@endsection
