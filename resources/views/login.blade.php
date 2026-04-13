@extends('layout.base')
@section('title', 'Login')
@section('body_class', 'bg-slate-900 text-slate-100')
@section('content')
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; min-height: max(884px, 100dvh); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
    <div class="relative flex min-h-screen w-full flex-col items-center justify-center overflow-x-hidden p-4">
        <!-- Background Decoration -->
        <div class="absolute top-10 left-10 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>

        {{-- Main Card --}}
        <div class="w-full max-w-sm bg-slate-800/90 backdrop-blur-xl rounded-3xl border border-slate-700/50 p-8 shadow-xl relative z-10">

            {{-- Logo --}}
            <div class="flex flex-col items-center mb-2">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-500/30">
                    <span class="material-symbols-outlined" style="font-size: 2rem;">pedal_bike</span>
                </div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-100">BoNo<span class="text-blue-500">Jiten</span></h2>
                <div class="mt-2 h-1 w-8 bg-blue-500 rounded-full"></div>
            </div>

            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold leading-tight text-slate-100">Welcome Back</h1>
                <p class="mt-2 text-slate-400">Login to your rider account</p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-5 px-4 py-3 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl text-sm font-medium">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div class="flex flex-col gap-2">
                    <label for="email" class="text-sm font-bold text-slate-300 ml-1">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"
                            style="font-size: 1.25rem;">mail</span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email"
                            placeholder="rider@velociti.com"
                            class="w-full bg-slate-900/50 rounded-xl border h-14 pl-12 pr-4 text-sm text-slate-100 outline-none transition-all placeholder:text-slate-500 shadow-inner
                               {{ $errors->has('email') ? 'border-rose-500 focus:ring-rose-500/50' : 'border-slate-700/50 focus:border-blue-500 focus:ring-1 focus:ring-blue-500' }}" />
                    </div>
                    @error('email')
                        <p class="text-xs text-rose-500 font-medium ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center ml-1">
                        <label for="password" class="text-sm font-bold text-slate-300">Password</label>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"
                            style="font-size: 1.25rem;">lock</span>
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full bg-slate-900/50 rounded-xl border h-14 pl-12 pr-12 text-sm text-slate-100 outline-none transition-all placeholder:text-slate-500 shadow-inner
                               {{ $errors->has('password') ? 'border-rose-500 focus:ring-rose-500/50' : 'border-slate-700/50 focus:border-blue-500 focus:ring-1 focus:ring-blue-500' }}" />
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition-colors">
                            <span class="material-symbols-outlined" id="eye-icon"
                                style="font-size: 1.25rem;">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-rose-500 font-medium ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-3 ml-1 mt-2">
                    <div class="relative flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-slate-600 bg-slate-900/50 checked:border-blue-500 checked:bg-blue-600 transition-all" />
                        <span class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100">
                            <span class="material-symbols-outlined" style="font-size: 14px; font-weight: bold;">check</span>
                        </span>
                    </div>
                    <label for="remember" class="text-sm font-medium text-slate-400 cursor-pointer">Keep me logged in</label>
                </div>

                {{-- Submit --}}
                <div class="pt-4">
                    <button type="submit"
                        class="group relative w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold h-14 rounded-xl transition-all shadow-lg hover:shadow-xl overflow-hidden">
                        <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        Sign In
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform" style="font-size: 1.25rem;">arrow_forward</span>
                    </button>
                </div>

            </form>

            {{-- Register Link --}}
            <div class="mt-8 text-center border-t border-slate-700/50 pt-6">
                <p class="text-slate-400 text-sm">
                    New to the journey?
                    <a href="{{ route('register') }}" class="font-bold text-blue-500 hover:text-blue-400 transition-colors ml-1">Create an
                        Account</a>
                </p>
            </div>

        </div>

        {{-- Footer Decoration --}}
        <div class="mt-8 flex items-center gap-6 opacity-20 pointer-events-none text-slate-500">
            <span class="material-symbols-outlined">directions_bike</span>
            <span class="material-symbols-outlined">electric_bolt</span>
            <span class="material-symbols-outlined">map</span>
            <span class="material-symbols-outlined">potted_plant</span>
        </div>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>

@endsection
