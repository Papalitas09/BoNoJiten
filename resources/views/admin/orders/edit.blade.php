@extends('layout.admin')
@section('title', 'Edit Order')
@section('page_title', 'Edit Order')
@section('content')
    <div class="max-w-2xl mx-auto">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.orders.index') }}" class="text-slate-400 hover:text-slate-200 transition-colors p-1 rounded-lg hover:bg-slate-700/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-100 drop-shadow-md">
                Edit Order <span class="text-slate-400 font-mono">#{{ $order->order_number }}</span>
            </h1>
        </div>

        <form action="{{ route('admin.orders.update', $order) }}" method="POST"
            class="bg-slate-800/80 backdrop-blur-md rounded-xl shadow-lg shadow-black/10 border border-slate-700/50 divide-y divide-slate-700/50">
            @csrf
            @method('PUT')

            <div class="p-4 sm:p-6 space-y-5">

                {{-- Customer --}}
                <div>
                    <label for="user_id" class="block text-sm font-medium text-slate-300 mb-1">
                        Customer <span class="text-rose-500">*</span>
                    </label>
                    <select id="user_id" name="user_id"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500
                           {{ $errors->has('user_id') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" class="bg-slate-800"
                                {{ old('user_id', $order->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->username }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Product --}}
                <div>
                    <label for="product_id" class="block text-sm font-medium text-slate-300 mb-1">
                        Product <span class="text-rose-500">*</span>
                    </label>
                    <select id="product_id" name="product_id"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500
                           {{ $errors->has('product_id') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" class="bg-slate-800"
                                {{ old('product_id', $order->product_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} — Rp {{ number_format($product->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Quantity & Status --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-slate-300 mb-1">
                            Quantity <span class="text-rose-500">*</span>
                        </label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $order->quantity) }}"
                            min="1"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500
                               {{ $errors->has('quantity') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}" />
                        @error('quantity')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-slate-300 mb-1">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select id="status" name="status"
                            class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 focus:outline-none focus:ring-2 focus:ring-blue-500
                               {{ $errors->has('status') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}">
                            <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }} class="bg-slate-800">Pending</option>
                            <option value="completed" {{ old('status', $order->status) === 'completed' ? 'selected' : '' }} class="bg-slate-800">Completed</option>
                            <option value="cancelled" {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }} class="bg-slate-800">Cancelled</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Address --}}
                <div>
                    <label for="address" class="block text-sm font-medium text-slate-300 mb-1">
                        Address <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="address" name="address" value="{{ old('address', $order->address) }}"
                        placeholder="Shipping address"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-slate-200 bg-slate-900/50 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500
                           {{ $errors->has('address') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700/50' }}" />
                    @error('address')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Total Price (read only) --}}
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Current Total</label>
                    <div class="px-3 py-2 bg-slate-900/50 border border-slate-700/50 rounded-lg text-sm text-slate-300 shadow-inner">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        <span class="text-slate-500 text-xs ml-1">(auto-recalculated on save)</span>
                    </div>
                </div>

            </div>

            <div class="px-4 sm:px-6 py-4 flex flex-wrap items-center justify-between gap-3 bg-slate-800/30">

                <button type="button" onclick="document.getElementById('delete-form').submit()"
                    class="px-4 py-2 text-sm font-medium text-rose-400 bg-rose-500/10 hover:bg-rose-500/20 rounded-xl transition-colors shadow-sm">
                    Delete Order
                </button>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.orders.index') }}"
                        class="px-4 py-2 text-sm font-medium text-slate-200 bg-slate-700 hover:bg-slate-600 rounded-xl transition-colors shadow-sm">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 rounded-xl transition-all duration-300 shadow-lg">
                        Update Order
                    </button>
                </div>

            </div>

        </form>

        {{-- Delete form outside --}}
        <form id="delete-form" action="{{ route('admin.orders.destroy', $order) }}" method="POST"
            onsubmit="return confirm('Delete order #{{ $order->order_number }}?')">
            @csrf
            @method('DELETE')
        </form>

    </div>
@endsection
