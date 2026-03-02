@extends('layout.user')
@section('title', 'Explore')
@section('content')

    {{-- Search Bar --}}
    <section class="px-4 pt-4">
        <form action="{{ route('user.explore.index') }}" method="GET">
            <div class="relative">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"
                    style="font-size:1.2rem;">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search bikes, spare parts..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm" />
                @if (request('search'))
                    <a href="{{ route('user.explore.index') }}"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <span class="material-symbols-outlined" style="font-size:1.1rem;">close</span>
                    </a>
                @endif
            </div>

            {{-- Keep category filter when searching --}}
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
        </form>
    </section>

    {{-- Category Filter --}}
    <section class="mt-4">
        <div class="no-scrollbar flex gap-3 overflow-x-auto px-4">

            <a href="{{ route('user.explore.index', array_filter(['search' => request('search')])) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-colors
                  {{ !request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-700 border border-gray-200' }}">
                <span class="material-symbols-outlined text-lg leading-none">apps</span>
                All
            </a>

            <a href="{{ route('user.explore.index', array_filter(['category' => 'unit', 'search' => request('search')])) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-colors
                  {{ request('category') === 'unit' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-700 border border-gray-200' }}">
                <span class="material-symbols-outlined text-lg leading-none">pedal_bike</span>
                Full Bikes
            </a>

            <a href="{{ route('user.explore.index', array_filter(['category' => 'spharepart', 'search' => request('search')])) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-colors
                  {{ request('category') === 'spharepart' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-700 border border-gray-200' }}">
                <span class="material-symbols-outlined text-lg leading-none">settings</span>
                Spare Parts
            </a>

        </div>
    </section>

    {{-- Results info --}}
    <section class="mt-5 px-4">
        <div class="flex items-center justify-between">
            <div>
                @if (request('search'))
                    <p class="text-sm text-gray-500">
                        Results for <span class="font-semibold text-gray-800">"{{ request('search') }}"</span>
                    </p>
                @else
                    <h3 class="text-lg font-bold text-gray-900">
                        {{ request('category') === 'unit' ? 'Full Bikes' : (request('category') === 'spharepart' ? 'Spare Parts' : 'All Products') }}
                    </h3>
                @endif
            </div>
            <span class="text-xs text-gray-400 font-medium">{{ $products->count() }} items</span>
        </div>
    </section>

    {{-- Products Grid --}}
    <section class="mt-4 px-4 pb-6">
        @if ($products->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                <span class="material-symbols-outlined text-5xl mb-3">search_off</span>
                <p class="font-semibold text-gray-500">No products found</p>
                @if (request('search'))
                    <p class="text-sm text-gray-400 mt-1">Try a different keyword</p>
                    <a href="{{ route('user.explore.index') }}"
                        class="mt-4 px-5 py-2 bg-blue-600 text-white text-sm font-bold rounded-xl">
                        Clear Search
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <div class="rounded-2xl bg-white border border-gray-100 p-3 shadow-sm">

                        {{-- Image --}}
                        <div
                            class="relative aspect-square w-full overflow-hidden rounded-xl bg-gray-100 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-gray-300"
                                    style="font-size: 3rem;">directions_bike</span>
                            @endif

                            {{-- badges tetap di sini --}}
                            @if ($product->stock <= 5 && $product->stock > 0)
                                <span class="absolute top-2 left-2 ...">Low Stock</span>
                            @endif

                            {{-- Favorite --}}
                            <form action="{{ route('user.favorites.toggle', $product) }}" method="POST"
                                class="absolute top-2 right-2">
                                @csrf
                                <button type="submit"
                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-white/80 shadow-sm">
                                    <span
                                        class="material-symbols-outlined text-lg
                                             {{ $product->isFavoritedBy(Auth::id()) ? 'text-red-500' : 'text-gray-400' }}"
                                        @if ($product->isFavoritedBy(Auth::id())) style="font-variation-settings:'FILL' 1" @endif>
                                        favorite
                                    </span>
                                </button>
                            </form>
                        </div>

                        {{-- Info --}}
                        <div class="mt-3">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-blue-600">
                                {{ $product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                            </p>
                            <h4 class="mt-1 font-bold text-gray-900 text-sm leading-tight truncate">
                                {{ $product->name }}
                            </h4>
                            <p class="text-xs text-gray-400 mt-0.5 truncate">
                                {{ Str::limit($product->description, 40) ?? 'No description' }}
                            </p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-sm font-bold text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                @if ($product->stock > 0 && $product->status === 'available')
                                    <a href="{{ route('user.orders.create', $product) }}"
                                        class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600 text-white">
                                        <span class="material-symbols-outlined text-xl">add</span>
                                    </a>
                                @else
                                    <span class="text-xs text-red-400 font-medium">Unavailable</span>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </section>

@endsection
