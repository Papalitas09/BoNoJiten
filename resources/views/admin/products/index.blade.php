@extends('layout.admin')
@section('title', 'Products')
@section('page_title', 'Products')
@section('content')
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6 gap-4">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-100 drop-shadow-md">Products</h1>
        <a href="{{ route('admin.products.create') }}"
            class="bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold px-3 sm:px-4 py-2 rounded-xl transition-all duration-300 shadow-lg shrink-0">
            + Add Product
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-slate-800/80 backdrop-blur-md rounded-xl shadow-lg shadow-black/10 border border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" style="min-width: 750px;">
                <thead class="bg-slate-700/50 border-b border-slate-700/50 text-slate-300 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 w-10 whitespace-nowrap">#</th>
                        <th class="px-4 py-3 whitespace-nowrap">Name</th>
                        <th class="px-4 py-3 whitespace-nowrap">Image</th>
                        <th class="px-4 py-3 whitespace-nowrap">Description</th>
                        <th class="px-4 py-3 whitespace-nowrap">Price</th>
                        <th class="px-4 py-3 whitespace-nowrap">Stock</th>
                        <th class="px-4 py-3 whitespace-nowrap">Category</th>
                        <th class="px-4 py-3 whitespace-nowrap">Status</th>
                        <th class="px-4 py-3 text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($products as $product)
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-4 py-3 text-slate-400 whitespace-nowrap">{{ $product->id }}</td>

                            <td class="px-4 py-3 font-medium text-slate-100 whitespace-nowrap">
                                {{ $product->name }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @if ($product->image)
                                    <img src="{{ asset('storage/products/' . $product->image) }}"
                                        class="w-10 h-10 object-cover rounded-lg border border-slate-700/50">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-slate-700/50 flex items-center justify-center border border-slate-700/50">
                                        <span class="material-symbols-outlined text-slate-400" style="font-size:1.25rem;">directions_bike</span>
                                    </div>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-slate-400 whitespace-nowrap" style="max-width: 180px;">
                                <span class="block truncate" title="{{ $product->description }}">
                                    {{ Str::limit($product->description, 40) ?? '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-slate-200 font-medium whitespace-nowrap">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="{{ $product->stock <= 5 ? 'text-amber-400 font-semibold' : 'text-slate-300' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @if ($product->categories === 'unit')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">Unit</span>
                                @elseif ($product->categories === 'equipment')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-pink-500/10 text-pink-400 border border-pink-500/20">Equipment</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-500/10 text-purple-400 border border-purple-500/20">Sparepart</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @if ($product->status === 'available')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">Available</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">Unavailable</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="text-xs text-blue-400 hover:text-blue-300 font-medium hover:underline">
                                        Edit
                                    </a>
                                    <span class="text-slate-600">|</span>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Delete {{ addslashes($product->name) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs text-rose-400 hover:text-rose-300 font-medium hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-12 text-center text-slate-400">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
