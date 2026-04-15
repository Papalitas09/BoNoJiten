@extends('layout.admin')
@section('title', 'Edit User')
@section('page_title', 'Edit User')
@section('content')
    <div class="max-w-2xl mx-auto">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.accounts.index') }}" class="text-slate-400 hover:text-slate-200 transition-colors p-1 rounded-lg hover:bg-slate-700/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-100 drop-shadow-md">Edit User</h1>
        </div>

        <form action="{{ route('admin.accounts.update', $account) }}" method="POST"
            class="bg-slate-800/80 backdrop-blur-md rounded-xl shadow-lg shadow-black/10 border border-slate-700/50 divide-y divide-slate-700/50">
            @csrf
            @method('PUT')

            <div class="p-4 sm:p-6 space-y-5">

                {{-- Username & Email --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-300 mb-1">
                            Username <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="username" name="username" value="{{ old('username', $account->username) }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                               {{ $errors->has('username') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}" />
                        @error('username')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-1">
                            Email <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $account->email) }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                               {{ $errors->has('email') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}" />
                        @error('email')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Password & Confirm --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-1">
                            New Password
                            <span class="text-slate-500 font-normal">(leave blank to keep current)</span>
                        </label>
                        <input type="password" id="password" name="password" placeholder="Min. 8 characters"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                               {{ $errors->has('password') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}" />
                        @error('password')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1">
                            Confirm New Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Repeat new password"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent border-slate-700/50" />
                    </div>
                </div>

            </div>

            <div class="px-4 sm:px-6 py-4 flex flex-wrap items-center justify-between gap-3 bg-slate-800/30">

                <button type="button" onclick="document.getElementById('delete-form').submit()"
                    class="px-4 py-2 text-sm font-medium text-rose-400 bg-rose-500/10 hover:bg-rose-500/20 rounded-xl transition-colors shadow-sm">
                    Delete User
                </button>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.accounts.index') }}"
                        class="px-4 py-2 text-sm font-medium text-slate-200 bg-slate-700 hover:bg-slate-600 rounded-xl transition-colors shadow-sm">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 rounded-xl transition-all duration-300 shadow-lg">
                        Update User
                    </button>
                </div>

            </div>

        </form>

        {{-- Delete form outside --}}
        <form id="delete-form" action="{{ route('admin.accounts.destroy', $account) }}" method="POST"
            onsubmit="return confirm('Delete {{ addslashes($account->username) }}?')">
            @csrf
            @method('DELETE')
        </form>

    </div>
@endsection
