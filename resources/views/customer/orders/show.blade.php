@extends('layouts.store')

@section('title', 'Order Details - OMS Store')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-950 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol
                            class="flex items-center space-x-2 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                            <li><a href="{{ route('dashboard') }}" class="hover:text-primary-600">Dashboard</a>
                            </li>
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            <li><a href="{{ route('customer.orders') }}" class="hover:text-primary-600">Orders</a></li>
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            <li class="text-gray-900 dark:text-white">ORD-#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                            </li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Order Details</h1>
                </div>
                <div class="mt-4 sm:mt-0">
                    @php
                        $statusClasses = [
                            'pending' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400',
                            'processing' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                            'shipped' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
                            'delivered' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                        ];
                        $statusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span
                        class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest {{ $statusClass }}">
                        Status: {{ $order->status }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Order Info & Items -->
                <div class="lg:col-span-2 space-y-8">
                    <div
                        class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50">
                            <h2 class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest">Items
                                Ordered</h2>
                        </div>
                        <ul class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($order->items as $item)
                                <li class="p-6 flex items-center">
                                    <div class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-xl overflow-hidden">
                                        @if($item->product->images->count() > 0)
                                            <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                                alt="{{ $item->product->product_name }}"
                                                class="w-full h-full object-center object-cover">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->product->product_name) }}&background=F3F4F6&color=3c50e0&size=200"
                                                class="w-full h-full object-center object-cover">
                                        @endif
                                    </div>
                                    <div class="ml-6 flex-1 flex flex-col">
                                        <div class="flex justify-between">
                                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">
                                                {{ $item->product->product_name }}</h4>
                                            <p class="text-sm font-bold text-primary-600">${{ number_format($item->price, 2) }}
                                            </p>
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Quantity: {{ $item->quantity }}</p>
                                        <p
                                            class="mt-4 text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest">
                                            Subtotal: ${{ number_format($item->price * $item->quantity, 2) }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Order Timeline / Details -->
                    <div
                        class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8">
                        <h2
                            class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-6 pb-2 border-b border-gray-100 dark:border-gray-800">
                            Order Summary</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Subtotal</span>
                                <span
                                    class="font-bold text-gray-900 dark:text-white">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Shipping</span>
                                <span class="font-bold text-green-600">FREE</span>
                            </div>
                            <div class="border-t border-gray-100 dark:border-gray-800 pt-4 flex justify-between">
                                <span class="text-base font-extrabold text-gray-900 dark:text-white">Total</span>
                                <span
                                    class="text-xl font-extrabold text-primary-600">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer & Shipping Info -->
                <div class="space-y-8">
                    <div
                        class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8">
                        <h2
                            class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-6 pb-2 border-b border-gray-100 dark:border-gray-800">
                            Shipping Details</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Shipping
                                    Address</p>
                                <p class="text-sm text-gray-800 dark:text-gray-300 whitespace-pre-line">
                                    {{ $order->shipping_address }}</p>
                            </div>
                            @if($order->shipment)
                                <div class="pt-4 border-t border-gray-50 dark:border-gray-800">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Carrier</p>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $order->shipment->carrier }}
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Tracking
                                        Number</p>
                                    <p class="text-sm font-bold text-primary-600">{{ $order->shipment->tracking_number }}</p>
                                </div>
                                <div class="pt-2">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Shipment
                                        Status</p>
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                        {{ $order->shipment->status }}
                                    </span>
                                </div>
                            @else
                                <div class="pt-4 border-t border-gray-50 dark:border-gray-800">
                                    <p class="text-xs text-gray-500 italic">No shipment information available yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8">
                        <h2
                            class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest mb-6 pb-2 border-b border-gray-100 dark:border-gray-800">
                            Payment Details</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Billing
                                    Address</p>
                                <p class="text-sm text-gray-800 dark:text-gray-300 whitespace-pre-line">
                                    {{ $order->billing_address }}</p>
                            </div>
                            @if($order->payment)
                                <div class="pt-4 border-t border-gray-50 dark:border-gray-800">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Method</p>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white uppercase">
                                        {{ $order->payment->payment_method }}</p>
                                </div>
                                <div class="pt-2">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Transaction ID
                                    </p>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">
                                        {{ $order->payment->transaction_id }}</p>
                                </div>
                                <div class="pt-2">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Payment Status
                                    </p>
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                        {{ $order->payment->status }}
                                    </span>
                                </div>
                            @else
                                <div class="pt-4 border-t border-gray-50 dark:border-gray-800">
                                    <p class="text-xs text-gray-500 italic">Payment information pending.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection