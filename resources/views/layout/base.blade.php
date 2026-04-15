<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
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
<body class="@yield('body_class', 'bg-slate-900 text-slate-200 flex flex-col min-h-screen')">
    <div class="flex-grow flex flex-col">
        @yield('content')
    </div>

    {{-- Footer (Hidden on Auth pages) --}}
    @if(!request()->routeIs('login') && !request()->routeIs('register') && !request()->routeIs('login.post') && !request()->routeIs('register.post'))
    <footer class="bg-slate-900/80 backdrop-blur-md border-t border-slate-800 py-10 mt-auto z-10 relative">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <div class="col-span-1 sm:col-span-2 md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-blue-500/30">
                        B
                    </div>
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">BoNoJiten</span>
                </div>
                <p class="text-sm text-slate-400 max-w-sm leading-relaxed">
                    Premium bicycle components and equipment. We provide authentic, high-quality gear to elevate your riding experience effortlessly.
                </p>
            </div>
            <div>
                <h4 class="text-slate-200 font-semibold mb-4">Explore</h4>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors">Shop Parts</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors">Categories</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-blue-400 transition-colors">Our Story</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-slate-200 font-semibold mb-4">Support</h4>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Help Center</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 pt-8 mt-8 border-t border-slate-800/50 text-sm text-slate-500 flex flex-col md:flex-row items-center justify-between">
            <p>&copy; {{ date('Y') }} BoNoJiten. All rights reserved.</p>
            <div class="flex items-center gap-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-slate-300 transition-colors">Twitter</a>
                <a href="#" class="hover:text-slate-300 transition-colors">Instagram</a>
                <a href="#" class="hover:text-slate-300 transition-colors">Facebook</a>
            </div>
        </div>
    </footer>
    @endif
</body>
</html>
