<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BonoJiten</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0,1" />
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">

    <div class="flex min-h-screen items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">

            {{-- Logo & Header --}}
            <div class="text-center mb-6">
                <div
                    class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-200 mb-3">
                    <span class="material-symbols-outlined text-3xl">directions_bike</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Create Account</h2>
                <p class="text-sm text-gray-500 mt-1">Join BonoJiten and start your journey</p>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 md:p-8">

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-600 rounded-xl text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-600 text-sm flex items-center gap-2">
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
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Username
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <span class="material-symbols-outlined text-lg">person</span>
                            </span>
                            <input type="text" id="username" name="username" value="{{ old('username') }}"
                                placeholder="johndoe123"
                                class="w-full pl-10 pr-3 py-2.5 border rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                {{ $errors->has('username') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                required>
                        </div>
                        @error('username')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Email Address
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <span class="material-symbols-outlined text-lg">mail</span>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="you@example.com"
                                class="w-full pl-10 pr-3 py-2.5 border rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                required>
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <span class="material-symbols-outlined text-lg">lock</span>
                            </span>
                            <input type="password" id="password" name="password"
                                placeholder="••••••••"
                                class="w-full pl-10 pr-10 py-2.5 border rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                required>
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <span class="material-symbols-outlined text-lg" id="toggleIcon">visibility</span>
                            </button>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Minimum 6 characters</p>
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <span class="material-symbols-outlined text-lg">lock</span>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="••••••••"
                                class="w-full pl-10 pr-3 py-2.5 border rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent border-gray-200"
                                required>
                        </div>
                    </div>

                    {{-- Terms & Conditions --}}
                    <div class="flex items-start gap-3">
                        <input type="checkbox" id="terms" name="terms" required
                            class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="terms" class="text-xs text-gray-500">
                            I agree to the <a href="#" class="text-blue-600 hover:underline">Terms of Service</a>
                            and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-bold py-3 rounded-xl transition-all shadow-lg shadow-blue-200">
                        <span class="material-symbols-outlined">person_add</span>
                        Create Account
                    </button>

                    {{-- Login Link --}}
                    <div class="text-center pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-500">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-gray-400 mt-6">
                © 2024 BonoJiten. All rights reserved.
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
                indicator.innerHTML = '<span class="text-red-500">Too short</span>';
            } else if (password.length < 8) {
                indicator.innerHTML = '<span class="text-yellow-500">Medium strength</span>';
            } else {
                indicator.innerHTML = '<span class="text-green-500">Strong password</span>';
            }
        });
    </script>

</body>

</html>