@extends('layout.admin')
@section('title', 'Edit Order')
@section('content')
    <div class="p-6 max-w-2xl mx-auto">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.orders.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Order <span
                    class="text-gray-400 font-mono">#{{ $order->order_number }}</span></h1>
        </div>

        <form action="{{ route('admin.orders.update', $order) }}" method="POST"
            class="bg-white rounded-xl shadow-sm border border-gray-200 divide-y divide-gray-100">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-5">

                {{-- Customer --}}
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Customer <span class="text-red-500">*</span>
                    </label>
                    <select id="user_id" name="user_id"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white
                           {{ $errors->has('user_id') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('user_id', $order->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->username }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Product --}}
                <div>
                    <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Product <span class="text-red-500">*</span>
                    </label>
                    <select id="product_id" name="product_id"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white
                           {{ $errors->has('product_id') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ old('product_id', $order->product_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} — Rp {{ number_format($product->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Quantity --}}
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">
                        Quantity <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $order->quantity) }}"
                        min="1"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500
                           {{ $errors->has('quantity') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}" />
                    @error('quantity')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Address --}}
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                        Address <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="address" name="address" value="{{ old('address', $order->address) }}"
                        placeholder="Shipping address"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500
                           {{ $errors->has('address') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}" />
                    @error('address')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status"
                        class="w-full px-3 py-2 border rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white
                           {{ $errors->has('status') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}">
                        <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>
                            Pending</option>
                        <option value="completed" {{ old('status', $order->status) === 'completed' ? 'selected' : '' }}>
                            Completed</option>
                        <option value="cancelled" {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}>
                            Cancelled</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Total Price (read only) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Total</label>
                    <div class="px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-600">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        <span class="text-gray-400 text-xs ml-1">(auto-recalculated on save)</span>
                    </div>
                </div>

            </div>

            <div class="px-6 py-4 flex items-center justify-between">

                <button type="button" onclick="document.getElementById('delete-form').submit()"
                    class="px-4 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                    Delete Order
                </button>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.orders.index') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
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
