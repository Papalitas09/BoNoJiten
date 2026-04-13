@extends('layout.user')
@section('title', 'Profile')
@section('content')

    {{-- Sticky Header --}}
    <header class="sticky top-0 z-10 bg-slate-900/80 backdrop-blur-xl border-b border-slate-800 px-4 py-4">
        <div class="flex items-center justify-between max-w-2xl mx-auto">
            <a href="{{ route('user.home') }}"
                class="flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-800 border border-slate-700/50 text-slate-200 hover:bg-slate-700 transition-all">
                <span class="material-symbols-outlined" style="font-size:1.2rem;">arrow_back</span>
            </a>
            <h1 class="text-xl font-bold text-slate-100 tracking-tight">My Profile</h1>
            <div class="w-10"></div>
        </div>
    </header>

    <div class="max-w-2xl mx-auto px-4 py-6 pb-32 space-y-4">

        {{-- Hero Card (Avatar + Identity) --}}
        <div class="relative overflow-hidden bg-slate-800 rounded-3xl border border-slate-700/50 shadow-xl shadow-black/20 p-6">
            {{-- Background orbs --}}
            <div class="absolute top-0 right-0 w-48 h-48 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-4 -left-4 w-36 h-36 bg-purple-600/10 rounded-full blur-2xl pointer-events-none"></div>

            <div class="relative z-10 flex items-center gap-5">
                {{-- Avatar --}}
                <div class="flex-shrink-0 flex h-24 w-24 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600/30 to-blue-500/10 border border-blue-500/30 shadow-[0_0_25px_rgba(59,130,246,0.2)]">
                    <span class="text-4xl font-black text-blue-400">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </span>
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-extrabold text-slate-100 tracking-tight truncate">
                        {{ Auth::user()->username }}
                    </h2>
                    <p class="text-sm text-slate-400 mt-0.5 truncate">{{ Auth::user()->email }}</p>
                    <span class="mt-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider
                        {{ Auth::user()->role === 'admin'
                            ? 'bg-rose-500/20 text-rose-400 border border-rose-500/30'
                            : 'bg-blue-500/20 text-blue-400 border border-blue-500/30' }}">
                        <span class="material-symbols-outlined" style="font-size: 0.9rem; font-variation-settings: 'FILL' 1;">
                            {{ Auth::user()->role === 'admin' ? 'admin_panel_settings' : 'person' }}
                        </span>
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
            </div>

            {{-- Divider --}}
            <div class="relative z-10 mt-5 pt-5 border-t border-slate-700/50 grid grid-cols-2 gap-4">
                <div class="bg-slate-900/50 rounded-2xl p-4 border border-slate-700/50">
                    <p class="text-[10px] uppercase font-bold text-slate-500 tracking-widest">Saved Items</p>
                    <p class="text-2xl font-extrabold text-slate-100 mt-1">{{ Auth::user()->favorites()->count() }}</p>
                </div>
                <div class="bg-slate-900/50 rounded-2xl p-4 border border-slate-700/50">
                    <p class="text-[10px] uppercase font-bold text-slate-500 tracking-widest">Total Orders</p>
                    <p class="text-2xl font-extrabold text-slate-100 mt-1">{{ Auth::user()->orders()->count() ?? 0 }}</p>
                </div>
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="bg-slate-800 rounded-3xl border border-slate-700/50 shadow-lg shadow-black/20 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-700/50">
                <p class="text-[11px] font-bold uppercase tracking-widest text-slate-500">Quick Access</p>
            </div>
            <div class="divide-y divide-slate-700/50">

                <a href="{{ route('user.favorites.index') }}"
                    class="flex items-center gap-4 px-5 py-4 hover:bg-slate-700/40 transition-colors group">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined" style="font-size:1.3rem; font-variation-settings: 'FILL' 1;">favorite</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-200 group-hover:text-rose-400 transition-colors">My Favorites</p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ Auth::user()->favorites()->count() }} saved products</p>
                    </div>
                    <span class="material-symbols-outlined text-slate-600 group-hover:translate-x-1 group-hover:text-rose-400 transition-all">chevron_right</span>
                </a>

                <a href="{{ route('user.orders.index') }}"
                    class="flex items-center gap-4 px-5 py-4 hover:bg-slate-700/40 transition-colors group">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-blue-500/10 border border-blue-500/20 text-blue-400 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined" style="font-size:1.3rem;">shopping_bag</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-200 group-hover:text-blue-400 transition-colors">My Orders</p>
                        <p class="text-xs text-slate-500 mt-0.5">View order history & status</p>
                    </div>
                    <span class="material-symbols-outlined text-slate-600 group-hover:translate-x-1 group-hover:text-blue-400 transition-all">chevron_right</span>
                </a>

                <a href="{{ route('user.cart.index') }}"
                    class="flex items-center gap-4 px-5 py-4 hover:bg-slate-700/40 transition-colors group">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined" style="font-size:1.3rem;">shopping_cart</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-200 group-hover:text-emerald-400 transition-colors">My Cart</p>
                        <p class="text-xs text-slate-500 mt-0.5">Items ready for checkout</p>
                    </div>
                    <span class="material-symbols-outlined text-slate-600 group-hover:translate-x-1 group-hover:text-emerald-400 transition-all">chevron_right</span>
                </a>

                <a href="{{ route('user.explore.index') }}"
                    class="flex items-center gap-4 px-5 py-4 hover:bg-slate-700/40 transition-colors group">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-purple-500/10 border border-purple-500/20 text-purple-400 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined" style="font-size:1.3rem;">explore</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-slate-200 group-hover:text-purple-400 transition-colors">Explore</p>
                        <p class="text-xs text-slate-500 mt-0.5">Browse bikes, parts & equipment</p>
                    </div>
                    <span class="material-symbols-outlined text-slate-600 group-hover:translate-x-1 group-hover:text-purple-400 transition-all">chevron_right</span>
                </a>

            </div>
        </div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center gap-2 py-4 rounded-2xl font-bold text-sm
                       bg-rose-500/10 text-rose-400 border border-rose-500/20
                       hover:bg-rose-500 hover:text-white hover:border-rose-500
                       hover:shadow-[0_0_20px_rgba(239,68,68,0.4)]
                       transition-all duration-300 group">
                <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform" style="font-size:1.2rem;">logout</span>
                Sign Out
            </button>
        </form>

    </div>

@endsection
