@extends('layout.user')
@section('title', 'Profile')
@section('content')
    <div class="relative flex min-h-screen w-full flex-col max-w-md mx-auto shadow-xl bg-gray-50">

        {{-- Header --}}
        <header
            class="flex items-center p-4 justify-between sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-200">
            <a href="{{ route('user.home') }}"
                class="flex size-10 items-center justify-center rounded-full hover:bg-blue-50 transition-colors">
                <span class="material-symbols-outlined text-gray-700">arrow_back</span>
            </a>
            <h2 class="text-lg font-bold flex-1 text-center text-gray-800">Profile</h2>
            <div class="size-10"></div>
        </header>

        <main class="flex-1 overflow-y-auto pb-28 no-scrollbar">

            {{-- Avatar + Info --}}
            <section class="flex flex-col items-center px-6 py-8 bg-white border-b border-gray-100">
                {{-- Avatar initial --}}
                <div
                    class="flex h-28 w-28 items-center justify-center rounded-full bg-blue-600 border-4 border-blue-100 shadow-lg shadow-blue-100">
                    <span class="text-4xl font-bold text-white">
                        {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
                    </span>
                </div>

                <div class="mt-4 text-center">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{ Auth::user()->username }}</h1>
                    <p class="text-blue-600 font-medium text-sm mt-1">{{ Auth::user()->email }}</p>
                    <span
                        class="mt-2 inline-block px-3 py-1 rounded-full text-xs font-bold
                    {{ Auth::user()->role === 'admin' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-blue-50 text-blue-600 border border-blue-100' }}">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
            </section>

            <div class="px-4 py-5 space-y-5">

                {{-- Account Info --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 px-1 mb-3">
                        Account Info
                    </h3>
                    <div
                        class="bg-white rounded-xl overflow-hidden divide-y divide-gray-100 border border-gray-200 shadow-sm">

                        <div class="flex items-center gap-4 px-4 py-4">
                            <div
                                class="flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 shrink-0 size-10">
                                <span class="material-symbols-outlined" style="font-size:1.2rem;">person</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-400">Username</p>
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->username }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 px-4 py-4">
                            <div
                                class="flex items-center justify-center rounded-lg bg-green-50 text-green-600 shrink-0 size-10">
                                <span class="material-symbols-outlined" style="font-size:1.2rem;">mail</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-400">Email</p>
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 px-4 py-4">
                            <div
                                class="flex items-center justify-center rounded-lg bg-purple-50 text-purple-600 shrink-0 size-10">
                                <span class="material-symbols-outlined" style="font-size:1.2rem;">shield</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-400">Role</p>
                                <p class="text-sm font-semibold text-gray-800">{{ ucfirst(Auth::user()->role) }}</p>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Shopping Activity --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 px-1 mb-3">
                        Shopping Activity
                    </h3>
                    <div
                        class="bg-white rounded-xl overflow-hidden divide-y divide-gray-100 border border-gray-200 shadow-sm">
                        <a href="{{ route('user.favorites.index') }}"
                            class="flex items-center gap-4 px-4 py-4 hover:bg-blue-50 transition-colors">
                            <div
                                class="flex items-center justify-center rounded-lg bg-red-50 text-red-500 shrink-0 size-10">
                                <span class="material-symbols-outlined" style="font-size:1.2rem;">favorite</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-800">Favorite Products</p>
                                <p class="text-xs text-gray-400">
                                    {{ Auth::user()->favorites()->count() }} items saved
                                </p>
                            </div>
                            <span class="material-symbols-outlined text-gray-300"
                                style="font-size:1.1rem;">chevron_right</span>
                        </a>
                        <a href="{{ route('user.orders.index') }}"
                            class="flex items-center gap-4 px-4 py-4 hover:bg-blue-50 transition-colors">
                            <div
                                class="flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 shrink-0 size-10">
                                <span class="material-symbols-outlined" style="font-size:1.2rem;">shopping_bag</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-800">My Orders</p>
                                <p class="text-xs text-gray-400">View your order history</p>
                            </div>
                            <span class="material-symbols-outlined text-gray-300"
                                style="font-size:1.1rem;">chevron_right</span>
                        </a>

                        <a href="{{ route('user.explore.index') }}"
                            class="flex items-center gap-4 px-4 py-4 hover:bg-blue-50 transition-colors">
                            <div
                                class="flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 shrink-0 size-10">
                                <span class="material-symbols-outlined" style="font-size:1.2rem;">explore</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-800">Explore Products</p>
                                <p class="text-xs text-gray-400">Browse bikes & spare parts</p>
                            </div>
                            <span class="material-symbols-outlined text-gray-300"
                                style="font-size:1.1rem;">chevron_right</span>
                        </a>

                    </div>
                </div>

                {{-- Logout --}}
                <div class="pt-2 pb-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-500 font-bold py-4 rounded-xl hover:bg-red-100 transition-colors border border-red-100">
                            <span class="material-symbols-outlined" style="font-size:1.2rem;">logout</span>
                            Log Out
                        </button>
                    </form>
                </div>

            </div>

        </main>

        {{-- Bottom Nav --}}
        <nav
            class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md border-t border-gray-200 bg-white/95 backdrop-blur-lg px-4 pb-6 pt-2 z-50">
            <div class="mx-auto flex max-w-lg items-center justify-between">

                <a href="{{ route('user.home') }}"
                    class="flex flex-1 flex-col items-center justify-center gap-1 {{ request()->routeIs('user.home') ? 'text-blue-600' : 'text-gray-400' }}">
                    <div
                        class="relative flex h-10 w-12 items-center justify-center rounded-xl {{ request()->routeIs('user.home') ? 'bg-blue-100' : '' }}">
                        <span
                            class="material-symbols-outlined text-[26px] {{ request()->routeIs('user.home') ? 'icon-fill' : '' }}">home</span>
                        @if (request()->routeIs('user.home'))
                            <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-600"></div>
                        @endif
                    </div>
                    <span class="text-[11px] font-{{ request()->routeIs('user.home') ? 'bold' : 'medium' }}">Home</span>
                </a>

                <a href="{{ route('user.explore.index') }}"
                    class="flex flex-1 flex-col items-center justify-center gap-1 {{ request()->routeIs('user.explore*') ? 'text-blue-600' : 'text-gray-400' }}">
                    <div
                        class="relative flex h-10 w-12 items-center justify-center rounded-xl {{ request()->routeIs('user.explore*') ? 'bg-blue-100' : '' }}">
                        <span
                            class="material-symbols-outlined text-[26px] {{ request()->routeIs('user.explore*') ? 'icon-fill' : '' }}">explore</span>
                        @if (request()->routeIs('user.explore*'))
                            <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-600"></div>
                        @endif
                    </div>
                    <span
                        class="text-[11px] font-{{ request()->routeIs('user.explore*') ? 'bold' : 'medium' }}">Explore</span>
                </a>

                <a href="{{ route('user.orders.index') }}"
                    class="flex flex-1 flex-col items-center justify-center gap-1 {{ request()->routeIs('user.orders*') ? 'text-blue-600' : 'text-gray-400' }}">
                    <div
                        class="relative flex h-10 w-12 items-center justify-center rounded-xl {{ request()->routeIs('user.orders*') ? 'bg-blue-100' : '' }}">
                        <span
                            class="material-symbols-outlined text-[26px] {{ request()->routeIs('user.orders*') ? 'icon-fill' : '' }}">receipt_long</span>
                        @if (request()->routeIs('user.orders*'))
                            <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-600"></div>
                        @endif
                    </div>
                    <span
                        class="text-[11px] font-{{ request()->routeIs('user.orders*') ? 'bold' : 'medium' }}">Orders</span>
                </a>

                <a href="{{ route('user.profile') }}"
                    class="flex flex-1 flex-col items-center justify-center gap-1 {{ request()->routeIs('user.profile*') ? 'text-blue-600' : 'text-gray-400' }}">
                    <div
                        class="relative flex h-10 w-12 items-center justify-center rounded-xl {{ request()->routeIs('user.profile*') ? 'bg-blue-100' : '' }}">
                        <span
                            class="material-symbols-outlined text-[26px] {{ request()->routeIs('user.profile*') ? 'icon-fill' : '' }}">person</span>
                        @if (request()->routeIs('user.profile*'))
                            <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-600"></div>
                        @endif
                    </div>
                    <span
                        class="text-[11px] font-{{ request()->routeIs('user.profile*') ? 'bold' : 'medium' }}">Profile</span>
                </a>

            </div>
        </nav>

    </div>
@endsection
