@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
    <div class="space-y-8">

        <!-- Welcome Section -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-neutral-800 dark:text-white tracking-tight">Dashboard Overview</h1>
                <p class="text-neutral-500 mt-1 text-sm">Monitor your store's performance in real-time.</p>
            </div>
            <div class="flex items-center space-x-3">
                <button
                    class="bg-white px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-neutral-600 hover:text-primary-500 transition-all border border-neutral-200">
                    Download Report
                </button>
                <button
                    class="bg-primary-500 text-white px-6 py-2.5 rounded-xl text-xs sm:text-sm font-bold hover:bg-primary-600 hover:scale-[1.02] transition-all active:scale-95 shadow-lg shadow-primary-500/20">
                    + Add Product
                </button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Revenue Card -->
            <div
                class="glass p-6 rounded-2xl group hover:border-primary-500/30 transition-all duration-500 hover:shadow-2xl hover:shadow-primary-500/5 relative overflow-hidden">
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-primary-500/5 rounded-full blur-2xl group-hover:bg-primary-500/10 transition-colors"></div>
                <div class="flex items-center justify-between">
                    <div class="p-3 bg-primary-100 dark:bg-primary-500/10 rounded-xl">
                        <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">+12.5%</span>
                </div>
                <div class="mt-6">
                    <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest">Total Revenue</p>
                    <h3 class="text-3xl font-bold text-neutral-800 dark:text-white tracking-tight mt-1">₹ {{ number_format($totalRevenue, 2) }}</h3>
                </div>
                <div class="mt-6 w-full h-1.5 bg-neutral-100 dark:bg-neutral-800 rounded-full overflow-hidden">
                    <div class="h-full bg-primary-500 w-[65%] group-hover:w-[70%] transition-all duration-1000 shadow-[0_0_8px_rgba(34,197,94,0.4)]"></div>
                </div>
            </div>

            <!-- Orders Card -->
            <div
                class="glass p-6 rounded-2xl group hover:border-blue-500/30 transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/5 relative overflow-hidden">
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-500/5 rounded-full blur-2xl group-hover:bg-blue-500/10 transition-colors"></div>
                <div class="flex items-center justify-between">
                    <div class="p-3 bg-blue-100 dark:bg-blue-500/10 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">+4.2%</span>
                </div>
                <div class="mt-6">
                    <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest">Active Orders</p>
                    <h3 class="text-3xl font-bold text-neutral-800 dark:text-white tracking-tight mt-1">{{ $totalOrders }}</h3>
                </div>
                <div class="mt-6 w-full h-1.5 bg-neutral-100 dark:bg-neutral-800 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 w-[85%] group-hover:w-[88%] transition-all duration-1000 shadow-[0_0_8px_rgba(59,130,246,0.4)]"></div>
                </div>
            </div>

            <!-- Products Card -->
            <div
                class="glass p-6 rounded-2xl group hover:border-amber-500/30 transition-all duration-500 hover:shadow-2xl hover:shadow-amber-500/5 relative overflow-hidden">
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-amber-500/5 rounded-full blur-2xl group-hover:bg-amber-500/10 transition-colors"></div>
                <div class="flex items-center justify-between">
                    <div class="p-3 bg-amber-100 dark:bg-amber-500/10 rounded-xl">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">12 Low</span>
                </div>
                <div class="mt-6">
                    <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest">Total Products</p>
                    <h3 class="text-3xl font-bold text-neutral-800 dark:text-white tracking-tight mt-1">{{$totalProduct}}</h3>
                </div>
                <div class="mt-6 w-full h-1.5 bg-neutral-100 dark:bg-neutral-800 rounded-full overflow-hidden">
                    <div class="h-full bg-amber-500 w-[45%] group-hover:w-[48%] transition-all duration-1000 shadow-[0_0_8px_rgba(245,158,11,0.4)]"></div>
                </div>
            </div>

            <!-- Customers Card -->
            <div
                class="glass p-6 rounded-2xl group hover:border-violet-500/30 transition-all duration-500 hover:shadow-2xl hover:shadow-violet-500/5 relative overflow-hidden">
                <div class="absolute -top-4 -right-4 w-24 h-24 bg-violet-500/5 rounded-full blur-2xl group-hover:bg-violet-500/10 transition-colors"></div>
                <div class="flex items-center justify-between">
                    <div class="p-3 bg-violet-100 dark:bg-violet-500/10 rounded-xl">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold text-violet-600 bg-violet-50 px-2 py-1 rounded-lg">+18%</span>
                </div>
                <div class="mt-6">
                    <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest">Total Customers</p>
                    <h3 class="text-3xl font-bold text-neutral-800 dark:text-white tracking-tight mt-1">{{ $totalCustomers }}</h3>
                </div>
                <div class="mt-6 w-full h-1.5 bg-neutral-100 dark:bg-neutral-800 rounded-full overflow-hidden">
                    <div class="h-full bg-violet-500 w-[78%] group-hover:w-[82%] transition-all duration-1000 shadow-[0_0_8px_rgba(139,92,246,0.4)]"></div>
                </div>
            </div>
        </div>

        <!-- Revenue Row -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Sales Statistics -->
            <div class="lg:col-span-8 glass p-6 sm:p-8 rounded-3xl min-h-[400px]">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold text-neutral-800 dark:text-white">Sales Statistics</h3>
                        <p class="text-[10px] text-neutral-400 dark:text-neutral-500 uppercase tracking-widest mt-1">Yearly Overview</p>
                    </div>
                </div>

                <!-- CSS Chart Visual -->
                <div class="flex items-end justify-between h-56 mt-12 px-2 space-x-1.5 sm:space-x-4">
                    @php $months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG']; $heights = [60, 45, 85, 70, 40, 92, 55, 75]; @endphp
                    @foreach($months as $index => $month)
                    <div class="flex flex-col items-center flex-1 space-y-4">
                        <div class="w-full bg-black/5 dark:bg-neutral-800/50 rounded-xl relative h-40 group">
                            <div class="absolute bottom-0 w-full bg-primary-500 rounded-xl shadow-[0_0_15px_rgba(34,197,94,0.2)] transition-all duration-700 group-hover:bg-primary-600" style="height: {{ $heights[$index] }}%"></div>
                        </div>
                        <span class="text-[10px] font-bold text-neutral-400">{{ $month }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Revenue Channels -->
            <div class="lg:col-span-4 glass p-6 sm:p-8 rounded-3xl">
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-neutral-800 dark:text-white">Sales Channels</h3>
                    <p class="text-[10px] text-neutral-400 uppercase tracking-widest mt-1">Traffic Source</p>
                </div>
                <div class="space-y-6">
                    @php 
                        $channels = [
                            ['name' => 'Direct', 'perc' => 60, 'color' => 'bg-primary-500'],
                            ['name' => 'Social', 'perc' => 25, 'color' => 'bg-[#3c50e0]'],
                            ['name' => 'Referral', 'perc' => 10, 'color' => 'bg-amber-500'],
                            ['name' => 'Other', 'perc' => 5, 'color' => 'bg-neutral-400']
                        ]; 
                    @endphp
                    @foreach($channels as $channel)
                    <div class="space-y-2">
                        <div class="flex justify-between text-[11px] font-bold">
                            <span class="text-neutral-500">{{ $channel['name'] }}</span>
                            <span class="text-neutral-800 dark:text-white">{{ $channel['perc'] }}%</span>
                        </div>
                        <div class="w-full h-2 bg-black/5 dark:bg-neutral-800/50 rounded-full overflow-hidden">
                            <div class="h-full {{ $channel['color'] }}" style="width: {{ $channel['perc'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-8 pt-8 border-t border-black/5 dark:border-white/5">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-neutral-800 dark:text-white">2.4k</p>
                            <p class="text-[10px] text-neutral-400 uppercase font-bold">Visits</p>
                        </div>
                        <div class="text-center border-l border-black/5 dark:border-white/5">
                            <p class="text-2xl font-bold text-neutral-800 dark:text-white">12%</p>
                            <p class="text-[10px] text-neutral-400 uppercase font-bold">Growth</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Top Products -->
            <div class="lg:col-span-2 glass rounded-3xl overflow-hidden shadow-sm">
                <div class="px-8 py-6 border-b border-black/5 dark:border-white/5 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-neutral-800 dark:text-white">Top Products</h3>
                    <button class="text-primary-600 text-xs font-bold uppercase tracking-widest hover:underline">View Report</button>
                </div>
                <div class="p-4 sm:p-8 space-y-6">
                    @php 
                        $topProducts = [
                            ['name' => 'Octahedron Gaming Mouse', 'category' => 'Electronics', 'sales' => 852, 'revenue' => '$24,512', 'growth' => '+12%', 'image' => 'https://ui-avatars.com/api/?name=OM&background=f0fdf4&color=16a34a'],
                            ['name' => 'Glassmorphic Keyboard', 'category' => 'Accessories', 'sales' => 642, 'revenue' => '$18,240', 'growth' => '+8%', 'image' => 'https://ui-avatars.com/api/?name=GK&background=eff6ff&color=2563eb'],
                            ['name' => 'Minimalist Desk Mat', 'category' => 'Office', 'sales' => 421, 'revenue' => '$4,200', 'growth' => '+15%', 'image' => 'https://ui-avatars.com/api/?name=DM&background=fff7ed&color=d97706'],
                        ]; 
                    @endphp
                    @foreach($topProducts as $product)
                    <div class="flex items-center justify-between group cursor-pointer">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $product['image'] }}" class="w-12 h-12 rounded-xl group-hover:scale-105 transition-transform">
                            <div>
                                <h4 class="text-sm font-bold text-neutral-800 dark:text-white">{{ $product['name'] }}</h4>
                                <p class="text-xs text-neutral-400 font-medium">{{ $product['category'] }}</p>
                            </div>
                        </div>
                        <div class="text-right flex items-center space-x-8">
                            <div class="hidden sm:block">
                                <p class="text-xs font-bold text-neutral-800 dark:text-white">{{ $product['sales'] }}</p>
                                <p class="text-[10px] text-neutral-400 uppercase font-bold">Sales</p>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-primary-500">{{ $product['revenue'] }}</p>
                                <p class="text-[10px] text-emerald-500 font-bold uppercase">{{ $product['growth'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Regional Sales -->
            <div class="glass p-8 rounded-3xl">
                <h3 class="text-xl font-bold text-neutral-800 dark:text-white mb-6">Regional Sales</h3>
                <div class="space-y-6">
                    @php 
                        $regions = [
                            ['name' => 'United States', 'val' => '$45k', 'perc' => 65],
                            ['name' => 'Europe', 'val' => '$28k', 'perc' => 45],
                            ['name' => 'Asia', 'val' => '$32k', 'perc' => 55],
                            ['name' => 'Others', 'val' => '$12k', 'perc' => 25],
                        ]; 
                    @endphp
                    @foreach($regions as $region)
                    <div class="space-y-2">
                        <div class="flex justify-between text-[11px] font-bold">
                            <span class="text-neutral-500 uppercase tracking-widest">{{ $region['name'] }}</span>
                            <span class="text-neutral-800 dark:text-white">{{ $region['val'] }}</span>
                        </div>
                        <div class="w-full h-1.5 bg-black/5 dark:bg-neutral-800/50 rounded-full overflow-hidden">
                            <div class="h-full bg-primary-500" style="width: {{ $region['perc'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="glass rounded-3xl overflow-hidden border-transparent dark:border-white/5 shadow-sm">
            <div class="px-6 sm:px-8 py-6 flex items-center justify-between border-b border-black/5 dark:border-white/5">
                <h3 class="text-lg sm:text-xl font-bold text-neutral-800 dark:text-white">Recent Orders</h3>
                <a href="#" class="text-[10px] font-bold text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors uppercase tracking-widest">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] uppercase tracking-widest text-neutral-500 bg-neutral-50 dark:bg-white/[0.02]">
                            <th class="px-8 py-5 font-bold">Order ID</th>
                            <th class="px-8 py-5 font-bold">Customer</th>
                            <th class="px-8 py-5 font-bold">Status</th>
                            <th class="px-8 py-5 font-bold">Total</th>
                            <th class="px-8 py-5 font-bold text-right">Date</th>
                        </tr>
                    </thead>
                    <!-- <tbody class="divide-y divide-black/5 dark:divide-white/5 text-xs sm:text-sm">
                        <tr class="hover:bg-primary-50 dark:hover:bg-white/[0.02] transition-colors group cursor-pointer">
                            <td class="px-8 py-5 font-mono text-neutral-500 dark:text-neutral-400">#ORD-25841</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center text-[10px] font-bold mr-3 text-primary-500">JD</span>
                                    <span class="text-neutral-700 dark:text-neutral-300 font-semibold">John Doe</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 text-[10px] font-bold uppercase tracking-wider">Completed</span>
                            </td>
                            <td class="px-8 py-5 text-neutral-800 dark:text-white font-bold">$245.00</td>
                            <td class="px-8 py-5 text-neutral-400 dark:text-neutral-500 text-right">Oct 24, 2026</td>
                        </tr>
                        <tr class="hover:bg-black/[0.02] dark:hover:bg-white/[0.02] transition-colors group cursor-pointer">
                            <td class="px-8 py-5 font-mono text-neutral-500 dark:text-neutral-400">#ORD-25842</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center text-[10px] font-bold mr-3 text-blue-600">AS</span>
                                    <span class="text-neutral-700 dark:text-neutral-300 font-semibold">Alice Smith</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 border border-blue-100 text-[10px] font-bold uppercase tracking-wider">Processing</span>
                            </td>
                            <td class="px-8 py-5 text-neutral-800 dark:text-white font-bold">$89.50</td>
                            <td class="px-8 py-5 text-neutral-400 dark:text-neutral-500 text-right">Oct 25, 2026</td>
                        </tr>
                        <tr class="hover:bg-black/[0.02] dark:hover:bg-white/[0.02] transition-colors group cursor-pointer">
                            <td class="px-8 py-5 font-mono text-neutral-500 dark:text-neutral-400">#ORD-25843</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-rose-50 dark:bg-rose-500/10 flex items-center justify-center text-[10px] font-bold mr-3 text-rose-600">BK</span>
                                    <span class="text-neutral-700 dark:text-neutral-300 font-semibold">Brian King</span>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 rounded-full bg-rose-50 text-rose-600 border border-rose-100 text-[10px] font-bold uppercase tracking-wider">Cancelled</span>
                            </td>
                            <td class="px-8 py-5 text-neutral-800 dark:text-white font-bold">$1,250.00</td>
                            <td class="px-8 py-5 text-neutral-400 dark:text-neutral-500 text-right">Oct 25, 2026</td>
                        </tr>
                    </tbody> -->
                    <tbody class="divide-y divide-black/5 dark:divide-white/5 text-xs sm:text-sm">
                        @foreach($recentOrders as $order)
                            <tr class="hover:bg-primary-50 dark:hover:bg-white/[0.02] transition-colors group cursor-pointer">
                                {{-- Order ID --}}
                                <td class="px-8 py-5 font-mono text-neutral-500 dark:text-neutral-400">
                                    #ORD-{{ $order->id }}
                                </td>

                                {{-- Customer --}}
                                <td class="px-8 py-5">
                                    <div class="flex items-center">
                                        <span class="w-8 h-8 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center text-[10px] font-bold mr-3 text-primary-500">
                                            {{ strtoupper(substr($order->user->name ?? 'G', 0, 2)) }}
                                        </span>
                                        <span class="text-neutral-700 dark:text-neutral-300 font-semibold">
                                            {{ $order->user->name ?? 'Guest' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                        @if($order->status === 'completed')
                                            bg-emerald-50 text-emerald-600 border border-emerald-100
                                        @elseif($order->status === 'processing')
                                            bg-blue-50 text-blue-600 border border-blue-100
                                        @elseif($order->status === 'cancelled')
                                            bg-rose-50 text-rose-600 border border-rose-100
                                        @else
                                            bg-neutral-100 text-neutral-600 border border-neutral-200
                                        @endif
                                    ">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                {{-- Total --}}
                                <td class="px-8 py-5 text-neutral-800 dark:text-white font-bold">
                                    ₹ {{ number_format($order->total_amount, 2) }}
                                </td>

                                {{-- Date --}}
                                <td class="px-8 py-5 text-neutral-400 dark:text-neutral-500 text-right">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
