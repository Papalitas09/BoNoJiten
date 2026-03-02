@extends('layout.base')
@section('title', 'login')
@section('content')
 <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; min-height: max(884px, 100dvh); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
    <div class="relative flex min-h-screen w-full flex-col items-center justify-center overflow-x-hidden p-4">

        {{-- Main Card --}}
        <div class="w-full max-w-[440px] bg-white rounded-xl border border-slate-200 p-8 shadow-xl">

            {{-- Logo --}}
            <div class="flex flex-col items-center mb-8">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-blue-600">
                    <span class="material-symbols-outlined" style="font-size: 2rem;">pedal_bike</span>
                </div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900">BoNoJiten</h2>
                <div class="mt-1 h-1 w-8 bg-blue-600 rounded-full"></div>
            </div>

            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold leading-tight">Welcome Back</h1>
                <p class="mt-2 text-slate-500">Login to your rider account</p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div class="flex flex-col gap-2">
                    <label for="email" class="text-sm font-medium text-slate-700 ml-1">Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"
                            style="font-size: 1.25rem;">mail</span>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email"
                            placeholder="rider@velociti.com"
                            class="w-full rounded-lg border h-14 pl-12 pr-4 text-base outline-none transition-all placeholder:text-slate-400
                               {{ $errors->has('email') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500' }}" />
                    </div>
                    @error('email')
                        <p class="text-xs text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center ml-1">
                        <label for="password" class="text-sm font-medium text-slate-700">Password</label>
                        {{-- @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-500 transition-colors">
                                Forgot Password?
                            </a>
                        @endif --}}
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"
                            style="font-size: 1.25rem;">lock</span>
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full rounded-lg border h-14 pl-12 pr-12 text-base outline-none transition-all placeholder:text-slate-400
                               {{ $errors->has('password') ? 'border-red-400 bg-red-50 focus:ring-red-400' : 'border-slate-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500' }}" />
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <span class="material-symbols-outlined" id="eye-icon"
                                style="font-size: 1.25rem;">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-2 ml-1">
                    <input id="remember" name="remember" type="checkbox"
                        class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
                    <label for="remember" class="text-sm text-slate-600">Keep me logged in</label>
                </div>

                {{-- Submit --}}
                <div class="pt-2">
                    <button type="submit"
                        class="w-full h-14 bg-blue-600 hover:bg-blue-700 text-white font-bold text-lg rounded-lg transition-all shadow-lg flex items-center justify-center gap-2">
                        Sign In
                        <span class="material-symbols-outlined" style="font-size: 1.25rem;">arrow_forward</span>
                    </button>
                </div>

            </form>

            {{-- Register Link --}}
            <div class="mt-8 text-center">
                <p class="text-slate-500">
                    New to the journey?
                    <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:underline ml-1">Create an
                        Account</a>
                </p>
            </div>

        </div>

        {{-- Footer Decoration --}}
        <div class="mt-8 flex items-center gap-6 opacity-30 pointer-events-none">
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
