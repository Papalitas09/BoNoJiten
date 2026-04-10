@extends('layout.user')
@section('title', 'Cart')

@section('content')

    <section class="px-4 py-6">

        <h2 class="text-2xl font-bold text-gray-900 mb-6">Your Cart</h2>

        @if (!$cart || $cart->items->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                <span class="material-symbols-outlined text-6xl mb-4">shopping_cart</span>
                <p class="font-medium text-lg">Your cart is empty</p>
                <a href="{{ route('user.home') }}" class="mt-4 rounded-lg bg-blue-600 px-5 py-2 text-white text-sm font-bold">
                    Shop Now
                </a>
            </div>
        @else
            <div class="space-y-4">

                @php $total = 0; @endphp

                @foreach ($cart->items as $item)
                    @php
                        $subtotal = $item->product->price * $item->quantity;
                        $total += $subtotal;
                    @endphp

                    <div class="flex gap-4 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">

                        {{-- Image --}}
                        <div class="h-20 w-20 overflow-hidden rounded-xl bg-gray-100">
                            <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                class="h-full w-full object-cover">
                        </div>

                        {{-- Info --}}
                        <div class="flex flex-1 flex-col justify-between">

                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">
                                    {{ $item->product->name }}
                                </h4>
                                <p class="text-xs text-gray-400">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Quantity + Actions --}}
                            <div class="flex items-center justify-between mt-2">

                                {{-- Update Quantity --}}
                                <form action="{{ route('cart.update', $item) }}" method="POST"
                                    class="flex items-center gap-2">
                                    @csrf

                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                        class="w-14 rounded-md border border-gray-200 text-center text-sm">

                                    <button type="submit" class="text-xs font-bold text-blue-600">
                                        Update
                                    </button>
                                </form>

                                {{-- Remove --}}
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 text-xs font-bold">
                                        Remove
                                    </button>
                                </form>

                            </div>
                        </div>

                        {{-- Subtotal --}}
                        <div class="text-right">
                            <p class="font-bold text-gray-900 text-sm">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </p>
                        </div>

                    </div>
                @endforeach

            </div>

            {{-- Total + Checkout --}}
            <div class="mt-8 rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">

                <div class="flex items-center justify-between mb-3">
                    <span class="text-gray-500 text-sm">Total</span>
                    <span class="text-xl font-bold text-gray-900">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>

                <a href="#" class="block w-full rounded-xl bg-blue-600 py-3 text-center text-white font-bold">
                    Checkout
                </a>

            </div>

        @endif

    </section>

@endsection
