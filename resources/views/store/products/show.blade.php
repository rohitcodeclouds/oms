@extends('layouts.store')

@section('title', $product->product_name . ' - OMS Store')

@section('content')
    <div class="bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
                <!-- Image Gallery -->
                <div class="flex flex-col-reverse"
                    x-data="{ activeImage: '{{ $product->images->count() > 0 ? asset('storage/' . $product->images->first()->image_path) : 'https://ui-avatars.com/api/?name=' . urlencode($product->product_name) . '&background=F3F4F6&color=3c50e0&size=1024' }}' }">
                    <!-- Image selector -->
                    @if($product->images->count() > 1)
                        <div class="mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                            <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                                @foreach($product->images as $image)
                                    <button @click="activeImage = '{{ asset('storage/' . $image->image_path) }}'" type="button"
                                        class="relative h-24 bg-white dark:bg-gray-800 rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4 focus:ring-primary-500 overflow-hidden border-2"
                                        :class="activeImage === '{{ asset('storage/' . $image->image_path) }}' ? 'border-primary-500' : 'border-transparent'">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt=""
                                            class="w-full h-full object-center object-cover">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div
                        class="w-full aspect-w-1 aspect-h-1 bg-gray-200 dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm">
                        <img :src="activeImage" alt="{{ $product->product_name }}"
                            class="w-full h-full object-center object-cover transition-opacity duration-300">
                    </div>
                </div>

                <!-- Product info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <nav aria-label="Breadcrumb">
                        <ol role="list"
                            class="flex items-center space-x-2 text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">
                            <li><a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">Store</a>
                            </li>
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            <li><a href="{{ route('shop.index', ['category' => $product->category_id]) }}"
                                    class="hover:text-primary-600 transition-colors">{{ $product->category->category_name ?? 'Products' }}</a>
                            </li>
                        </ol>
                    </nav>

                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        {{ $product->product_name }}
                    </h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl font-extrabold text-primary-600">${{ number_format($product->price, 2) }}</p>
                    </div>

                    <!-- Stock check -->
                    <div class="mt-4 flex items-center">
                        @if($product->stock > 0)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                                In Stock ({{ $product->stock }} units)
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400">
                                Out of Stock
                            </span>
                        @endif
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="text-base text-gray-700 dark:text-gray-300 space-y-6">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>

                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <div class="w-32">
                                <label for="quantity" class="sr-only">Quantity</label>
                                <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->stock }}"
                                    value="1"
                                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-all"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            </div>
                            <button type="submit"
                                class="flex-1 bg-primary-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-primary-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                            </button>
                        </div>
                    </form>

                    <section aria-labelledby="details-heading" class="mt-12">
                        <h3 id="details-heading"
                            class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-widest border-b border-gray-200 dark:border-gray-700 pb-2">
                            Product Specifications</h3>
                        <div class="mt-4 space-y-4">
                            <div class="flex justify-between text-sm py-2 border-b border-gray-100 dark:border-gray-800">
                                <span class="text-gray-500 dark:text-gray-400">SKU</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-gray-100 uppercase">{{ $product->sku ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between text-sm py-2 border-b border-gray-100 dark:border-gray-800">
                                <span class="text-gray-500 dark:text-gray-400">Weight</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-gray-100">{{ $product->weight ? $product->weight . ' kg' : 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between text-sm py-2 border-b border-gray-100 dark:border-gray-800">
                                <span class="text-gray-500 dark:text-gray-400">Dimensions</span>
                                <span
                                    class="font-medium text-gray-900 dark:text-gray-100">{{ $product->dimension ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Related products -->
            @if($relatedProducts->count() > 0)
                <section aria-labelledby="related-heading" class="mt-24">
                    <h2 id="related-heading" class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        Customers also bought</h2>
                    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        @foreach($relatedProducts as $related)
                            <div class="group relative flex flex-col">
                                <div
                                    class="relative w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-2xl overflow-hidden group-hover:opacity-85 transition-opacity duration-300 font-bold">
                                    @if($related->images->count() > 0)
                                        <img src="{{ asset('storage/' . $related->images->first()->image_path) }}"
                                            alt="{{ $related->product_name }}" class="w-full h-full object-center object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($related->product_name) }}&background=F3F4F6&color=3c50e0&size=512"
                                            alt="{{ $related->product_name }}" class="w-full h-full object-center object-cover">
                                    @endif
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">
                                            <a href="{{ route('shop.show', $related) }}">
                                                <span aria-hidden="true" class="absolute inset-0"></span>
                                                {{ $related->product_name }}
                                            </a>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $related->category->category_name ?? 'Products' }}
                                        </p>
                                    </div>
                                    <p class="text-sm font-extrabold text-primary-600">${{ number_format($related->price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
@endsection