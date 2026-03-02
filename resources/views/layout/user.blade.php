<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Admin') — Bonojiten</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .nav-active .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <main class="flex-1 pb-24">
        @yield('content')
    </main>
    {{-- Bottom Navigation --}}
    <nav
        class="fixed bottom-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-lg border-t border-slate-200 px-4 pb-6 pt-2">
        <div class="mx-auto flex max-w-lg items-center justify-between">

            {{-- Home --}}
            <a href="{{ route('user.home') }}" class="flex flex-1 flex-col items-center justify-center gap-1 group">
                <div
                    class="relative flex h-10 w-12 items-center justify-center rounded-xl transition-colors
                        {{ request()->routeIs('user.home') ? 'bg-blue-100 text-blue-600' : 'text-slate-400' }}">
                    <span class="material-symbols-outlined text-[26px]"
                        @if (request()->routeIs('user.home')) style="font-variation-settings:'FILL' 1" @endif>
                        home
                    </span>
                    @if (request()->routeIs('user.home'))
                        <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-600"></div>
                    @endif
                </div>
                <span
                    class="text-[11px] font-bold {{ request()->routeIs('user.home') ? 'text-blue-600' : 'text-slate-400' }}">
                    Home
                </span>
            </a>

            {{-- Explore --}}
            <a href="{{ route('user.explore.index') }}"
                class="flex flex-1 flex-col items-center justify-center gap-1 group">
                <div
                    class="relative flex h-10 w-12 items-center justify-center rounded-xl transition-colors
                {{ request()->routeIs('user.explore*') ? 'bg-blue-100 text-blue-600' : 'text-slate-400' }}">
                    <span class="material-symbols-outlined text-[26px]"
                        @if (request()->routeIs('user.explore*')) style="font-variation-settings:'FILL' 1" @endif>
                        explore
                    </span>
                    @if (request()->routeIs('user.explore*'))
                        <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-600"></div>
                    @endif
                </div>
                <span
                    class="text-[11px] font-bold {{ request()->routeIs('user.explore*') ? 'text-blue-600' : 'text-slate-400' }}">
                    Explore
                </span>
            </a>

            {{-- Orders --}}
            <a href="{{ route('user.orders.index') }}"
                class="flex flex-1 flex-col items-center justify-center gap-1 group">
                <div
                    class="relative flex h-10 w-12 items-center justify-center rounded-xl transition-colors
                        {{ request()->routeIs('user.orders*') ? 'bg-blue-100 text-blue-600' : 'text-slate-400' }}">
                    <span class="material-symbols-outlined text-[26px]"
                        @if (request()->routeIs('user.orders*')) style="font-variation-settings:'FILL' 1" @endif>
                        receipt_long
                    </span>
                    @if (request()->routeIs('user.orders*'))
                        <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-600"></div>
                    @endif
                </div>
                <span
                    class="text-[11px] font-bold {{ request()->routeIs('user.orders*') ? 'text-blue-600' : 'text-slate-400' }}">
                    Orders
                </span>
            </a>

            {{-- Profile --}}
            <a href="{{ route('user.profile') }}" class="flex flex-1 flex-col items-center justify-center gap-1 group">
                <div
                    class="relative flex h-10 w-12 items-center justify-center rounded-xl transition-colors
                        {{ request()->routeIs('user.profile') ? 'bg-blue-100 text-blue-600' : 'text-slate-400' }}">
                    <span class="material-symbols-outlined text-[26px]"
                        @if (request()->routeIs('user.profile')) style="font-variation-settings:'FILL' 1" @endif>
                        person
                    </span>
                    @if (request()->routeIs('user.profile'))
                        <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-600"></div>
                    @endif
                </div>
                <span
                    class="text-[11px] font-bold {{ request()->routeIs('user.profile') ? 'text-blue-600' : 'text-slate-400' }}">
                    Profile
                </span>
            </a>

        </div>
    </nav>
</body>

</html>
