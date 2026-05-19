@extends('layouts.store')

@section('title', 'Checkout - OMS Store')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-950 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-8">Checkout</h1>

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
                    <!-- Checkout Forms -->
                    <div class="lg:col-span-8 space-y-8">
                        <!-- Shipping Address -->
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8">
                            <h2
                                class="text-lg font-bold text-gray-900 dark:text-white mb-6 uppercase tracking-widest flex items-center">
                                <span
                                    class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center mr-3 text-xs">1</span>
                                Shipping Information
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="shipping_name"
                                        class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Full
                                        Name</label>
                                    <input type="text" name="shipping_name" id="shipping_name"
                                        value="{{ old('shipping_name', Auth::user()->name) }}" required
                                        class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-all">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="shipping_email"
                                        class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Email
                                        Address</label>
                                    <input type="email" name="shipping_email" id="shipping_email"
                                        value="{{ old('shipping_email', Auth::user()->email) }}" required
                                        class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-all">
                                </div>

                                <div class="md:col-span-2">
                                    <label for="shipping_address"
                                        class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Street
                                        Address</label>
                                    <textarea name="shipping_address" id="shipping_address" rows="3" required
                                        class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-all">{{ old('shipping_address') }}</textarea>
                                </div>

                                <div>
                                    <label for="shipping_city"
                                        class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">City</label>
                                    <input type="text" name="shipping_city" id="shipping_city"
                                        value="{{ old('shipping_city') }}" required
                                        class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-all">
                                </div>

                                <div>
                                    <label for="shipping_zip"
                                        class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ZIP / Postal
                                        Code</label>
                                    <input type="text" name="shipping_zip" id="shipping_zip"
                                        value="{{ old('shipping_zip') }}" required
                                        class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-all">
                                </div>
                            </div>
                        </div>

                        <!-- Billing Address (Simplified) -->
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8">
                            <h2
                                class="text-lg font-bold text-gray-900 dark:text-white mb-6 uppercase tracking-widest flex items-center">
                                <span
                                    class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center mr-3 text-xs">2</span>
                                Billing Information
                            </h2>

                            <div>
                                <label for="billing_address"
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Billing
                                    Address</label>
                                <textarea name="billing_address" id="billing_address" rows="3" required
                                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl py-3 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 transition-all"
                                    placeholder="Same as shipping or enter different address">{{ old('billing_address') }}</textarea>
                            </div>
                        </div>

                        <!-- Payment (Mock Only) -->
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8">
                            <h2
                                class="text-lg font-bold text-gray-900 dark:text-white mb-6 uppercase tracking-widest flex items-center">
                                <span
                                    class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center mr-3 text-xs">3</span>
                                Payment Method
                            </h2>

                            <div class="space-y-4">
                                <label
                                    class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                                    :class="paymentMethod === 'cod' ? 'border-primary-500 ring-2 ring-primary-500/20' : 'border-gray-200 dark:border-gray-700'"
                                    x-data="{ paymentMethod: 'cod' }">
                                    <input type="radio" name="payment_method" value="cod" class="sr-only" checked
                                        @change="paymentMethod = 'cod'">
                                    <div class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded-full flex items-center justify-center mr-4"
                                        :class="paymentMethod === 'cod' ? 'border-primary-600' : ''">
                                        <div class="w-2.5 h-2.5 bg-primary-600 rounded-full"
                                            x-show="paymentMethod === 'cod'"></div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-gray-900 dark:text-white">Cash on Delivery</p>
                                        <p class="text-xs text-gray-500">Pay when your order arrives.</p>
                                    </div>
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </label>

                                <label
                                    class="relative flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-xl opacity-50 cursor-not-allowed bg-gray-50 dark:bg-gray-800/50">
                                    <input type="radio" name="payment_method" value="card" class="sr-only" disabled>
                                    <div
                                        class="w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded-full flex items-center justify-center mr-4">
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-gray-900 dark:text-white">Credit / Debit Card</p>
                                        <p class="text-xs text-gray-500">Currently unavailable.</p>
                                    </div>
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                        </path>
                                    </svg>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="mt-16 lg:mt-0 lg:col-span-4 sticky top-24">
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 uppercase tracking-widest">Order
                                Summary</h2>

                            <div class="flow-root mb-8 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                                <ul role="list" class="-my-6 divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach($cart as $id => $details)
                                        <li class="py-6 flex">
                                            <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg overflow-hidden">
                                                @if($details['image'])
                                                    <img src="{{ asset('storage/' . $details['image']) }}"
                                                        alt="{{ $details['name'] }}"
                                                        class="w-full h-full object-center object-cover">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($details['name']) }}&background=F3F4F6&color=3c50e0&size=100"
                                                        class="w-full h-full object-center object-cover">
                                                @endif
                                            </div>
                                            <div class="ml-4 flex-1 flex flex-col justify-center">
                                                <div class="flex justify-between items-start">
                                                    <h4 class="text-xs font-bold text-gray-900 dark:text-white">
                                                        {{ $details['name'] }}</h4>
                                                    <p class="text-xs font-extrabold text-gray-900 dark:text-white ml-2">
                                                        ${{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                                                </div>
                                                <p class="mt-1 text-xs text-gray-500">Qty {{ $details['quantity'] }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <dl class="space-y-4 border-t border-gray-200 dark:border-gray-800 pt-6">
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Subtotal</dt>
                                    <dd class="text-sm font-bold text-gray-900 dark:text-white">
                                        ${{ number_format($total, 2) }}</dd>
                                </div>
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">Shipping</dt>
                                    <dd class="text-sm font-bold text-green-600">FREE</dd>
                                </div>
                                <div
                                    class="flex items-center justify-between border-t border-gray-100 dark:border-gray-800 pt-4">
                                    <dt class="text-base font-extrabold text-gray-900 dark:text-white">Total</dt>
                                    <dd class="text-lg font-extrabold text-primary-600">${{ number_format($total, 2) }}</dd>
                                </div>
                            </dl>

                            <div class="mt-8">
                                <button type="submit"
                                    class="w-full bg-primary-600 text-white px-6 py-4 rounded-xl font-bold flex items-center justify-center hover:bg-primary-700 transition-colors shadow-lg">
                                    Complete Order
                                </button>
                            </div>

                            <p class="mt-4 text-[10px] text-center text-gray-500 uppercase tracking-widest leading-relaxed">
                                By completing your order, you agree to our Terms of Service and Privacy Policy.
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection