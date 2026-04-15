<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin') — Bonojiten</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .nav-active .material-symbols-outlined { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-slate-900 min-h-screen">

<div class="flex min-h-screen">

    {{-- Mobile Overlay --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 z-20 bg-black/60 backdrop-blur-sm hidden lg:hidden"
         onclick="closeSidebar()">
    </div>

    {{-- Sidebar --}}
    <aside id="sidebar"
           class="fixed top-0 left-0 h-full w-64 bg-slate-800/95 backdrop-blur-md border-r border-slate-700/50 flex flex-col z-30 shadow-xl
                  -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">

        {{-- Logo --}}
        <div class="flex items-center justify-between px-6 py-5 border-b border-slate-700/50">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-600/20">
                    <span class="material-symbols-outlined text-white" style="font-size:1.1rem;">pedal_bike</span>
                </div>
                <span class="text-lg font-bold text-slate-100 tracking-tight">Bonojiten</span>
            </div>
            {{-- Close button (mobile only) --}}
            <button onclick="closeSidebar()" class="lg:hidden text-slate-400 hover:text-slate-200 transition-colors p-1 rounded-lg hover:bg-slate-700/50">
                <span class="material-symbols-outlined" style="font-size:1.25rem;">close</span>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-300
                      {{ request()->routeIs('admin.dashboard')
                          ? 'bg-blue-500/20 text-blue-400 nav-active shadow-inner shadow-blue-500/10'
                          : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200' }}"
               onclick="closeSidebar()">
                <span class="material-symbols-outlined" style="font-size:1.25rem;">dashboard</span>
                Dashboard
            </a>

            {{-- Products --}}
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-300
                      {{ request()->routeIs('admin.products*')
                          ? 'bg-blue-500/20 text-blue-400 nav-active shadow-inner shadow-blue-500/10'
                          : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200' }}"
               onclick="closeSidebar()">
                <span class="material-symbols-outlined" style="font-size:1.25rem;">directions_bike</span>
                Products
            </a>

            {{-- Orders --}}
            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-300
                      {{ request()->routeIs('admin.orders*')
                          ? 'bg-blue-500/20 text-blue-400 nav-active shadow-inner shadow-blue-500/10'
                          : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200' }}"
               onclick="closeSidebar()">
                <span class="material-symbols-outlined" style="font-size:1.25rem;">shopping_cart</span>
                Orders
            </a>

            {{-- Accounts --}}
            <a href="{{ route('admin.accounts.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-300
                      {{ request()->routeIs('admin.accounts*')
                          ? 'bg-blue-500/20 text-blue-400 nav-active shadow-inner shadow-blue-500/10'
                          : 'text-slate-400 hover:bg-slate-700/50 hover:text-slate-200' }}"
               onclick="closeSidebar()">
                <span class="material-symbols-outlined" style="font-size:1.25rem;">group</span>
                Accounts
            </a>

        </nav>

        {{-- User Info + Logout --}}
        <div class="px-3 py-4 border-t border-slate-700/50">

            {{-- Logged in user --}}
            <div class="flex items-center gap-3 px-3 py-2 mb-2 bg-slate-700/30 rounded-xl">
                <div class="w-8 h-8 rounded-full bg-blue-500/20 border border-blue-500/30 flex items-center justify-center shrink-0">
                    <span class="text-blue-400 text-xs font-bold uppercase">
                        {{ substr(Auth::user()->username ?? 'A', 0, 1) }}
                    </span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-slate-200 truncate">{{ Auth::user()->username ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email ?? '' }}</p>
                </div>
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition-colors">
                    <span class="material-symbols-outlined" style="font-size:1.25rem;">logout</span>
                    Logout
                </button>
            </form>

        </div>

    </aside>

    {{-- Main Content --}}
    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen min-w-0 overflow-x-hidden">

        {{-- Top Bar --}}
        <header class="bg-slate-800/80 backdrop-blur-md border-b border-slate-700/50 px-4 sm:px-6 py-4 flex items-center justify-between sticky top-0 z-20 shadow-sm gap-4">
            <div class="flex items-center gap-3">
                {{-- Hamburger (mobile only) --}}
                <button onclick="openSidebar()" class="lg:hidden text-slate-400 hover:text-slate-200 transition-colors p-1.5 rounded-lg hover:bg-slate-700/50" aria-label="Open menu">
                    <span class="material-symbols-outlined" style="font-size:1.4rem;">menu</span>
                </button>
                <h1 class="text-base sm:text-lg font-semibold text-slate-100 drop-shadow-md truncate">@yield('page_title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-2 text-sm text-slate-400 font-medium shrink-0">
                <span class="material-symbols-outlined hidden sm:inline" style="font-size:1.1rem;">calendar_today</span>
                <span class="hidden sm:inline">{{ now()->format('d M Y') }}</span>
                <span class="sm:hidden text-xs">{{ now()->format('d M Y') }}</span>
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-4 sm:px-6 pt-4">
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl text-sm flex items-center gap-2 shadow-lg shadow-emerald-500/5">
                    <span class="material-symbols-outlined shrink-0" style="font-size:1rem;">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 px-4 py-3 bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-xl text-sm flex items-center gap-2 shadow-lg shadow-rose-500/5">
                    <span class="material-symbols-outlined shrink-0" style="font-size:1rem;">error</span>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>

    </div>

</div>

<script>
    function openSidebar() {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.add('hidden');
        document.body.style.overflow = '';
    }
</script>

@stack('scripts')
</body>
</html>