{{-- resources/views/user/products/favorites.blade.php --}}
@extends('layout.user')
@section('title', 'My Favorites')
@section('content')

    {{-- Header --}}
    <div class="sticky top-0 z-10 bg-slate-900/80 backdrop-blur-xl border-b border-slate-800 px-4 py-4 shadow-md">
        <div class="flex items-center gap-3">
            <a href="{{ url()->previous() }}"
                class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800 border border-slate-700/50 text-slate-200 hover:bg-slate-700 transition-all shadow-sm">
                <span class="material-symbols-outlined" style="font-size:1.2rem;">arrow_back</span>
            </a>
            <h2 class="text-xl font-bold text-slate-100 tracking-tight">My Favorites</h2>
        </div>
    </div>

    {{-- Info & Count Card --}}
    <section class="px-4 mt-6 mb-6">
        <div class="bg-slate-800 rounded-2xl border border-slate-700/50 shadow-lg p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 flex items-center justify-center shadow-inner">
                    <span class="material-symbols-outlined text-rose-500" style="font-size:1.6rem; font-variation-settings: 'FILL' 1;">favorite</span>
                </div>
                <div>
                    <h3 class="font-bold text-slate-100">Saved Items</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Your personal wishlist collection</p>
                </div>
            </div>
            <div class="flex items-center sm:ml-0 bg-slate-900/50 border border-slate-700/50 px-4 py-2.5 rounded-xl">
                <span class="text-sm font-black text-rose-500 tracking-tight">{{ $favorites->count() }}</span>
                <span class="text-xs font-medium text-slate-400 ml-1.5 uppercase tracking-wider">Items</span>
            </div>
        </div>
    </section>

    {{-- Favorites Grid --}}
    <section class="px-4 pb-12">
        @if ($favorites->isEmpty())
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center min-h-[50vh] text-center">
                <div class="w-32 h-32 bg-slate-800 rounded-full flex items-center justify-center mb-6 shadow-inner border border-slate-700/50">
                    <span class="material-symbols-outlined text-slate-600" style="font-size: 4rem;">heart_broken</span>
                </div>
                <p class="font-bold text-slate-100 text-xl">No favorites yet</p>
                <p class="text-sm text-slate-400 mt-2 max-w-[280px]">
                    Tap the heart icon on any product to save it here for later
                </p>
                <div class="flex flex-col sm:flex-row gap-3 mt-8 w-full sm:w-auto px-6 max-w-sm mx-auto">
                    <a href="{{ route('user.explore.index') }}"
                        class="w-full sm:w-auto text-center px-6 py-3.5 bg-blue-600 text-white text-sm font-bold rounded-xl shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:bg-blue-500 transition-all">
                        Browse Products
                    </a>
                </div>
            </div>
        @else
            {{-- Grid format matching Home & Explore --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 md:gap-4">
                @foreach ($favorites as $favorite)
                <div class="group relative bg-slate-800 rounded-2xl border border-slate-700 p-3 shadow-lg shadow-black/20 hover:border-blue-500/50 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                        
                        {{-- Image Container --}}
                        <div class="relative aspect-square w-full shrink-0 overflow-hidden rounded-xl bg-slate-700/50 flex items-center justify-center">
                            @if ($favorite->product->image)
                                <img src="{{ asset('storage/products/' . $favorite->product->image) }}" 
                                     alt="{{ $favorite->product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <img src="{{ asset('storage/mail.jpeg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif

                            {{-- Low Stock Badge --}}
                            @if ($favorite->product->stock <= 5 && $favorite->product->stock > 0)
                                <span class="absolute top-2 left-2 text-xs bg-rose-500/80 backdrop-blur-sm text-white px-2 py-0.5 rounded font-bold shadow-md z-10">
                                    Low Stock
                                </span>
                            @endif

                            {{-- Unavailable Badge --}}
                            @if ($favorite->product->status !== 'available' || $favorite->product->stock <= 0)
                                <span class="absolute inset-0 bg-slate-900/60 backdrop-blur-[2px] flex items-center justify-center z-10">
                                    <span class="text-rose-400 text-xs font-bold bg-rose-500/10 px-3 py-1.5 rounded-lg border border-rose-500/30">
                                        Sold Out
                                    </span>
                                </span>
                            @endif

                            {{-- Favorite Button (to remove) --}}
                            <form action="{{ route('user.favorites.toggle', $favorite->product) }}" method="POST" class="absolute top-2 right-2 z-20">
                                @csrf
                                <button type="submit" 
                                    class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900/60 backdrop-blur-md shadow-sm hover:scale-110 transition-transform group/btn"
                                    title="Remove from favorites">
                                    <span class="material-symbols-outlined text-rose-500 group-hover/btn:opacity-75 transition-opacity text-lg" 
                                          style="font-variation-settings:'FILL' 1">
                                        favorite
                                    </span>
                                </button>
                            </form>
                        </div>

                        {{-- Content --}}
                        <a href="{{ route('user.products.show', $favorite->product) }}" class="flex flex-col flex-1 mt-3">
                            {{-- Category --}}
                            <p class="text-xs font-bold uppercase tracking-widest text-blue-400">
                                {{ $favorite->product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                            </p>

                            {{-- Name --}}
                            <h4 class="font-bold text-slate-100 text-sm mt-1 leading-snug line-clamp-2">
                                {{ $favorite->product->name }}
                            </h4>

                            {{-- Price & Cart --}}
                            <div class="mt-auto pt-3 flex items-center justify-between">
                                <span class="text-sm font-extrabold text-blue-50 tracking-tight">
                                    Rp {{ number_format($favorite->product->price, 0, ',', '.') }}
                                </span>
                                
                                @if ($favorite->product->stock > 0 && $favorite->product->status === 'available')
                                    <form action="{{ route('user.cart.add', $favorite->product) }}" method="POST" onclick="event.stopPropagation();">
                                        @csrf
                                        <button type="submit" title="Add to Cart"
                                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-700 text-blue-400 hover:bg-blue-600 hover:text-white transition-colors shadow-inner shadow-slate-600/50">
                                            <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </a>

                    </div>
                @endforeach
            </div>
        @endif
    </section>

@endsection