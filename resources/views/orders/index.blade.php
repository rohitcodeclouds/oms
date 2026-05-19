@extends('layouts.admin')

@section('title', 'Orders Management')

@section('content')
    <div class="space-y-6">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-neutral-800 dark:text-white tracking-tight">Orders Management
                </h1>
                <p class="text-neutral-500 mt-1 text-sm">View and manage customer orders.</p>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="glass p-6 rounded-3xl mb-6">
            <form action="{{ route('orders.index') }}" method="GET"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- Search -->
                <div>
                    <label for="search"
                        class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Search</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Order ID, Name, Email"
                            class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-2.5 pl-11 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status"
                        class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Status</label>
                    <select name="status" id="status"
                        class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white appearance-none">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing
                        </option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Date Range -->
                <div class="md:col-span-2 grid grid-cols-2 gap-4">
                    <div>
                        <label for="start_date"
                            class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">Start
                            Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                    </div>
                    <div>
                        <label for="end_date"
                            class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-2">End Date</label>
                        <div class="flex items-center space-x-2">
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                                class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all dark:text-white">
                            <button type="submit"
                                class="bg-primary-500 text-white p-2.5 rounded-xl hover:bg-primary-600 transition-colors shadow-lg shadow-primary-500/20 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        <!-- Table Section -->
        <div class="glass rounded-3xl overflow-hidden shadow-sm">
            <div class="table-responsive">
                <table class="w-full text-left min-w-[1000px]">
                    <thead>
                        <tr
                            class="text-[10px] uppercase tracking-widest text-neutral-500 bg-neutral-50 dark:bg-white/[0.02] border-b border-black/5 dark:border-white/5">
                            <th class="px-6 py-5 font-bold">Order ID</th>
                            <th class="px-6 py-5 font-bold">Customer Details</th>
                            <th class="px-6 py-5 font-bold">Total Amount</th>
                            <th class="px-6 py-5 font-bold">Date</th>
                            <th class="px-6 py-5 font-bold">Status</th>
                            <th class="px-6 py-5 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5 dark:divide-white/5 text-xs sm:text-sm">
                        @forelse($orders as $order)
                            <tr class="hover:bg-primary-50 dark:hover:bg-white/[0.02] transition-colors group">
                                <td class="px-6 py-4 font-mono text-neutral-500 dark:text-neutral-400">
                                    #ORD-{{ $order->id }}
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-neutral-800 dark:text-white font-semibold">
                                        {{ $order->user->name ?? 'Guest User' }}
                                    </p>
                                    <p class="text-neutral-500 text-xs">{{ $order->user->email ?? 'N/A' }}</p>
                                </td>
                                <td class="px-6 py-4 font-bold text-neutral-800 dark:text-white">
                                    ₹{{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="px-6 py-4 text-neutral-500">
                                    {{ $order->created_at->format('M d, Y') }}
                                    <span
                                        class="block text-[10px] text-neutral-400">{{ $order->created_at->format('h:i A') }}</span>
                                </td>
                                <td class="px-6 py-4">
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
                                    <span
                                        class="px-3 py-1 rounded-full border text-[10px] font-bold uppercase tracking-wider {{ $colorClass }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-colors dark:hover:bg-rose-500/10"
                                            title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                    <a href="{{ route('orders.show', $order) }}"
                                        class="inline-block p-2 text-primary-500 hover:bg-primary-50 rounded-lg transition-colors dark:hover:bg-primary-500/10"
                                        title="View">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-neutral-500 dark:text-neutral-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-neutral-300 dark:text-neutral-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-sm font-medium">No orders found</p>
                                    <p class="text-xs mt-1">Try adjusting your filters or search term.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="px-6 py-4 border-t border-black/5 dark:border-white/5">
                    {{ $orders->withQueryString()->links('pagination::tailwind') }}
                </div>
            @endif
        </div>

    </div>
@endsection