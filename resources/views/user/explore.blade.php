@extends('layout.user')
@section('title', 'Explore')
@section('content')

    {{-- Search Bar --}}
    <section class="px-4 pt-4">
        <form action="{{ route('user.explore.index') }}" method="GET">
            <div class="relative group">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 group-focus-within:text-blue-500 transition-colors"
                    style="font-size:1.2rem;">search</span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search bikes, spare parts..."
                    class="w-full pl-11 pr-4 py-3 bg-slate-800/50 backdrop-blur-md border border-slate-700/50 rounded-2xl text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 shadow-inner shadow-black/20 transition-all duration-300" />
                @if (request('search'))
                    <a href="{{ route('user.explore.index') }}"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition-colors">
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
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-all duration-300
                  {{ !request('category') ? 'bg-blue-600/20 border border-blue-500/50 text-blue-400 shadow-[0_0_15px_rgba(59,130,246,0.3)]' : 'bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-lg leading-none">apps</span>
                All
            </a>

            <a href="{{ route('user.explore.index', array_filter(['category' => 'unit', 'search' => request('search')])) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-all duration-300
                  {{ request('category') === 'unit' ? 'bg-blue-600/20 border border-blue-500/50 text-blue-400 shadow-[0_0_15px_rgba(59,130,246,0.3)]' : 'bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-lg leading-none">pedal_bike</span>
                Full Bikes
            </a>

            <a href="{{ route('user.explore.index', array_filter(['category' => 'sparepart', 'search' => request('search')])) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-all duration-300
                  {{ request('category') === 'sparepart' ? 'bg-blue-600/20 border border-blue-500/50 text-blue-400 shadow-[0_0_15px_rgba(59,130,246,0.3)]' : 'bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-lg leading-none">settings</span>
                Spare Parts
            </a>

            <a href="{{ route('user.explore.index', array_filter(['category' => 'equipment', 'search' => request('search')])) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-all duration-300
                  {{ request('category') === 'equipment' ? 'bg-blue-600/20 border border-blue-500/50 text-blue-400 shadow-[0_0_15px_rgba(59,130,246,0.3)]' : 'bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-lg leading-none">construction</span>
                Equipment
            </a>

        </div>
    </section>

    {{-- Results info --}}
    <section class="mt-5 px-4">
        <div class="flex items-center justify-between">
            <div>
                @if (request('search'))
                    <p class="text-sm text-slate-400">
                        Results for <span class="font-semibold text-slate-100">"{{ request('search') }}"</span>
                    </p>
                @else
                    <h3 class="text-lg font-bold text-slate-100 drop-shadow-md">
                        {{ request('category') === 'unit' ? 'Full Bikes' : (request('category') === 'sparepart' ? 'Spare Parts' : (request('category') === 'equipment' ? 'Equipment' : 'All Products')) }}
                    </h3>
                @endif
            </div>
            <span class="text-xs text-slate-500 font-medium">{{ $products->count() }} items</span>
        </div>
    </section>

    {{-- Products Grid --}}
    <section class="mt-4 px-4 pb-6">
        @if ($products->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-slate-500">
                <span class="material-symbols-outlined text-5xl mb-3">search_off</span>
                <p class="font-semibold text-slate-400">No products found</p>
                @if (request('search'))
                    <p class="text-sm text-slate-500 mt-1">Try a different keyword</p>
                    <a href="{{ route('user.explore.index') }}"
                        class="mt-4 px-5 py-2 hover:bg-slate-700 bg-slate-800 border border-slate-700 text-slate-200 text-sm font-bold rounded-xl transition-colors">
                        Clear Search
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 md:gap-4">
                @foreach ($products as $product)
                    <div class="rounded-2xl bg-slate-800 border border-slate-700 p-3 shadow-lg shadow-black/20 hover:border-blue-500/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col">

                        {{-- Image --}}
                        <div
                            class="relative aspect-square w-full overflow-hidden rounded-xl bg-slate-700/50 flex items-center justify-center shrink-0">
                            @if ($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <img src="{{ asset('storage/mail.jpeg') }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif

                            @if ($product->stock <= 5 && $product->stock > 0)
                                <span class="absolute top-2 left-2 bg-rose-500/80 backdrop-blur-sm text-white px-2 py-0.5 rounded text-xs font-bold shadow-md">Low Stock</span>
                            @endif

                            {{-- Favorite --}}
                            <form action="{{ route('user.favorites.toggle', $product) }}" method="POST"
                                class="absolute top-2 right-2">
                                @csrf
                                <button type="submit"
                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900/60 backdrop-blur-md shadow-sm hover:scale-110 transition-transform">
                                    <span
                                        class="material-symbols-outlined text-lg
                                             {{ $product->isFavoritedBy(Auth::id()) ? 'text-rose-500' : 'text-slate-300' }}"
                                        @if ($product->isFavoritedBy(Auth::id())) style="font-variation-settings:'FILL' 1" @endif>
                                        favorite
                                    </span>
                                </button>
                            </form>
                        </div>

                        {{-- Info --}}
                        <a href="{{ route('user.products.show', $product) }}" class="flex flex-1 flex-col mt-3">
                            <p class="text-xs font-bold uppercase tracking-widest text-blue-400">
                                {{ $product->categories === 'unit' ? 'Full Bike' : ($product->categories === 'sparepart' ? 'Spare Part' : 'Equipment') }}
                            </p>
                            <h4 class="mt-1 font-bold text-slate-100 text-sm leading-tight line-clamp-2">
                                {{ $product->name }}
                            </h4>
                            <p class="text-[11px] text-slate-400 mt-1 line-clamp-2 leading-relaxed flex-1">
                                {{ $product->description ?? 'No description' }}
                            </p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-sm font-extrabold text-blue-50">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                @if ($product->stock > 0 && $product->status === 'available')
                                    <form action="{{ route('user.cart.add', $product) }}" method="POST" onclick="event.stopPropagation();">
                                        @csrf
                                        <button type="submit" title="Add to Cart"
                                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-700 text-blue-400 hover:bg-blue-600 hover:text-white transition-colors shadow-inner shadow-slate-600/50">
                                            <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
                                        </button>
                                    </form>
                                @else
                                        <span class="text-xs font-bold px-2 py-1 bg-rose-500/10 text-rose-400 rounded">Sold</span>
                                @endif
                            </div>
                        </a>

                    </div>
                @endforeach
            </div>
        @endif
    </section>

@endsection
