{{-- resources/views/user/products/favorites.blade.php --}}
@extends('layout.user')
@section('title', 'My Favorites')
@section('content')

    {{-- Header dengan gradient (responsive) --}}
    <div class="sticky top-0 z-10 bg-gradient-to-r from-blue-600 to-blue-500 px-4 py-4 shadow-md">
        <div class="flex items-center gap-3">
            <a href="{{ url()->previous() }}"
                class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur border border-white/30 text-white hover:bg-white/30 transition-all">
                <span class="material-symbols-outlined" style="font-size:1.2rem;">arrow_back</span>
            </a>
            <h2 class="text-xl font-bold text-white">My Favorites</h2>
        </div>
    </div>

    {{-- Info & Count Card (responsive) --}}
    <section class="px-4 mt-4 mb-4">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center">
                    <span class="material-symbols-outlined text-red-500" style="font-size:1.5rem;">favorite</span>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Your Favorite Items</h3>
                    <p class="text-xs text-gray-400">Products you've saved</p>
                </div>
            </div>
            <div class="flex items-center gap-2 ml-13 sm:ml-0">
                <div class="bg-blue-50 px-4 py-2 rounded-xl">
                    <span class="text-sm font-bold text-blue-600">{{ $favorites->count() }}</span>
                    <span class="text-xs text-gray-500 ml-1">items</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Favorites Grid - FULLY RESPONSIVE --}}
    <section class="px-4 pb-8">
        @if ($favorites->isEmpty())
            {{-- Empty State - Responsive --}}
            <div class="flex flex-col items-center justify-center min-h-[60vh] text-gray-400">
                <div class="w-32 h-32 sm:w-40 sm:h-40 bg-red-50 rounded-full flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-red-200" style="font-size: 4rem; sm:font-size: 5rem;">favorite</span>
                </div>
                <p class="font-semibold text-gray-700 text-xl sm:text-2xl">No favorites yet</p>
                <p class="text-sm text-gray-400 mt-2 text-center max-w-[280px] sm:max-w-[320px] px-4">
                    Tap the heart icon on any product to add it to your favorites list
                </p>
                <div class="flex flex-col sm:flex-row gap-3 mt-8 w-full sm:w-auto px-4 sm:px-0">
                    <a href="{{ route('user.explore.index') }}"
                        class="w-full sm:w-auto text-center px-6 py-3.5 bg-blue-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                        Browse Products
                    </a>
                    <a href="{{ route('user.home') }}"
                        class="w-full sm:w-auto text-center px-6 py-3.5 bg-gray-100 text-gray-700 text-sm font-bold rounded-xl hover:bg-gray-200 transition-all">
                        Go to Home
                    </a>
                </div>
            </div>
        @else
            {{-- Grid: 2 kolom mobile, 3 kolom tablet, 4 kolom desktop --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 sm:gap-4">
                @foreach ($favorites as $favorite)
                    <div class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                        
                        {{-- Image Container --}}
                        <div class="relative aspect-square w-full overflow-hidden rounded-t-2xl bg-gradient-to-br from-gray-50 to-gray-100">
                            @if ($favorite->product->image)
                                @php
                                    $imageName = basename($favorite->product->image);
                                    $imagePath = 'products/' . $imageName;
                                @endphp
                                <img src="{{ asset('storage/' . $imagePath) }}" 
                                     alt="{{ $favorite->product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                     onerror="this.onerror=null; this.parentElement.innerHTML='<span class=\'material-symbols-outlined text-gray-300\' style=\'font-size:3rem;\'>image_not_supported</span>'">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-gray-300" style="font-size:3rem;">directions_bike</span>
                                </div>
                            @endif

                            {{-- Low Stock Badge - Responsive --}}
                            @if ($favorite->product->stock <= 5 && $favorite->product->stock > 0)
                                <span class="absolute top-2 left-2 text-[10px] sm:text-xs bg-gradient-to-r from-red-500 to-red-400 text-white px-2 py-1 rounded-full shadow-md">
                                    Low Stock
                                </span>
                            @endif

                            {{-- Unavailable Badge --}}
                            @if ($favorite->product->status !== 'available' || $favorite->product->stock <= 0)
                                <span class="absolute inset-0 bg-black/40 backdrop-blur-[2px] flex items-center justify-center">
                                    <span class="text-white text-xs sm:text-sm font-bold bg-black/60 px-3 py-1.5 rounded-full">
                                        Unavailable
                                    </span>
                                </span>
                            @endif

                            {{-- Favorite Button (to remove) --}}
                            <form action="{{ route('user.favorites.toggle', $favorite->product) }}" method="POST" class="absolute top-2 right-2 z-10">
                                @csrf
                                <button type="submit" 
                                    class="flex h-8 w-8 sm:h-9 sm:w-9 items-center justify-center rounded-full bg-white/90 backdrop-blur shadow-lg hover:bg-red-50 transition-all group/btn"
                                    title="Remove from favorites">
                                    <span class="material-symbols-outlined text-red-500 group-hover/btn:scale-110 transition-transform" 
                                          style="font-size:1.2rem; sm:font-size:1.4rem;" 
                                          style="font-variation-settings:'FILL' 1">
                                        favorite
                                    </span>
                                </button>
                            </form>
                        </div>

                        {{-- Content --}}
                        <div class="p-2 sm:p-3">
                            {{-- Category --}}
                            <p class="text-[8px] sm:text-[10px] font-bold uppercase tracking-widest text-blue-600 mb-1">
                                {{ $favorite->product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                            </p>

                            {{-- Name --}}
                            <h4 class="font-bold text-gray-900 text-xs sm:text-sm leading-tight truncate">
                                {{ $favorite->product->name }}
                            </h4>

                            {{-- Description (hidden on mobile) --}}
                            <p class="hidden sm:block text-[10px] sm:text-xs text-gray-400 mt-1 truncate">
                                {{ Str::limit($favorite->product->description, 30) ?? 'No description' }}
                            </p>

                            {{-- Price & Action --}}
                            <div class="mt-2 flex items-center justify-between">
                                <div>
                                    <span class="text-xs sm:text-sm font-bold text-gray-900">
                                        Rp {{ number_format($favorite->product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                @if ($favorite->product->stock > 0 && $favorite->product->status === 'available')
                                    <a href="{{ route('user.orders.create', $favorite->product) }}" 
                                       class="flex h-7 w-7 sm:h-8 sm:w-8 items-center justify-center rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors"
                                       title="Order now">
                                        <span class="material-symbols-outlined text-base sm:text-lg">add</span>
                                    </a>
                                @else
                                    <span class="text-[8px] sm:text-[10px] text-red-400 font-medium px-1.5 py-0.5 bg-red-50 rounded-full">
                                        Sold Out
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Bottom Navigation for Mobile --}}
            <div class="mt-8 flex justify-center sm:hidden">
                <a href="{{ route('user.explore.index') }}" 
                   class="flex items-center gap-2 text-blue-600 bg-blue-50 px-5 py-3 rounded-xl text-sm font-bold">
                    <span class="material-symbols-outlined">explore</span>
                    Explore More Products
                </a>
            </div>
        @endif
    </section>

    {{-- Floating Action Button for Mobile (optional) --}}
    @if(!$favorites->isEmpty())
        <div class="fixed bottom-20 right-4 sm:hidden">
            <a href="{{ route('user.explore.index') }}"
               class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg shadow-blue-300 hover:bg-blue-700 transition-all">
                <span class="material-symbols-outlined">add</span>
            </a>
        </div>
    @endif

@endsection