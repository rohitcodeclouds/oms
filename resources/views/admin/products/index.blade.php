@extends('layouts.admin')

@section('title', 'Products')

@section('content')


    <div class="relative min-h-[80vh]">
        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-neutral-800 dark:text-white tracking-tight">Products</h1>
                <p class="text-neutral-500 mt-1 text-sm">Manage your inventory and product visibility.</p>

                <nav
                    class="flex text-neutral-400 text-[10px] sm:text-xs font-bold uppercase tracking-widest space-x-2 items-center mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-500 transition-colors">Dashboard</a>
                    <svg class="w-3 h-3 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-neutral-800 dark:text-white font-bold">Products</span>
                </nav>
            </div>

            <a href="{{ route('products.create') }}"
                class="bg-primary-500 text-white px-6 py-3 rounded-2xl text-sm font-bold hover:bg-primary-600 hover:scale-[1.02] transition-all shadow-lg shadow-primary-500/25 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
            </a>
        </div>

        <!-- Stats Overview (Optional UI addition for consistency) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="glass p-4 rounded-2xl border-white/20 dark:border-white/5 flex items-center space-x-4">
                <div class="p-3 bg-primary-100 dark:bg-primary-500/10 rounded-xl">
                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest leading-none">Total Items</p>
                    <h4 class="text-xl font-bold dark:text-white mt-1">{{$products->total()}}</h4>
                </div>
            </div>
            <div class="glass p-4 rounded-2xl border-white/20 dark:border-white/5 flex items-center space-x-4">
                <div class="p-3 bg-emerald-100 dark:bg-emerald-500/10 rounded-xl">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest leading-none">Active</p>
                    <h4 class="text-xl font-bold dark:text-white mt-1">{{$active_product_count}}</h4>
                </div>
            </div>
            <div class="glass p-4 rounded-2xl border-white/20 dark:border-white/5 flex items-center space-x-4">
                <div class="p-3 bg-rose-100 dark:bg-rose-500/10 rounded-xl">
                    <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-neutral-400 uppercase tracking-widest leading-none">Out of Stock
                    </p>
                    <h4 class="text-xl font-bold dark:text-white mt-1">{{$product_outofstock}}</h4>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="glass rounded-3xl overflow-hidden border-white/20 dark:border-white/5 shadow-2xl relative z-10">
            <!-- Search & Filter Controls -->
            <div
                class="p-6 border-b border-black/5 dark:border-white/5 flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative w-full md:w-80 group">
                    <span
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400 group-focus-within:text-primary-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" id="live-search" placeholder="Search products..."
                        class="w-full bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-xl py-2.5 pl-11 pr-4 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white placeholder:text-neutral-400">
                    <!-- Backend Note: Implement real-time search or form submission here -->
                </div>

                <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    {{-- Category Filter --}}
                    <select
                        class="bg-black/5 dark:bg-white/5 border border-transparent py-2.5 px-4 rounded-xl text-xs font-bold text-neutral-500 outline-none focus:ring-2 focus:ring-primary-500/20 dark:text-neutral-400 cursor-pointer">
                        <option value="">All Categories</option>
                        <option value="electronics">Electronics</option>
                        <option value="accessories">Accessories</option>
                        <option value="gaming">Gaming Gear</option>
                    </select>

                    {{-- Status Filter --}}
                    <select
                        class="bg-black/5 dark:bg-white/5 border border-transparent py-2.5 px-4 rounded-xl text-xs font-bold text-neutral-500 outline-none focus:ring-2 focus:ring-primary-500/20 dark:text-neutral-400 cursor-pointer">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>

                    <button class="p-2.5 text-neutral-400 hover:text-primary-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Scrollable Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="text-[10px] uppercase tracking-widest text-neutral-500 bg-neutral-50/50 dark:bg-white/[0.02] border-b border-black/5 dark:border-white/5">
                            <th class="px-8 py-5 font-bold"><a href="{{ sort_url('product_name') }}">Product Name</a></th>
                            <th class="px-8 py-5 font-bold">SKU</th>
                            <th class="px-8 py-5 font-bold"><a href="{{ sort_url('category_id') }}">Category</a></th>
                            <th class="px-8 py-5 font-bold"><a href="{{ sort_url('price') }}">Price</a></th>
                            <th class="px-8 py-5 font-bold"><a href="{{ sort_url('stock') }}">Stock</a></th>
                            <th class="px-8 py-5 font-bold"><a href="{{ sort_url('is_active ') }}">Status</a></th>
                            <th class="px-8 py-5 font-bold"><a href="{{ sort_url('created_at') }}">Created Date</a></th>
                            <th class="px-8 py-5 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-black/5 dark:divide-white/5 text-xs sm:text-sm">
                        <!-- Dynamic Product 1 -->
                         @foreach($products as $prod)
                        <tr class="hover:bg-primary-50 dark:hover:bg-white/[0.02] transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="w-10 h-10 rounded-xl glass p-0.5 border-primary-500/10 group-hover:scale-110 transition-transform">
                                        <img src="https://ui-avatars.com/api/?name=OM&background=eff6ff&color=3c50e0"
                                            class="w-full h-full rounded-[8px]" alt="Product">
                                    </div>
                                    <div>
                                        <p class="font-bold text-neutral-800 dark:text-white group-hover:text-primary-500 transition-colors"> {{$prod->product_name}} </p>
                                        <p class="text-[10px] text-neutral-400 font-medium">Ultra Gaming Edition</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5 font-mono text-neutral-500 dark:text-neutral-400">{{$prod->sku}}</td>
                            <td class="px-8 py-5">
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase">{{$prod->category->name}}</span>
                            </td>
                            <td class="px-8 py-5 text-neutral-800 dark:text-white font-bold">{{$prod->price}}</td>
                            <td class="px-8 py-5">
                                <div class="flex flex-col">
                                    <span class="font-bold text-neutral-800 dark:text-white">{{$prod->stock}}</span>
                                    <div
                                        class="w-16 h-1 bg-neutral-100 dark:bg-neutral-800 rounded-full mt-1.5 overflow-hidden">
                                        <div class="h-full bg-emerald-500 w-[65%] shadow-[0_0_8px_rgba(16,185,129,0.3)]">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <span
                                    class="px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20 text-[10px] font-bold uppercase tracking-wider">
                                        @if($prod->is_active == 1)
                                            {{'Active'}}
                                        @else
                                            {{'Inactive'}}
                                        @endif
                                    </span>
                            </td>
                            <td class="px-8 py-5 text-neutral-400 dark:text-neutral-500">{{ $prod->created_at->format('d M, Y') }}</td>
                            <td class="px-8 py-5 text-right">
                                <div
                                    class="flex items-center justify-end space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button title="View"
                                        class="p-2 text-neutral-400 hover:text-primary-500 hover:bg-primary-50 dark:hover:bg-primary-500/10 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                    <a href="{{route('products.edit', $prod->id)}}">
                                        <button title="Edit" class="p-2 text-neutral-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </a>

                                    <form action="{{ route('products.destroy', $prod->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button title="Delete"
                                            class="p-2 text-neutral-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-lg transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                        </form>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Dummy Pagination (Laravel Style Table Footer) -->
            <!--<div class="px-8 py-6 border-t border-black/5 dark:border-white/5 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs font-bold text-neutral-400">Showing <span
                        class="text-neutral-800 dark:text-white">{{$products->firstItem()}}</span> to <span
                        class="text-neutral-800 dark:text-white">{{$products->lastItem()}}</span> of <span
                        class="text-neutral-800 dark:text-white">{{$products->total()}}</span> products</p>

                <div class="flex items-center space-x-1">
                    <button
                        class="p-2 rounded-xl bg-black/5 dark:bg-white/5 text-neutral-400 hover:text-primary-500 transition-all cursor-not-allowed"
                        disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button
                        class="w-8 h-8 rounded-xl bg-primary-500 text-white text-xs font-bold shadow-lg shadow-primary-500/20">1</button>
                    <button
                        class="w-8 h-8 rounded-xl hover:bg-black/5 dark:hover:bg-white/5 text-neutral-500 dark:text-neutral-400 text-xs font-bold transition-all">2</button>
                    <button
                        class="w-8 h-8 rounded-xl hover:bg-black/5 dark:hover:bg-white/5 text-neutral-500 dark:text-neutral-400 text-xs font-bold transition-all">3</button>
                    <span class="text-neutral-400 text-xs px-2">...</span>
                    <button
                        class="w-8 h-8 rounded-xl hover:bg-black/5 dark:hover:bg-white/5 text-neutral-500 dark:text-neutral-400 text-xs font-bold transition-all">125</button>
                    <button
                        class="p-2 rounded-xl bg-black/5 dark:bg-white/5 text-neutral-400 hover:text-primary-500 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    
                </div>
                
                {{-- Backend Note: Replace with {!! $products->links() !!} for dynamic pagination --}}
            </div>
-->
            {{-- Pagination --}}
            <div class="px-8 py-6 border-t border-black/5 dark:border-white/5"> {{ $products->links() }} </div>
        </div>

        <!-- Floating Background Decorative Elements -->
        <div class="fixed inset-0 pointer-events-none -z-5 overflow-hidden">
            <div class="absolute top-[20%] -left-12 w-64 h-64 opacity-20 dark:opacity-30 animate-float">
                <div
                    class="w-full h-full bg-gradient-to-br from-primary-500/20 to-blue-600/20 rounded-[3rem] rotate-12 blur-3xl">
                </div>
            </div>
            <div class="absolute bottom-[10%] -right-12 w-96 h-96 opacity-20 dark:opacity-30 animate-float-delayed">
                <div class="w-full h-full bg-gradient-to-tr from-violet-500/20 to-emerald-600/20 rounded-full blur-[100px]">
                </div>
            </div>
        </div>
    </div>

    {{--
    // Backend Integration Notes:
    // 1. Loop through products using @foreach($products as $product)
    // 2. Use $product->name, $product->sku, etc.
    // 3. For pagination: {{ $products->links() }}
    // 4. For search/filter: use request query params
    --}}

    <script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('live-search');
    let debounceTimer;

    searchInput.addEventListener('keyup', function () {

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {

            fetch(`{{ route('products.index') }}?search=${searchInput.value}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                console.log('html', html);
                document.getElementById('product-table').outerHTML = html;
            });

        }, 300); // 300ms debounce

    });

});
</script>
@endsection