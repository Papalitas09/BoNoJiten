@extends('layout.admin')
@section('title', 'Products')
@section('content')
    <div class="p-6">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Products</h1>
            <a href="{{ route('admin.products.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                + Add Product
            </a>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200 text-gray-500 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 w-12">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Image</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Stock</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-gray-400">{{ $product->id }}</td>

                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $product->name }}
                                </td>
                                <td class="px-4 py-3">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/products/' . $product->image) }}"
                                            class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-gray-300"
                                                style="font-size:1.5rem;">directions_bike</span>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-gray-500 max-w-xs">
                                    <span title="{{ $product->description }}">
                                        {{ Str::limit($product->description, 50) ?? '-' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-gray-800 font-medium">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-3">
                                    <span
                                        class="{{ $product->stock <= 5 ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    @if ($product->categories === 'unit')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                            Unit
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                            Sparepart
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    @if ($product->status === 'available')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            Available
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            Unavailable
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="text-xs text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                            Edit
                                        </a>
                                        <span class="text-gray-300">|</span>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                            onsubmit="return confirm('Delete {{ addslashes($product->name) }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-xs text-red-500 hover:text-red-700 font-medium hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-12 text-center text-gray-400">
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination
        @if ($products->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @endif --}}
        </div>
    </div>
@endsection
