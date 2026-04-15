@extends('layout.admin')
@section('title', 'Manage Users')
@section('page_title', 'Accounts')
@section('content')

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6 gap-4">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-100 drop-shadow-md">Accounts</h1>
        <a href="{{ route('admin.accounts.create') }}"
            class="bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold px-3 sm:px-4 py-2 rounded-xl transition-all duration-300 shadow-lg shrink-0">
            + Add User
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-slate-800/80 backdrop-blur-md rounded-xl shadow-lg shadow-black/10 border border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" style="min-width: 560px;">
                <thead class="bg-slate-700/50 border-b border-slate-700/50 text-slate-300 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3 w-10 whitespace-nowrap">#</th>
                        <th class="px-4 py-3 whitespace-nowrap">Username</th>
                        <th class="px-4 py-3 whitespace-nowrap">Email</th>
                        <th class="px-4 py-3 whitespace-nowrap">Role</th>
                        <th class="px-4 py-3 whitespace-nowrap">Created</th>
                        <th class="px-4 py-3 text-center whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-4 py-3 text-slate-400 whitespace-nowrap">{{ $user->id }}</td>

                            <td class="px-4 py-3 font-medium text-slate-100 whitespace-nowrap">
                                {{ $user->username }}
                            </td>

                            <td class="px-4 py-3 text-slate-300 whitespace-nowrap">
                                {{ $user->email }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @if ($user->role === 'admin')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">Admin</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">User</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-slate-400 whitespace-nowrap">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.accounts.edit', $user) }}"
                                        class="text-xs text-blue-400 hover:text-blue-300 font-medium hover:underline">
                                        Edit
                                    </a>
                                    <span class="text-slate-600">|</span>
                                    <form action="{{ route('admin.accounts.destroy', $user) }}" method="POST"
                                        onsubmit="return confirm('Delete {{ addslashes($user->username) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs text-rose-400 hover:text-rose-300 font-medium hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-slate-400">
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
