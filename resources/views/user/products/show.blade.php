@extends('layout.user')
@section('title', $product->name)
@section('content')

    <div class="pb-8">

        {{-- Header --}}
        <div class="flex items-center justify-between px-4 pt-4 mb-4">
            <a href="{{ url()->previous() }}"
                class="flex h-10 w-10 items-center justify-center rounded-full bg-white border border-gray-200 shadow-sm">
                <span class="material-symbols-outlined text-gray-700" style="font-size:1.2rem;">arrow_back</span>
            </a>
            <h2 class="text-sm font-bold text-gray-800 flex-1 text-center px-4 truncate">{{ $product->name }}</h2>
            <form action="{{ route('user.favorites.toggle', $product) }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-white border border-gray-200 shadow-sm">
                    <span
                        class="material-symbols-outlined text-lg
                             {{ $product->isFavoritedBy(Auth::id()) ? 'text-red-500' : 'text-gray-400' }}"
                        @if ($product->isFavoritedBy(Auth::id())) style="font-variation-settings:'FILL' 1" @endif>
                        favorite
                    </span>
                </button>
            </form>
        </div>

        {{-- Product Image --}}
        <div class="mx-4">
            <div
                class="aspect-[4/3] w-full rounded-2xl  p-10 bg-gray-100 border border-gray-100 overflow-hidden flex items-center justify-center">
                @if ($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" class="w-full h-full object-cover">
                @else
                    <span class="material-symbols-outlined text-gray-300 w-full"
                        style="font-size: 3rem;">directions_bike</span>
                @endif

                {{-- badges tetap di sini --}}
                @if ($product->stock <= 5 && $product->stock > 0)
                    <span class="absolute top-2 left-2 ...">Low Stock</span>
                @endif
            </div>
        </div>

        {{-- Product Info --}}
        <div class="px-4 mt-5 space-y-4">

            {{-- Badges --}}
            <div class="flex items-center gap-2 flex-wrap">
                <span
                    class="px-3 py-1 rounded-full text-xs font-bold
                         {{ $product->categories === 'unit' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                    {{ $product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                </span>
                <span
                    class="px-3 py-1 rounded-full text-xs font-bold
                         {{ $product->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                    {{ $product->status === 'available' ? 'Available' : 'Unavailable' }}
                </span>
                @if ($product->stock <= 5 && $product->stock > 0)
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-600">Low Stock</span>
                @endif
            </div>

            {{-- Name + Price --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-900 leading-tight">{{ $product->name }}</h1>
                <p class="text-2xl font-bold text-blue-600 mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="flex flex-col items-center justify-center bg-gray-50 rounded-xl p-3 border border-gray-100">
                    <span class="material-symbols-outlined text-blue-600 mb-1" style="font-size:1.2rem;">inventory_2</span>
                    <p class="text-lg font-bold text-gray-900">{{ $product->stock }}</p>
                    <p class="text-[10px] text-gray-400 font-medium">In Stock</p>
                </div>
                <div class="flex flex-col items-center justify-center bg-gray-50 rounded-xl p-3 border border-gray-100">
                    <span class="material-symbols-outlined text-green-600 mb-1"
                        style="font-size:1.2rem;">shopping_bag</span>
                    <p class="text-lg font-bold text-gray-900">{{ $totalSold }}</p>
                    <p class="text-[10px] text-gray-400 font-medium">Sold</p>
                </div>
                <div class="flex flex-col items-center justify-center bg-gray-50 rounded-xl p-3 border border-gray-100">
                    <span class="material-symbols-outlined text-red-500 mb-1" style="font-size:1.2rem;">favorite</span>
                    <p class="text-lg font-bold text-gray-900">{{ $totalFavorites }}</p>
                    <p class="text-[10px] text-gray-400 font-medium">Favorites</p>
                </div>
            </div>

            {{-- ORDER BUTTON — di sini, tengah konten --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm flex items-center gap-4">
                <div class="flex-1">
                    <p class="text-xs text-gray-400">Total Price</p>
                    <p class="text-lg font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                @if ($product->stock > 0 && $product->status === 'available')
                    <a href="{{ route('user.orders.create', $product) }}"
                        class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl transition-colors shadow-lg shadow-blue-200">
                        <span class="material-symbols-outlined" style="font-size:1.1rem;">shopping_cart</span>
                        Order Now
                    </a>
                @else
                    <button disabled
                        class="flex items-center gap-2 bg-gray-200 text-gray-400 font-bold px-6 py-3 rounded-xl cursor-not-allowed">
                        <span class="material-symbols-outlined" style="font-size:1.1rem;">block</span>
                        Unavailable
                    </button>
                @endif
            </div>

            {{-- Description --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                <h3 class="text-sm font-bold text-gray-800 mb-2">Description</h3>
                <p class="text-sm text-gray-500 leading-relaxed">
                    {{ $product->description ?? 'No description available for this product.' }}
                </p>
            </div>

            {{-- Product Details --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm">
                <h3 class="text-sm font-bold text-gray-800 mb-3">Product Details</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-blue-600" style="font-size:1.1rem;">category</span>
                        <span class="text-gray-400 flex-1">Category</span>
                        <span
                            class="font-semibold text-gray-800">{{ $product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}</span>
                    </div>
                    <div class="h-px bg-gray-50"></div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-green-600" style="font-size:1.1rem;">check_circle</span>
                        <span class="text-gray-400 flex-1">Status</span>
                        <span
                            class="font-semibold {{ $product->status === 'available' ? 'text-green-600' : 'text-red-500' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </div>
                    <div class="h-px bg-gray-50"></div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-orange-500" style="font-size:1.1rem;">inventory_2</span>
                        <span class="text-gray-400 flex-1">Stock</span>
                        <span
                            class="font-semibold {{ $product->stock <= 5 ? 'text-orange-500' : 'text-gray-800' }}">{{ $product->stock }}
                            units</span>
                    </div>
                    <div class="h-px bg-gray-50"></div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-blue-600" style="font-size:1.1rem;">payments</span>
                        <span class="text-gray-400 flex-1">Price</span>
                        <span class="font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            @if ($relatedProducts->isNotEmpty())
                <div>
                    <h3 class="text-sm font-bold text-gray-800 mb-3">You May Also Like</h3>
                    <div class="no-scrollbar flex gap-3 overflow-x-auto pb-2">
                        @foreach ($relatedProducts as $related)
                            <a href="{{ route('user.products.show', $related) }}"
                                class="min-w-[140px] flex-none rounded-xl bg-white border border-gray-100 p-3 shadow-sm">
                                <div
                                    class="aspect-square w-full rounded-lg bg-gray-100 flex items-center justify-center mb-2">
                                    <span class="material-symbols-outlined text-gray-300"
                                        style="font-size:2rem;">directions_bike</span>
                                </div>
                                <p class="text-xs font-bold text-gray-900 truncate">{{ $related->name }}</p>
                                <p class="text-xs font-bold text-blue-600 mt-0.5">Rp
                                    {{ number_format($related->price, 0, ',', '.') }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

    </div>

@endsection
