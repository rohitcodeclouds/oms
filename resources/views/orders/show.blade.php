@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
    <div class="space-y-6">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('orders.index') }}"
                    class="p-2 bg-black/5 dark:bg-white/5 rounded-xl hover:bg-black/10 dark:hover:bg-white/10 transition-colors text-neutral-500 dark:text-neutral-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-neutral-800 dark:text-white tracking-tight">Order
                        #ORD-{{ $order->id }}</h1>
                    <p class="text-neutral-500 mt-1 text-sm">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                @php
                    $statusColors = [
                        'pending' => 'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-500/10 dark:border-amber-500/20',
                        'processing' => 'bg-blue-50 text-blue-600 border-blue-100 dark:bg-blue-500/10 dark:border-blue-500/20',
                        'shipped' => 'bg-purple-50 text-purple-600 border-purple-100 dark:bg-purple-500/10 dark:border-purple-500/20',
                        'delivered' => 'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-500/10 dark:border-emerald-500/20',
                        'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-500/10 dark:border-rose-500/20',
                    ];
                    $colorClass = $statusColors[$order->status] ?? 'bg-neutral-50 text-neutral-600 border-neutral-100';
                @endphp
                <span class="px-4 py-2 rounded-full border text-xs font-bold uppercase tracking-wider {{ $colorClass }}">
                    {{ $order->status }}
                </span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Column: Items and Update Form -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Update Status Box -->
                <div class="glass p-6 rounded-3xl">
                    <h3 class="text-lg font-bold text-neutral-800 dark:text-white mb-4">Update Order Status</h3>
                    <form action="{{ route('admin.orders.status', $order) }}" method="POST"
                        class="flex flex-col sm:flex-row items-end gap-4">
                        @csrf
                        <div class="w-full sm:flex-1">
                            <label for="status"
                                class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Change
                                Status</label>
                            <select name="status" id="status"
                                class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white appearance-none">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing
                                </option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered
                                </option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full sm:w-auto bg-primary-500 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-primary-600 transition-colors shadow-lg shadow-primary-500/20 shrink-0">
                            Update Status
                        </button>
                    </form>
                </div>

                <!-- Order Items -->
                <div class="glass p-6 rounded-3xl">
                    <h3 class="text-lg font-bold text-neutral-800 dark:text-white mb-6">Order Items</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div
                                class="flex items-center justify-between p-4 bg-black/[0.02] dark:bg-white/[0.02] rounded-2xl border border-black/5 dark:border-white/5">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-16 h-16 rounded-xl bg-white dark:bg-neutral-800 overflow-hidden shrink-0 flex items-center justify-center p-2 shadow-sm">
                                        @if($item->product && $item->product->images->count() > 0)
                                            <img src="{{ Storage::url($item->product->images->first()->image_path) }}"
                                                alt="{{ $item->product->name }}" class="max-w-full max-h-full object-contain">
                                        @else
                                            <svg class="w-6 h-6 text-neutral-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-neutral-800 dark:text-white">
                                            {{ $item->product ? $item->product->name : 'Unknown Product' }}</h4>
                                        <p class="text-xs text-neutral-500 mt-1">₹{{ number_format($item->price, 2) }} x
                                            {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-neutral-800 dark:text-white">
                                        ₹{{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-6 border-t border-black/5 dark:border-white/5 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-neutral-500 font-medium">Subtotal</span>
                            <span
                                class="text-neutral-800 dark:text-white font-bold">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-neutral-500 font-medium">Shipping (Flat Rate)</span>
                            <span class="text-neutral-800 dark:text-white font-bold">₹0.00</span>
                        </div>
                        <div class="flex justify-between text-lg pt-3 border-t border-black/5 dark:border-white/5">
                            <span class="text-neutral-800 dark:text-white font-bold">Total</span>
                            <span class="text-primary-500 font-bold">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Customer Info & Addresses -->
            <div class="space-y-6">

                <!-- Customer Info -->
                <div class="glass p-6 rounded-3xl">
                    <h3 class="text-lg font-bold text-neutral-800 dark:text-white mb-6">Customer Information</h3>
                    <div class="flex items-center space-x-4 mb-6">
                        <div
                            class="w-12 h-12 rounded-xl bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center text-lg font-bold text-primary-500 shrink-0">
                            {{ strtoupper(substr($order->user->name ?? 'G', 0, 2)) }}
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-neutral-800 dark:text-white">
                                {{ $order->user->name ?? 'Guest User' }}</h4>
                            <p class="text-xs text-neutral-500">Customer</p>
                        </div>
                    </div>

                    <div class="space-y-4 text-sm">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-black/5 dark:bg-white/5 rounded-lg text-neutral-500 shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span
                                class="text-neutral-700 dark:text-neutral-300 font-medium break-all">{{ $order->user->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="glass p-6 rounded-3xl">
                    <h3 class="text-lg font-bold text-neutral-800 dark:text-white mb-4">Shipping Address</h3>
                    <div
                        class="p-4 bg-black/[0.02] dark:bg-white/[0.02] rounded-2xl border border-black/5 dark:border-white/5">
                        <p class="text-sm text-neutral-700 dark:text-neutral-300 leading-relaxed whitespace-pre-line">
                            {{ $order->shipping_address ?? 'Not provided' }}</p>
                    </div>
                </div>

                <!-- Billing Address -->
                <div class="glass p-6 rounded-3xl">
                    <h3 class="text-lg font-bold text-neutral-800 dark:text-white mb-4">Billing Address</h3>
                    <div
                        class="p-4 bg-black/[0.02] dark:bg-white/[0.02] rounded-2xl border border-black/5 dark:border-white/5">
                        <p class="text-sm text-neutral-700 dark:text-neutral-300 leading-relaxed whitespace-pre-line">
                            {{ $order->billing_address ?? 'Not provided' }}</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection