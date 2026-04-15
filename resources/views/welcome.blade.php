@extends('layout.base')
@section('title', 'Welcome to BoNoJiten')

@section('content')
<div class="min-h-screen bg-slate-900 text-slate-200 font-sans relative overflow-x-hidden overflow-y-hidden flex flex-col selection:bg-blue-500/30 selection:text-white">

    <!-- Ambient Background Effects -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/20 rounded-full mix-blend-screen filter blur-[120px] opacity-60 animate-blob"></div>
    <div class="absolute -bottom-32 right-1/3 w-96 h-96 bg-emerald-500/20 rounded-full mix-blend-screen filter blur-[120px] opacity-60 animate-blob animation-delay-2000"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-500/20 rounded-full mix-blend-screen filter blur-[120px] opacity-60 animate-blob animation-delay-4000"></div>

    <!-- Navigation -->
    <nav class="relative z-50 bg-slate-900/50 backdrop-blur-lg border-b border-slate-700/50 sticky top-0">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-500/30 ring-1 ring-white/10">
                    B
                </div>
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-200 to-slate-400 tracking-tight">BoNoJiten</span>
            </div>
            
            <div class="flex items-center gap-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-500 rounded-xl transition-all duration-300 shadow-[0_0_15px_rgba(37,99,235,0.3)]">
                            Admin Dashboard
                        </a>
                    @else
                        <a href="{{ route('user.home') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-500 rounded-xl transition-all duration-300 shadow-[0_0_15px_rgba(37,99,235,0.3)]">
                            My Account
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex px-5 py-2.5 text-sm font-semibold text-slate-300 hover:text-white transition-colors rounded-xl hover:bg-slate-800/80">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 rounded-xl transition-all duration-300 shadow-[0_0_15px_rgba(79,70,229,0.4)] hover:shadow-[0_0_25px_rgba(79,70,229,0.6)] border border-white/10">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative z-10 flex-grow flex items-center justify-center px-6 py-24">
        <div class="max-w-5xl mx-auto text-center space-y-10">
            <!-- Pulsing Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-800/60 border border-slate-700/50 backdrop-blur-md text-xs sm:text-sm text-slate-300 shadow-xl shadow-black/20 ring-1 ring-white/5">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                Premium Quality Equipment & Spareparts
            </div>

            <!-- Headline -->
            <h1 class="text-5xl md:text-7xl min-[1100px]:text-8xl font-extrabold tracking-tight text-white drop-shadow-lg leading-[1.1]">
                Gear Up For <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 pb-2 inline-block">Limitless Riding</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-lg md:text-xl text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Elevate your cycling experience. Discover an elite tier of authentic bicycle components, rugged spare parts, and world-class equipment delivered to your door.
            </p>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-8">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.home') }}" class="w-full sm:w-auto px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 rounded-2xl transition-all duration-300 shadow-[0_0_30px_rgba(79,70,229,0.3)] hover:shadow-[0_0_45px_rgba(79,70,229,0.5)] transform hover:-translate-y-1">
                        Continue to App
                    </a>
                @else
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 rounded-2xl transition-all duration-300 shadow-[0_0_30px_rgba(79,70,229,0.3)] hover:shadow-[0_0_45px_rgba(79,70,229,0.5)] transform hover:-translate-y-1 border border-white/10 group flex items-center justify-center gap-2">
                        Get Started
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 text-base font-bold text-slate-300 bg-slate-800/50 border border-slate-700/50 hover:bg-slate-700/50 hover:text-white backdrop-blur-md rounded-2xl transition-all duration-300 shadow-xl transform hover:-translate-y-1 ring-1 ring-transparent hover:ring-white/10">
                        Sign In Now
                    </a>
                @endauth
            </div>

            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-24 text-left">
                <!-- Feature 1 -->
                <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-md hover:bg-slate-800/50 transition-colors shadow-2xl shadow-black/20 group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-400 mb-5 border border-blue-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-100 mb-2">Authentic Gear</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">We source 100% genuine components directly from the world's most trusted manufacturers.</p>
                </div>
                <!-- Feature 2 -->
                <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-md hover:bg-slate-800/50 transition-colors shadow-2xl shadow-black/20 group">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/10 flex items-center justify-center text-purple-400 mb-5 border border-purple-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-100 mb-2">Lightning Fast</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">Experience rapid delivery. We dispatch components swiftly so you can get back on the trail.</p>
                </div>
                <!-- Feature 3 -->
                <div class="p-6 rounded-3xl bg-slate-800/30 border border-slate-700/50 backdrop-blur-md hover:bg-slate-800/50 transition-colors shadow-2xl shadow-black/20 group">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 mb-5 border border-emerald-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-100 mb-2">Secure & Private</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">Enterprise-grade security across all transactions to ensure your shopping experience remains safe.</p>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 10s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
    }
    .animation-delay-2000 {
        animation-delay: -3.33s;
    }
    .animation-delay-4000 {
        animation-delay: -6.66s;
    }
</style>
@endsection