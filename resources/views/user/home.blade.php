@extends('layout.user')
@section('title', 'Home')
@section('content')


    {{-- Hero Banner --}}
    <section class="px-4 py-4">
        <header
            class="sticky top-0 z-50 flex items-center bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md p-4 justify-between border-b border-slate-200 dark:border-primary/20">
            <div
                class="flex size-10 shrink-0 items-center justify-center rounded-full bg-slate-100 dark:bg-primary/10 text-slate-900 dark:text-primary dark:bg-slate-800 dark:text-slate-300">
                <span class="material-symbols-outlined">menu</span>
            </div>
            <h1 class="text-xl font-bold leading-tight tracking-tight flex-1 text-center text-slate-900 dark:text-slate-100">
                VELO<span class="text-primary">CITI</span>
            </h1>
            <div class="flex size-10 items-center justify-end">
                <button class="relative flex items-center justify-center text-slate-900 dark:text-slate-100">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span
                        class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-background-dark">3</span>
                </button>
            </div>
        </header>
        <div class="relative aspect-[16/9] w-full overflow-hidden rounded-2xl bg-gray-200">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: linear-gradient(to right, rgba(15,23,42,0.92) 0%, rgba(15,23,42,0.2) 65%), url({{ asset('storage/mail.jpeg') }});">
            </div>
            <div class="relative flex h-full flex-col justify-center p-6">
                <span
                    class="mb-2 inline-block w-fit rounded bg-blue-600 px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-white">
                    New Arrival
                </span>
                <h2 class="max-w-[260px] text-3xl font-extrabold leading-tight text-white">
                    RIDE THE <span class="text-blue-400">PEAK</span>
                </h2>
                <p class="mt-2 max-w-[220px] text-sm text-slate-300">
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
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-colors
                  {{ !request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-700 border border-gray-200' }}">
                <span class="material-symbols-outlined text-lg leading-none">apps</span>
                All
            </a>
            <a href="{{ route('user.home', ['category' => 'unit']) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-colors
                  {{ request('category') === 'unit' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-700 border border-gray-200' }}">
                <span class="material-symbols-outlined text-lg leading-none">pedal_bike</span>
                Full Bikes
            </a>
            <a href="{{ route('user.home', ['category' => 'spharepart']) }}"
                class="flex h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-5 text-sm font-bold transition-colors
                  {{ request('category') === 'spharepart' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-700 border border-gray-200' }}">
                <span class="material-symbols-outlined text-lg leading-none">settings</span>
                Spare Parts
            </a>
        </div>
    </section>

    {{-- Products --}}
    <section class="mt-8 px-4" id="products">

        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold tracking-tight text-gray-900">
                {{ request('category') === 'unit' ? 'Full Bikes' : (request('category') === 'spharepart' ? 'Spare Parts' : 'Trending Now') }}
            </h3>
            <span class="text-xs text-gray-400 font-medium">{{ $products->count() }} items</span>
        </div>

        @if ($products->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                <span class="material-symbols-outlined text-5xl mb-3">directions_bike</span>
                <p class="font-medium">No products available</p>
            </div>
        @else
            <div class="no-scrollbar flex gap-4 overflow-x-auto pb-2">
                @foreach ($products as $product)
                    <div class="min-w-[200px] flex-none rounded-2xl bg-white border border-gray-100 p-3 shadow-sm">

                        {{-- Image --}}
                        <div
                            class="relative aspect-square w-full overflow-hidden rounded-xl bg-gray-100 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                    class="w-52 h-full object-cover">
                            @else
                                <img src="{{ asset('storage/mail.jpeg') }}" class="w-full h-full object-cover">
                            @endif

                            {{-- badges tetap di sini --}}
                            @if ($product->stock <= 5 && $product->stock > 0)
                                <span class="absolute top-2 left-2 hover:text-red-600 transition-all cursor-default">Low
                                    Stock</span>
                            @endif

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
                        <a href="{{ route('user.products.show', $product) }}">
                            <div class="mt-3">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-blue-600">
                                    {{ $product->categories === 'unit' ? 'Full Bike' : 'Spare Part' }}
                                </p>
                                <h4 class="mt-1 font-bold text-gray-900 text-sm leading-tight truncate">
                                    {{ $product->name }}
                                </h4>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-base font-bold text-gray-900">
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
                        </a>

                    </div>
                @endforeach
            </div>
        @endif

    </section>

    {{-- Workshop Banner --}}
    <section class="mt-8 px-4 pb-4">
        <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-blue-600 text-white">
                    <span class="material-symbols-outlined">build</span>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900">Pro Workshop</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Expert tuning and assembly for your ride.</p>
                </div>
            </div>
        </div>
    </section>

@endsection
