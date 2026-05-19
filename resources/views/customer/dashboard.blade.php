@extends('layouts.store')

@section('title', 'My Dashboard - OMS Store')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-950 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-start lg:space-x-8">
                <!-- Sidebar Navigation -->
                <aside class="hidden lg:block w-64 flex-shrink-0">
                    <nav class="space-y-1">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-4 py-3 text-sm font-bold rounded-xl {{ Route::is('dashboard') || Route::is('customer.dashboard') ? 'bg-primary-600 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-800' }} transition-colors">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('customer.orders') }}"
                            class="flex items-center px-4 py-3 text-sm font-bold rounded-xl {{ Route::is('customer.orders*') ? 'bg-primary-600 text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-800' }} transition-colors">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            My Orders
                        </a>
                        <a href="#"
                            class="flex items-center px-4 py-3 text-sm font-bold rounded-xl text-gray-600 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-800 transition-colors">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profile Settings
                        </a>
                    </nav>
                </aside>

                <!-- Main Dashboard Content -->
                <div class="flex-1">
                    <div class="mb-8">
                        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Hello, {{ Auth::user()->name }}!
                        </h1>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Welcome back to your account. Here's what's
                            happening with your orders.</p>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                        <div
                            class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 flex items-center">
                            <div
                                class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Orders</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $orderStats['total'] }}</p>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 flex items-center">
                            <div
                                class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 text-amber-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pending</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $orderStats['pending'] }}</p>
                            </div>
                        </div>
                        <div
                            class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 flex items-center">
                            <div
                                class="w-12 h-12 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Delivered</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-white">{{ $orderStats['delivered'] }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div
                        class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                        <div
                            class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                            <h2 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-widest">Recent
                                Orders</h2>
                            <a href="{{ route('customer.orders') }}"
                                class="text-primary-600 hover:text-primary-700 text-xs font-bold uppercase tracking-widest">View
                                All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-800/50">
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                            Order ID</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                            Date</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                            Total</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                            Status</th>
                                        <th class="px-6 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse($recentOrders as $order)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/20 transition-colors">
                                            <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-white">
                                                ORD-#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $order->created_at->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 text-sm font-bold text-primary-600">
                                                ${{ number_format($order->total_amount, 2) }}</td>
                                            <td class="px-6 py-4">
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
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $statusClass }}">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('customer.orders.show', $order) }}"
                                                    class="text-primary-600 hover:text-primary-700 text-sm font-bold">Details</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">No orders
                                                found. <a href="{{ route('products.index') }}"
                                                    class="text-primary-600 font-bold">Start shopping!</a></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection