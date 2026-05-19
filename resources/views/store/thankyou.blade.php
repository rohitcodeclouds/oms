@extends('layouts.store')

@section('title', 'Thank You - OMS Store')

@section('content')
    <div class="bg-white dark:bg-gray-900 py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <div class="mb-8 flex justify-center">
                <div class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl mb-4">Thank you for
                your order!</h1>
            <p class="text-lg text-gray-500 dark:text-gray-400 mb-10">Your order has been placed successfully. We've sent a
                confirmation email with order details.</p>

            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-8 border border-gray-100 dark:border-gray-700 mb-12">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 text-left">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Order Number</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">
                            ORD-#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Date</p>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">
                            {{ $order->created_at->format('M d, Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total</p>
                        <p class="text-lg font-bold text-primary-600">${{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-8 text-left">
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-4">Items Ordered
                    </h3>
                    <ul class="space-y-4">
                        @foreach($order->items as $item)
                            <li class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-300">{{ $item->product->product_name }} x
                                    {{ $item->quantity }}</span>
                                <span
                                    class="font-bold text-gray-900 dark:text-white">${{ number_format($item->price * $item->quantity, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-8 py-4 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-lg">
                    View My Orders
                </a>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-8 py-4 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-bold rounded-xl hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors uppercase tracking-widest text-xs">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
@endsection