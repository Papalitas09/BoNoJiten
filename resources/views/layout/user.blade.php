<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Admin') — Bonojiten</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .nav-active .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-200 min-h-screen selection:bg-blue-500 selection:text-white">
    <main class="flex-1 pb-24">
        @yield('content')
    </main>
    {{-- Bottom Navigation --}}
    <nav
        class="fixed bottom-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-sm rounded-[2rem] bg-slate-800/80 backdrop-blur-xl border border-slate-700/50 px-2 pb-2 pt-2 shadow-2xl shadow-blue-900/10">
        <div class="mx-auto flex w-full items-center justify-between">

            {{-- Home --}}
            <a href="{{ route('user.home') }}" class="flex flex-1 flex-col items-center justify-center gap-1 group">
                <div
                    class="relative flex h-10 w-12 items-center justify-center rounded-2xl transition-all duration-300
                        {{ request()->routeIs('user.home') ? 'bg-blue-500/20 text-blue-400 scale-110' : 'text-slate-400 group-hover:scale-110 group-hover:text-slate-300' }}">
                    <span class="material-symbols-outlined text-[26px]"
                        @if (request()->routeIs('user.home')) style="font-variation-settings:'FILL' 1" @endif>
                        home
                    </span>
                    @if (request()->routeIs('user.home'))
                        <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.8)]"></div>
                    @endif
                </div>
                <span
                    class="text-[10px] font-medium tracking-wide transition-colors {{ request()->routeIs('user.home') ? 'text-blue-400' : 'text-slate-500' }}">
                    Home
                </span>
            </a>

            {{-- Explore --}}
            <a href="{{ route('user.explore.index') }}"
                class="flex flex-1 flex-col items-center justify-center gap-1 group">
                <div
                    class="relative flex h-10 w-12 items-center justify-center rounded-2xl transition-all duration-300
                {{ request()->routeIs('user.explore*') ? 'bg-blue-500/20 text-blue-400 scale-110' : 'text-slate-400 group-hover:scale-110 group-hover:text-slate-300' }}">
                    <span class="material-symbols-outlined text-[26px]"
                        @if (request()->routeIs('user.explore*')) style="font-variation-settings:'FILL' 1" @endif>
                        explore
                    </span>
                    @if (request()->routeIs('user.explore*'))
                        <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.8)]"></div>
                    @endif
                </div>
                <span
                    class="text-[10px] font-medium tracking-wide transition-colors {{ request()->routeIs('user.explore*') ? 'text-blue-400' : 'text-slate-500' }}">
                    Explore
                </span>
            </a>

            {{-- Orders --}}
            <a href="{{ route('user.orders.index') }}"
                class="flex flex-1 flex-col items-center justify-center gap-1 group">
                <div
                    class="relative flex h-10 w-12 items-center justify-center rounded-2xl transition-all duration-300
                        {{ request()->routeIs('user.orders*') ? 'bg-blue-500/20 text-blue-400 scale-110' : 'text-slate-400 group-hover:scale-110 group-hover:text-slate-300' }}">
                    <span class="material-symbols-outlined text-[26px]"
                        @if (request()->routeIs('user.orders*')) style="font-variation-settings:'FILL' 1" @endif>
                        receipt_long
                    </span>
                    @if (request()->routeIs('user.orders*'))
                        <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.8)]"></div>
                    @endif
                </div>
                <span
                    class="text-[10px] font-medium tracking-wide transition-colors {{ request()->routeIs('user.orders*') ? 'text-blue-400' : 'text-slate-500' }}">
                    Orders
                </span>
            </a>

            {{-- Profile --}}
            <a href="{{ route('user.profile') }}" class="flex flex-1 flex-col items-center justify-center gap-1 group">
                <div
                    class="relative flex h-10 w-12 items-center justify-center rounded-2xl transition-all duration-300
                        {{ request()->routeIs('user.profile') ? 'bg-blue-500/20 text-blue-400 scale-110' : 'text-slate-400 group-hover:scale-110 group-hover:text-slate-300' }}">
                    <span class="material-symbols-outlined text-[26px]"
                        @if (request()->routeIs('user.profile')) style="font-variation-settings:'FILL' 1" @endif>
                        person
                    </span>
                    @if (request()->routeIs('user.profile'))
                        <div class="absolute -bottom-1 h-1 w-4 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.8)]"></div>
                    @endif
                </div>
                <span
                    class="text-[10px] font-medium tracking-wide transition-colors {{ request()->routeIs('user.profile') ? 'text-blue-400' : 'text-slate-500' }}">
                    Profile
                </span>
            </a>

        </div>
    </nav>
</body>

</html>
