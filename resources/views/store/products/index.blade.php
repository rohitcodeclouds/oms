@extends('layouts.store')

@section('title', 'Shop - OMS Store')

@section('content')
    <div class="bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Our Products</h1>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Showing {{ $products->firstItem() ?? 0 }} to
                        {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
                    </p>
                </div>

                <!-- Filters -->
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                    <form action="{{ route('shop.index') }}" method="GET" class="flex">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
                            class="px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-l-lg focus:ring-primary-500 focus:border-primary-500 bg-white dark:bg-gray-800 text-sm">
                        <button type="submit"
                            class="bg-primary-600 text-white px-4 py-2 rounded-r-lg hover:bg-primary-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                    </form>

                    <div class="relative inline-block text-left" x-data="{ open: false }">
                        <button @click="open = !open" type="button"
                            class="inline-flex justify-center w-full rounded-lg border border-gray-300 dark:border-gray-700 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none">
                            Category: {{ $categories->firstWhere('id', request('category'))->category_name ?? 'All' }}
                            <svg class="-mr-1 ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-20 overflow-hidden border border-gray-100 dark:border-gray-700">
                            <div class="py-1">
                                <a href="{{ route('shop.index', ['search' => request('search')]) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 {{ !request('category') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : '' }}">All
                                    Categories</a>
                                @foreach($categories as $category)
                                    <a href="{{ route('shop.index', ['category' => $category->id, 'search' => request('search')]) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('category') == $category->id ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : '' }}">
                                        {{ $category->category_name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-y-12 gap-x-6 sm:grid-cols-2 lg:grid-cols-4">
                @forelse($products as $product)
                    <div class="group relative flex flex-col">
                        <div
                            class="relative w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-2xl overflow-hidden group-hover:opacity-85 transition-opacity duration-300">
                            @if($product->images->count() > 0)
                                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->product_name }}" class="w-full h-full object-center object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($product->product_name) }}&background=F3F4F6&color=3c50e0&size=512"
                                    alt="{{ $product->product_name }}" class="w-full h-full object-center object-cover">
                            @endif

                            <form action="{{ route('cart.add', $product) }}" method="POST"
                                class="absolute bottom-4 left-4 right-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-white/90 backdrop-blur-sm text-gray-900 py-2 rounded-xl text-sm font-bold shadow-lg hover:bg-white transition-colors">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                        <div class="mt-4 flex justify-between items-start">
                            <div class="min-w-0 flex-1">
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white truncate">
                                    <a href="{{ route('shop.show', $product) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product->product_name }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $product->category->category_name ?? 'Uncategorized' }}
                                </p>
                            </div>
                            <p class="ml-2 text-sm font-extrabold text-primary-600">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No products found</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your filters or search criteria.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('shop.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                                Clear all filters
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection