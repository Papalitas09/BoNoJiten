@extends('layout.user')
@section('title', $product->name)
@section('content')

    <div class="pb-5">

        {{-- Header --}}
        <div class="flex items-center justify-between px-4 pt-4 mb-4">
            <a href="{{ url()->previous() }}"
                class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 backdrop-blur-md border border-slate-700/50 shadow-sm hover:scale-110 transition-transform">
                <span class="material-symbols-outlined text-slate-200" style="font-size:1.2rem;">arrow_back</span>
            </a>
            <h2 class="text-sm font-bold text-slate-100 flex-1 text-center px-4 truncate">{{ $product->name }}</h2>
            <form action="{{ route('user.favorites.toggle', $product) }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800/80 backdrop-blur-md border border-slate-700/50 shadow-sm hover:scale-110 transition-transform">
                    <span
                        class="material-symbols-outlined text-lg
                             {{ $product->isFavoritedBy(Auth::id()) ? 'text-rose-500' : 'text-slate-400' }}"
                        @if ($product->isFavoritedBy(Auth::id())) style="font-variation-settings:'FILL' 1" @endif>
                        favorite
                    </span>
                </button>
            </form>
        </div>

        {{-- Product Image Gallery --}}
        <div class="mx-4 md:mx-auto md:max-w-4xl relative">
            {{-- Main Active Image --}}
            <div class="aspect-video w-full rounded-3xl p-2 bg-slate-800 border border-slate-700/50 flex items-center justify-center shadow-lg shadow-black/10 overflow-hidden relative">
                @if ($product->image)
                    <img id="main-image" src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover rounded-2xl transition-all duration-300">
                @else
                    {{-- <span class="material-symbols-outlined text-slate-600 w-full text-center" style="font-size: 3rem;">directions_bike</span> --}}
                    <img id="main-image" src="{{ asset('storage/Sepeda1.jpg') }}" class="w-full h-full object-cover rounded-2xl transition-all duration-300">
                @endif

                @if ($product->stock <= 5 && $product->stock > 0)
                    <span class="absolute top-4 left-4 bg-rose-500/90 backdrop-blur-md text-white px-3 py-1 rounded-lg text-xs font-bold shadow-[0_0_15px_rgba(244,63,94,0.6)] z-10">Low Stock</span>
                @endif
            </div>

            {{-- Thumbnails --}}
            <div class="flex gap-2 mt-3 overflow-x-auto no-scrollbar pb-2 px-1">
                {{-- Primary cover thumbnail --}}
                @if ($product->image)
                    <button type="button" class="thumbnail-btn w-16 h-16 shrink-0 rounded-xl bg-slate-800 border-2 border-blue-500 overflow-hidden cursor-pointer hover:border-blue-400 transition-colors shadow-md"
                        data-src="{{ asset('storage/' . $product->image) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover opacity-100 transition-opacity">
                    </button>
                @endif
                {{-- Extra gallery thumbnails --}}
                @foreach($product->images as $img)
                    <button type="button" class="thumbnail-btn w-16 h-16 shrink-0 rounded-xl bg-slate-800 border-2 border-slate-700/50 overflow-hidden cursor-pointer hover:border-blue-400 transition-colors shadow-md"
                        data-src="{{ asset('storage/' . $img->image_path) }}">
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover opacity-60 hover:opacity-100 transition-opacity">
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Product Info --}}
        <div class="px-4 mt-5 space-y-4">

            {{-- Badges --}}
            <div class="flex items-center gap-2 flex-wrap">
                <span
                    class="px-3 py-1 rounded-lg text-xs font-bold ring-1 ring-inset
                         {{ $product->categories === 'unit' ? 'bg-blue-500/10 text-blue-400 ring-blue-500/30' : 'bg-purple-500/10 text-purple-400 ring-purple-500/30' }}">
                    {{ $product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                </span>
                <span
                    class="px-3 py-1 rounded-lg text-xs font-bold ring-1 ring-inset
                         {{ $product->status === 'available' ? 'bg-emerald-500/10 text-emerald-400 ring-emerald-500/30' : 'bg-rose-500/10 text-rose-400 ring-rose-500/30' }}">
                    {{ $product->status === 'available' ? 'Available' : 'Unavailable' }}
                </span>
                @if ($product->stock <= 5 && $product->stock > 0)
                    <span class="px-3 py-1 rounded-lg text-xs font-bold bg-amber-500/10 text-amber-400 ring-1 ring-inset ring-amber-500/30">Hurry, only {{ $product->stock }} left!</span>
                @endif
            </div>

            {{-- Name + Price --}}
            <div>
                <h1 class="text-2xl font-bold text-slate-50 leading-tight drop-shadow-md">{{ $product->name }}</h1>
                <p class="text-3xl font-extrabold text-blue-500 mt-2 tracking-tight">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-3">
                <div class="flex flex-col items-center justify-center bg-slate-800 rounded-2xl p-4 border border-slate-700/50 hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-blue-500 mb-1" style="font-size:1.4rem;">inventory_2</span>
                    <p class="text-lg font-bold text-slate-100">{{ $product->stock }}</p>
                    <p class="text-[10px] text-slate-400 font-medium tracking-wide uppercase">In Stock</p>
                </div>
                <div class="flex flex-col items-center justify-center bg-slate-800 rounded-2xl p-4 border border-slate-700/50 hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-emerald-500 mb-1"
                        style="font-size:1.4rem;">shopping_bag</span>
                    <p class="text-lg font-bold text-slate-100">{{ $totalSold }}</p>
                    <p class="text-[10px] text-slate-400 font-medium tracking-wide uppercase">Sold</p>
                </div>
                <div class="flex flex-col items-center justify-center bg-slate-800 rounded-2xl p-4 border border-slate-700/50 hover:bg-slate-700 transition-colors">
                    <span class="material-symbols-outlined text-rose-500 mb-1" style="font-size:1.4rem;">favorite</span>
                    <p class="text-lg font-bold text-slate-100">{{ $totalFavorites }}</p>
                    <p class="text-[10px] text-slate-400 font-medium tracking-wide uppercase">Favorites</p>
                </div>
            </div>

            {{-- Note: Inline Checkout Box replaces the sticky footer --}}
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl border border-slate-700 p-5 shadow-[0_0_30px_rgba(0,0,0,0.3)] relative overflow-hidden my-6">
                <!-- Background Decoration -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
                
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Action</h3>
                
                <div class="flex flex-col gap-3 relative z-10">
                    @if ($product->stock > 0 && $product->status === 'available')
                        <div class="flex items-center gap-3 w-full">
                            <form action="{{ route('user.cart.add', $product) }}" method="POST" class="shrink-0">
                                @csrf
                                <button type="submit" title="Add to Cart"
                                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-900 border border-slate-700 text-blue-400 hover:border-blue-500 hover:bg-slate-800 transition-colors shadow-lg group">
                                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform" style="font-size:1.5rem;">add_shopping_cart</span>
                                </button>
                            </form>
                            <a href="{{ route('user.orders.create', $product) }}"
                                class="flex-1 flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold h-14 px-8 rounded-2xl transition-all duration-300 shadow-[0_0_20px_rgba(59,130,246,0.4)] hover:shadow-[0_0_25px_rgba(59,130,246,0.6)] hover:-translate-y-0.5">
                                <span class="material-symbols-outlined" style="font-size:1.3rem;">shopping_bag</span>
                                Order Now
                            </a>
                        </div>
                    @else
                        <button disabled
                            class="w-full flex items-center justify-center gap-2 bg-slate-900 border border-slate-800 text-slate-600 font-bold h-14 rounded-2xl cursor-not-allowed">
                            <span class="material-symbols-outlined" style="font-size:1.3rem;">block</span>
                            Out of Stock
                        </button>
                    @endif
                </div>
            </div>

            {{-- Description --}}
            <div class="bg-slate-800 rounded-2xl border border-slate-700/50 p-5 shadow-lg shadow-black/10">
                <h3 class="text-sm font-bold text-slate-100 mb-3">Description</h3>
                <p class="text-sm text-slate-300 leading-relaxed">
                    {{ $product->description ?? 'No description available for this product.' }}
                </p>
            </div>

            {{-- Product Details --}}
            <div class="bg-slate-800 rounded-2xl border border-slate-700/50 p-5 shadow-lg shadow-black/10">
                <h3 class="text-sm font-bold text-slate-100 mb-4">Product Details</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 text-sm">
                        <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-blue-500" style="font-size:1.1rem;">category</span>
                        </div>
                        <span class="text-slate-400 flex-1">Category</span>
                        <span class="font-semibold text-slate-100">{{ $product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}</span>
                    </div>
                    <div class="h-px bg-slate-700/50"></div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-emerald-500" style="font-size:1.1rem;">check_circle</span>
                        </div>
                        <span class="text-slate-400 flex-1">Status</span>
                        <span class="font-semibold {{ $product->status === 'available' ? 'text-emerald-400' : 'text-rose-500' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </div>
                    <div class="h-px bg-slate-700/50"></div>
                    <div class="flex items-center gap-4 text-sm">
                         <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center shrink-0">
                             <span class="material-symbols-outlined text-amber-500" style="font-size:1.1rem;">inventory_2</span>
                         </div>
                        <span class="text-slate-400 flex-1">Stock</span>
                        <span class="font-semibold {{ $product->stock <= 5 ? 'text-amber-400' : 'text-slate-100' }}">{{ $product->stock }}
                            units</span>
                    </div>
                    <div class="h-px bg-slate-700/50"></div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-blue-500" style="font-size:1.1rem;">payments</span>
                        </div>
                        <span class="text-slate-400 flex-1">Price</span>
                        <span class="font-bold text-blue-400">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            @if ($relatedProducts->isNotEmpty())
                <div class="pt-4 pb-24">
                    <h3 class="text-lg font-bold text-slate-100 mb-4 drop-shadow-md">You May Also Like</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 md:gap-4 pb-6">
                        @foreach ($relatedProducts as $related)
                            <div class="rounded-2xl bg-slate-800 border border-slate-700 p-3 shadow-lg shadow-black/20 hover:border-blue-500/50 hover:shadow-[0_0_20px_rgba(59,130,246,0.15)] hover:-translate-y-1 transition-all duration-300 group flex flex-col">

                                {{-- Image --}}
                                <div class="relative aspect-square w-full overflow-hidden rounded-xl bg-slate-700/50 flex items-center justify-center shrink-0">
                                     @if ($related->image)
                                          <img src="{{ asset('storage/' . $related->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                     @else
                                          <img src="{{ asset('storage/Sepeda1.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                     @endif

                                     @if ($related->stock <= 5 && $related->stock > 0)
                                         <span class="absolute top-2 left-2 bg-rose-500/80 backdrop-blur-sm text-white px-2 py-0.5 rounded text-[10px] font-bold shadow-[0_0_10px_rgba(244,63,94,0.5)] z-10">Low Stock</span>
                                     @endif

                                    <form action="{{ route('user.favorites.toggle', $related) }}" method="POST"
                                        class="absolute top-2 right-2 z-10">
                                        @csrf
                                        <button type="submit"
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900/60 backdrop-blur-md shadow-sm hover:scale-110 transition-transform">
                                            <span
                                                class="material-symbols-outlined text-lg
                                                     {{ $related->isFavoritedBy(Auth::id()) ? 'text-rose-500' : 'text-slate-300' }}"
                                                @if ($related->isFavoritedBy(Auth::id())) style="font-variation-settings:'FILL' 1" @endif>
                                                favorite
                                            </span>
                                        </button>
                                    </form>
                                </div>

                                {{-- Info --}}
                                <a href="{{ route('user.products.show', $related) }}" class="flex flex-1 flex-col mt-3 text-left">
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-blue-400">
                                        {{ $related->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                                    </p>
                                    <h4 class="mt-1 font-bold text-slate-100 text-sm leading-tight line-clamp-2">
                                        {{ $related->name }}
                                    </h4>
                                    <div class="mt-auto pt-3 flex items-center justify-between">
                                        <span class="text-[15px] font-extrabold text-blue-50 tracking-tight">
                                            Rp {{ number_format($related->price, 0, ',', '.') }}
                                        </span>
                                        @if ($related->stock > 0 && $related->status === 'available')
                                            <form action="{{ route('user.cart.add', $related) }}" method="POST" onclick="event.stopPropagation();">
                                                @csrf
                                                <button type="submit" title="Add to Cart"
                                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-700 text-blue-400 hover:bg-blue-600 hover:text-white transition-colors shadow-inner shadow-slate-600/50">
                                                    <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[10px] font-bold px-2 py-1 bg-rose-500/10 text-rose-400 rounded">Sold</span>
                                        @endif
                                    </div>
                                </a>

                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="pb-24"></div>
            @endif

        </div>

    </div>

    {{-- Gallery Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mainImage = document.getElementById('main-image');
            const thumbnails = document.querySelectorAll('.thumbnail-btn');

            if (!mainImage) return;

            thumbnails.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update main image src
                    mainImage.src = this.dataset.src;
                    
                    // Reset styling on all thumbs
                    thumbnails.forEach(t => {
                        t.classList.remove('border-blue-500');
                        t.classList.add('border-slate-700/50');
                        t.querySelector('img').classList.remove('opacity-100');
                        t.querySelector('img').classList.add('opacity-60');
                    });
                    
                    // Apply active style to clicked thumb
                    this.classList.remove('border-slate-700/50');
                    this.classList.add('border-blue-500');
                    this.querySelector('img').classList.remove('opacity-60');
                    this.querySelector('img').classList.add('opacity-100');
                });
            });
        });
    </script>

@endsection
