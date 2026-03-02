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
<body class="bg-gray-100 min-h-screen">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col fixed top-0 left-0 h-full z-30 shadow-sm">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <span class="material-symbols-outlined text-white" style="font-size:1.1rem;">pedal_bike</span>
            </div>
            <span class="text-lg font-bold text-gray-800 tracking-tight">Bonojiten</span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.dashboard')
                          ? 'bg-blue-50 text-blue-600 nav-active'
                          : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <span class="material-symbols-outlined" style="font-size:1.25rem;">dashboard</span>
                Dashboard
            </a>

            {{-- Products --}}
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.products*')
                          ? 'bg-blue-50 text-blue-600 nav-active'
                          : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <span class="material-symbols-outlined" style="font-size:1.25rem;">directions_bike</span>
                Products
            </a>

            {{-- Orders --}}
            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.orders*')
                          ? 'bg-blue-50 text-blue-600 nav-active'
                          : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <span class="material-symbols-outlined" style="font-size:1.25rem;">shopping_cart</span>
                Orders
            </a>

            {{-- Accounts --}}
            <a href="{{ route('admin.accounts.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.accounts*')
                          ? 'bg-blue-50 text-blue-600 nav-active'
                          : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <span class="material-symbols-outlined" style="font-size:1.25rem;">group</span>
                Accounts
            </a>

        </nav>

        {{-- User Info + Logout --}}
        <div class="px-3 py-4 border-t border-gray-100">

            {{-- Logged in user --}}
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                    <span class="text-blue-600 text-xs font-bold uppercase">
                        {{ substr(Auth::user()->username ?? 'A', 0, 1) }}
                    </span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->username ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email ?? '' }}</p>
                </div>
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-red-500 hover:bg-red-50 transition-colors">
                    <span class="material-symbols-outlined" style="font-size:1.25rem;">logout</span>
                    Logout
                </button>
            </form>

        </div>

    </aside>

    {{-- Main Content --}}
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        {{-- Top Bar --}}
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-20">
            <h1 class="text-lg font-semibold text-gray-800">@yield('page_title', 'Dashboard')</h1>
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <span class="material-symbols-outlined" style="font-size:1.1rem;">calendar_today</span>
                {{ now()->format('d M Y') }}
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-6 pt-4">
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined" style="font-size:1rem;">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined" style="font-size:1rem;">error</span>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

</div>

@stack('scripts')
</body>
</html>