@extends('layouts.store')

@section('title', 'Welcome to OMS Store')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-white dark:bg-gray-900 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div
                class="relative z-10 pb-8 bg-white dark:bg-gray-900 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1
                            class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Premium Products for</span>
                            <span class="block text-primary-600 xl:inline">Modern Living</span>
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-500 dark:text-gray-400 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Discover our curated collection of high-quality items designed to elevate your lifestyle. From
                            tech essentials to home decor, we have it all.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('shop.index') }}"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 md:py-4 md:text-lg md:px-10">
                                    Shop Now
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#featured"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary-700 bg-primary-100 hover:bg-primary-200 md:py-4 md:text-lg md:px-10">
                                    Featured
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                src="{{ asset('images/banner.png') }}"
                alt="Ecommerce Hero">
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-gray-50 dark:bg-gray-950 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Shop by Category</h2>
            <div class="mt-6 grid grid-cols-2 gap-y-10 gap-x-6 sm:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">
                @foreach($categories as $category)
                    <a href="{{ route('shop.index', ['category' => $category->id]) }}"
                        class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="aspect-w-1 aspect-h-1 rounded-t-xl bg-gray-200 overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($category->category_name) }}&background=E5E7EB&color=3c50e0&size=512"
                                alt="{{ $category->category_name }}"
                                class="w-full h-full object-center object-cover group-hover:opacity-75 transition-opacity">
                        </div>
                        <div class="p-4 flex justify-between items-center">
                            <h3 class="text-sm font-bold text-gray-700 dark:text-gray-200">
                                {{ $category->category_name }}
                            </h3>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div id="featured" class="bg-white dark:bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Featured Products</h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Our most popular and newest additions.</p>
                </div>
                <a href="{{ route('shop.index') }}"
                    class="text-primary-600 hover:text-primary-700 font-bold text-sm flex items-center">
                    View All
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-y-12 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($featuredProducts as $product)
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

                            <!-- Quick Add Button -->
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
                            <div>
                                <h3 class="text-sm font-bold text-gray-900 dark:text-white">
                                    <a href="{{ route('shop.show', $product) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product->product_name }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $product->category->category_name ?? 'Uncategorized' }}
                                </p>
                            </div>
                            <p class="text-sm font-extrabold text-primary-600">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Newsletter / CTA Section -->
    <div class="bg-primary-600 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                Join the OMS Community
            </h2>
            <p class="mt-4 text-lg text-primary-100 max-w-2xl mx-auto">
                Subscribe to get deals, new arrival alerts, and styling tips straight to your inbox.
            </p>
            <form class="mt-8 flex flex-col sm:flex-row justify-center max-w-md mx-auto">
                <input type="email" placeholder="Enter your email"
                    class="w-full px-5 py-3 rounded-l-md sm:rounded-l-lg border-2 border-transparent focus:ring-0 focus:border-white text-gray-900">
                <button type="submit"
                    class="mt-3 sm:mt-0 sm:ml-0 bg-gray-900 text-white px-6 py-3 rounded-r-md sm:rounded-r-lg font-bold hover:bg-gray-800 transition-colors">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
@endsection