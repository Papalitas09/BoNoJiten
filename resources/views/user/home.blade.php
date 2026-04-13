@extends('layout.user')
@section('title', 'Home')
@section('content')


    {{-- Hero Banner --}}
    <section class="px-4 py-4">
        <header
            class="sticky top-0 z-50 flex items-center bg-slate-900/80 backdrop-blur-xl p-4 justify-between border-b border-slate-800">
            <div
                class="flex size-10 shrink-0 items-center justify-center rounded-full bg-slate-800 text-slate-200 shadow-inner shadow-slate-700/50">
                <span class="text-2xl font-black text-blue-500">
                        <a href="{{ route('user.profile') }}">{{ strtoupper(substr(Auth::user()->username, 0, 1)) }}</a>
                    </span>
            </div>
            <h1 class="text-xl font-bold leading-tight tracking-tight flex-1 text-center text-slate-100">
                BoNo<span class="text-blue-500 text-shadow-sm">Jiten</span>
            </h1>
            <div class="flex size-10 items-center justify-end">
                <a href="{{ route('user.cart.index') }}" class="relative flex items-center justify-center text-slate-200 hover:text-blue-400 transition-colors">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    @php
                        $cartCount = \App\Models\Cart::where('user_id', Auth::id())->withCount('items')->first()?->items_count ?? 0;
                    @endphp
                    @if($cartCount > 0)
                    <span
                        class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-blue-600 text-xs font-bold text-white shadow-lg">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </header>
        <div class="relative aspect-[16/9] w-full overflow-hidden rounded-2xl bg-gray-200">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: linear-gradient(to right, rgba(15,23,42,0.92) 0%, rgba(15,23,42,0.2) 65%), url({{ asset('storage/mail.jpeg') }});">
            </div>
            <div class="relative flex h-full flex-col justify-center p-6">
                <span
                    class="mb-2 inline-block w-fit rounded bg-blue-600 px-2 py-1 text-xs font-bold uppercase tracking-wider text-white">
                    New Arrival
                </span>
                <h2 class="max-w-xs text-3xl font-extrabold leading-tight text-white">
                    RIDE THE <span class="text-blue-400">PEAK</span>
                </h2>
                <p class="mt-2 max-w-xs text-sm text-slate-300">
                    Experience the ultimate performance with our latest bikes & parts.
                </p>
                <div class="mt-5 flex gap-3">
                    <a href="#products" class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-bold text-white">
                        Shop Now
                    </a>
                    <a href="{{ route('user.explore.index') }}"
                        class="rounded-lg bg-white/10 px-5 py-2.5 text-sm font-bold text-white backdrop-blur-md">
                        Explore
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Category Filter --}}
    <section class="mt-4">
        <div class="no-scrollbar flex gap-3 overflow-x-auto px-4">
            <a href="{{ route('user.home') }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-all duration-300
                  {{ !request('category') ? 'bg-blue-600/20 border border-blue-500/50 text-blue-400 shadow-[0_0_15px_rgba(59,130,246,0.3)]' : 'bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-lg leading-none">apps</span>
                All
            </a>
            <a href="{{ route('user.home', ['category' => 'unit']) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-all duration-300
                  {{ request('category') === 'unit' ? 'bg-blue-600/20 border border-blue-500/50 text-blue-400 shadow-[0_0_15px_rgba(59,130,246,0.3)]' : 'bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-lg leading-none">pedal_bike</span>
                Full Bikes
            </a>
            <a href="{{ route('user.home', ['category' => 'sparepart']) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-all duration-300
                  {{ request('category') === 'sparepart' ? 'bg-blue-600/20 border border-blue-500/50 text-blue-400 shadow-[0_0_15px_rgba(59,130,246,0.3)]' : 'bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-lg leading-none">settings</span>
                Spare Parts
            </a>
            <a href="{{ route('user.home', ['category' => 'equipment']) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-all duration-300
                  {{ request('category') === 'equipment' ? 'bg-blue-600/20 border border-blue-500/50 text-blue-400 shadow-[0_0_15px_rgba(59,130,246,0.3)]' : 'bg-slate-800 text-slate-300 border border-slate-700 hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-lg leading-none">construction</span>
                Equipment
            </a>
        </div>
    </section>

    {{-- Products --}}
    <section class="mt-8 px-4" id="products">

        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold tracking-tight text-slate-100 drop-shadow-md">
                {{ request('category') === 'unit' ? 'Full Bikes' : (request('category') === 'sparepart' ? 'Spare Parts' : (request('category') === 'equipment' ? 'Equipment' : 'Trending Now')) }}
            </h3>
            <span class="text-xs text-gray-400 font-medium">{{ $products->count() }} items</span>
        </div>

        @if ($products->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-slate-500">
                <span class="material-symbols-outlined text-5xl mb-3">directions_bike</span>
                <p class="font-medium">No products available</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 md:gap-4 pb-6 pt-2">
                @foreach ($products as $product)
                    <div class="flex flex-col h-full rounded-2xl bg-slate-800 border border-slate-700 p-3 shadow-lg shadow-black/20 hover:border-blue-500/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">

                        {{-- Image --}}
                        <div
                            class="relative aspect-square w-full shrink-0 overflow-hidden rounded-xl bg-slate-700/50 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <img src="{{ asset('storage/mail.jpeg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif

                            @if ($product->stock <= 5 && $product->stock > 0)
                                <span class="absolute top-2 left-2 bg-rose-500/80 backdrop-blur-sm text-white px-2 py-0.5 rounded text-xs font-bold shadow-md z-10">Low Stock</span>
                            @endif

                            <form action="{{ route('user.favorites.toggle', $product) }}" method="POST"
                                class="absolute top-2 right-2 z-10">
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
                        <a href="{{ route('user.products.show', $product) }}" class="flex flex-col flex-1 text-left">
                            <div class="mt-3 flex flex-col flex-1">
                                <p class="text-xs font-bold uppercase tracking-widest text-blue-400">
                                    {{ $product->categories === 'unit' ? 'Full Bike' : ($product->categories === 'sparepart' ? 'Spare Part' : 'Equipment') }}
                                </p>
                                <h4 class="mt-1 font-bold text-slate-100 text-sm leading-snug line-clamp-2">
                                    {{ $product->name }}
                                </h4>
                                <div class="mt-auto pt-3 flex items-center justify-between">
                                    <span class="text-sm font-extrabold text-blue-50 tracking-tight">
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
                            </div>
                        </a>

                    </div>
                @endforeach
            </div>
        @endif

    </section>

    {{-- Workshop Banner --}}
    <section class="mt-8 px-4 pb-4">
        <div class="relative overflow-hidden rounded-2xl border border-blue-500/20 bg-blue-900/20 p-5 shadow-lg">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-blue-500/20 blur-xl"></div>
            <div class="flex items-center gap-4 relative z-10">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-600/80 backdrop-blur shadow-inner shadow-blue-400/50 text-white">
                    <span class="material-symbols-outlined text-white">build</span>
                </div>
                <div>
                    <h4 class="font-bold text-slate-100 text-lg">Pro Workshop</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Premium tuning and assembly for your ride.</p>
                </div>
            </div>
        </div>
    </section>

@endsection
