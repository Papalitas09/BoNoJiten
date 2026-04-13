@extends('layout.base')
@section('title', 'Register')
@section('body_class', 'bg-slate-900 text-slate-100')
@section('content')
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; min-height: max(884px, 100dvh); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>

    <div class="relative flex min-h-screen w-full items-center justify-center px-4 py-8 overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="w-full max-w-md relative z-10">

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
                <h1 class="text-3xl font-bold leading-tight text-slate-100">Create Account</h1>
                <p class="mt-2 text-slate-400">Join BoNoJiten and start your journey</p>
            </div>

            {{-- Card --}}
            <div class="bg-slate-800/90 backdrop-blur-xl rounded-3xl shadow-2xl shadow-black/40 border border-slate-700/50 p-6 md:p-8">

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-5 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl text-sm font-medium flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-rose-500/10 border border-rose-500/30 rounded-xl space-y-1">
                        @foreach ($errors->all() as $error)
                            <p class="text-rose-400 text-sm font-medium flex items-center gap-2">
                                <span class="material-symbols-outlined text-base">error</span>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-sm font-bold text-slate-300 mb-1.5 ml-1">
                            Username
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500">
                                <span class="material-symbols-outlined font-medium">person</span>
                            </span>
                            <input type="text" id="username" name="username" value="{{ old('username') }}"
                                placeholder="johndoe123"
                                class="w-full bg-slate-900/50 pl-11 pr-4 py-3.5 border rounded-xl text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-inner
                                {{ $errors->has('username') ? 'border-rose-500' : 'border-slate-700/50' }}"
                                required>
                        </div>
                        @error('username')
                            <p class="mt-1 text-xs text-rose-500 font-medium ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-300 mb-1.5 ml-1">
                            Email Address
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500">
                                <span class="material-symbols-outlined font-medium">mail</span>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="you@example.com"
                                class="w-full bg-slate-900/50 pl-11 pr-4 py-3.5 border rounded-xl text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-inner
                                {{ $errors->has('email') ? 'border-rose-500' : 'border-slate-700/50' }}"
                                required>
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-rose-500 font-medium ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-300 mb-1.5 ml-1">
                            Password
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500">
                                <span class="material-symbols-outlined font-medium">lock</span>
                            </span>
                            <input type="password" id="password" name="password"
                                placeholder="••••••••"
                                class="w-full bg-slate-900/50 pl-11 pr-11 py-3.5 border rounded-xl text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-inner
                                {{ $errors->has('password') ? 'border-rose-500' : 'border-slate-700/50' }}"
                                required>
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                                <span class="material-symbols-outlined font-medium" id="toggleIcon">visibility</span>
                            </button>
                        </div>
                        <p class="text-xs text-slate-500 mt-1 ml-1 font-medium">Minimum 6 characters</p>
                        @error('password')
                            <p class="mt-1 text-xs text-rose-500 font-medium ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-300 mb-1.5 ml-1">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-500">
                                <span class="material-symbols-outlined font-medium">lock</span>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="••••••••"
                                class="w-full bg-slate-900/50 pl-11 pr-4 py-3.5 border border-slate-700/50 rounded-xl text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-inner"
                                required>
                        </div>
                    </div>

                    {{-- Terms & Conditions --}}
                    <div class="flex items-start gap-3 ml-1 mt-6">
                        <div class="relative flex items-center mt-0.5">
                            <input type="checkbox" id="terms" name="terms" required
                                class="peer h-4 w-4 cursor-pointer appearance-none rounded border border-slate-600 bg-slate-900/50 checked:border-blue-500 checked:bg-blue-600 transition-all" />
                            <span class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100">
                                <span class="material-symbols-outlined" style="font-size: 10px; font-weight: bold;">check</span>
                            </span>
                        </div>
                        <label for="terms" class="text-xs text-slate-400 leading-tight cursor-pointer">
                            I agree to the <a href="#" class="text-blue-500 hover:underline">Terms of Service</a>
                            and <a href="#" class="text-blue-500 hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg hover:shadow-xl">
                            <span class="material-symbols-outlined font-medium">person_add</span>
                            Create Account
                        </button>
                    </div>

                    {{-- Login Link --}}
                    <div class="text-center pt-6 pb-2 border-t border-slate-700/50">
                        <p class="text-sm text-slate-400">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-blue-500 font-bold hover:text-blue-400 transition-colors ml-1">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-slate-500 mt-8 font-medium">
                © 2026 BoNoJiten. All rights reserved.
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = 'visibility';
            }
        }

        // Real-time password strength indicator (optional)
        document.getElementById('password')?.addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthIndicator = document.getElementById('password-strength');

            if (!strengthIndicator) {
                const div = document.createElement('div');
                div.id = 'password-strength';
                div.className = 'mt-1 text-xs';
                e.target.parentElement.parentElement.appendChild(div);
            }

            const indicator = document.getElementById('password-strength');
            if (password.length === 0) {
                indicator.innerHTML = '';
            } else if (password.length < 6) {
                indicator.innerHTML = '<span class="text-rose-500">Too short</span>';
            } else if (password.length < 8) {
                indicator.innerHTML = '<span class="text-amber-500">Medium strength</span>';
            } else {
                indicator.innerHTML = '<span class="text-blue-500">Strong password</span>';
            }
        });
    </script>
@endsection