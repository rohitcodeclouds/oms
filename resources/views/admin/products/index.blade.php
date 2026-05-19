@extends('layouts.admin')

@section('title', 'Products')

@section('content')


    <div class="relative min-h-[80vh]">
        <!-- Page Header & Breadcrumb -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-neutral-800 dark:text-white tracking-tight">Products</h1>
                <p class="text-neutral-500 mt-1 text-sm">Manage your inventory and product visibility.</p>

                <nav
                    class="flex text-neutral-400 text-[10px] sm:text-xs font-bold uppercase tracking-widest space-x-2 items-center mt-4">
                    <a href="{{ route('dashboard') }}" class="hover:text-primary-500 transition-colors">Dashboard</a>
                    <svg class="w-3 h-3 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-neutral-800 dark:text-white font-bold">Products</span>
                </nav>
            </div>

            <a href="{{ route('products.create') }}"
                class="w-full sm:w-auto bg-primary-500 text-white px-6 py-3 rounded-2xl text-sm font-bold hover:bg-primary-600 hover:scale-[1.02] transition-all shadow-lg shadow-primary-500/25 flex items-center justify-center">
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
                    <input type="text" id="filter-search" name="search" placeholder="Search products..."
                        value="{{ request('search') }}"
                        class="w-full bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-xl py-2.5 pl-11 pr-4 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white placeholder:text-neutral-400">
                </div>

                <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                    {{-- Category Filter --}}
                    <select id="filter-category" name="category"
                        class="bg-black/5 dark:bg-white/5 border border-transparent py-2.5 px-4 rounded-xl text-xs font-bold text-neutral-500 outline-none focus:ring-2 focus:ring-primary-500/20 dark:text-neutral-400 cursor-pointer w-full sm:w-auto">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    {{-- Status Filter --}}
                    <select id="filter-status" name="status"
                        class="bg-black/5 dark:bg-white/5 border border-transparent py-2.5 px-4 rounded-xl text-xs font-bold text-neutral-500 outline-none focus:ring-2 focus:ring-primary-500/20 dark:text-neutral-400 cursor-pointer w-full sm:w-auto">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>

                    <button id="reset-filters" class="p-2.5 text-neutral-400 hover:text-primary-500 transition-colors"
                        title="Reset Filters">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Scrollable Table Container -->
            <div id="product-table-wrapper">
                @include('admin.products.partials._table')
            </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('filter-search');
            const categorySelect = document.getElementById('filter-category');
            const statusSelect = document.getElementById('filter-status');
            const resetButton = document.getElementById('reset-filters');
            const tableWrapper = document.getElementById('product-table-wrapper');

            let debounceTimer;

            function updateFilters() {
                const search = searchInput.value;
                const category = categorySelect.value;
                const status = statusSelect.value;

                const queryParams = new URLSearchParams({
                    search: search,
                    category: category,
                    status: status
                });

                // Update URL without reloading
                const newUrl = `${window.location.pathname}?${queryParams.toString()}`;
                window.history.pushState({ path: newUrl }, '', newUrl);

                fetch(`${window.location.pathname}?${queryParams.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.text())
                    .then(html => {
                        tableWrapper.innerHTML = html;
                    })
                    .catch(error => console.error('Error fetching filtered products:', error));
            }

            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(updateFilters, 300);
            });

            categorySelect.addEventListener('change', updateFilters);
            statusSelect.addEventListener('change', updateFilters);

            resetButton.addEventListener('click', function () {
                searchInput.value = '';
                categorySelect.value = '';
                statusSelect.value = '';
                updateFilters();
            });

            // Handle pagination clicks via AJAX
            tableWrapper.addEventListener('click', function (e) {
                const link = e.target.closest('.pagination a');
                if (link) {
                    e.preventDefault();
                    const url = new URL(link.href);
                    // Ensure we keep current filter values in pagination
                    url.searchParams.set('search', searchInput.value);
                    url.searchParams.set('category', categorySelect.value);
                    url.searchParams.set('status', statusSelect.value);

                    window.history.pushState({ path: url.toString() }, '', url.toString());

                    fetch(url.toString(), {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            tableWrapper.innerHTML = html;
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        });
                }
            });
        });
    </script>
@endsection