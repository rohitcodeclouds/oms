@extends('layouts.store')

@section('title', 'Shopping Cart - OMS Store')

@section('content')
    <div class="bg-gray-50 dark:bg-gray-950 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-8">Shopping Cart</h1>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
                    <!-- Cart Items -->
                    <div class="lg:col-span-8">
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm overflow-hidden border border-gray-100 dark:border-gray-800">
                            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-800">
                                @foreach($cart as $id => $details)
                                    <li class="p-6 flex items-center" id="cart-item-{{ $id }}">
                                        <div class="flex-shrink-0 w-24 h-24 bg-gray-200 rounded-xl overflow-hidden">
                                            @if($details['image'])
                                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}"
                                                    class="w-full h-full object-center object-cover">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($details['name']) }}&background=F3F4F6&color=3c50e0&size=200"
                                                    alt="{{ $details['name'] }}" class="w-full h-full object-center object-cover">
                                            @endif
                                        </div>

                                        <div class="ml-6 flex-1 flex flex-col">
                                            <div class="flex justify-between items-start">
                                                <h4 class="text-sm">
                                                    <a href="{{ route('shop.show', $id) }}"
                                                        class="font-bold text-gray-900 dark:text-white hover:text-primary-600 transition-colors">
                                                        {{ $details['name'] }}
                                                    </a>
                                                </h4>
                                                <p class="text-sm font-extrabold text-gray-900 dark:text-white">
                                                    ${{ number_format($details['price'], 2) }}</p>
                                            </div>

                                            <div class="mt-4 flex items-center justify-between">
                                                <div
                                                    class="flex items-center border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden h-8">
                                                    <button @click="updateQuantity({{ $id }}, -1)"
                                                        class="px-2 py-1 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M20 12H4"></path>
                                                        </svg>
                                                    </button>
                                                    <input type="number" id="qty-{{ $id }}" value="{{ $details['quantity'] }}"
                                                        readonly
                                                        class="w-12 text-center text-xs font-bold bg-white dark:bg-gray-900 focus:outline-none">
                                                    <button @click="updateQuantity({{ $id }}, 1)"
                                                        class="px-2 py-1 bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 4v16m8-8H4"></path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div class="flex items-center space-x-4">
                                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total:
                                                        $<span
                                                            id="item-total-{{ $id }}">{{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                                    </p>
                                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-xs font-bold text-red-600 hover:text-red-700 uppercase tracking-widest">Remove</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="mt-16 lg:mt-0 lg:col-span-4">
                        <div
                            class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-8 sticky top-24">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 uppercase tracking-widest">Order
                                Summary</h2>

                            <div class="flow-root">
                                <dl class="-my-4 text-sm divide-y divide-gray-200 dark:divide-gray-800">
                                    <div class="py-4 flex items-center justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Subtotal</dt>
                                        <dd class="font-bold text-gray-900 dark:text-white">$<span
                                                id="cart-subtotal">{{ number_format($total, 2) }}</span></dd>
                                    </div>
                                    <div class="py-4 flex items-center justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Shipping Estimate</dt>
                                        <dd class="font-bold text-gray-900 dark:text-white">$0.00</dd>
                                    </div>
                                    <div class="py-4 flex items-center justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Tax Estimate</dt>
                                        <dd class="font-bold text-gray-900 dark:text-white">$0.00</dd>
                                    </div>
                                    <div class="py-4 flex items-center justify-between">
                                        <dt class="text-base font-extrabold text-gray-900 dark:text-white">Order Total</dt>
                                        <dd class="text-base font-extrabold text-primary-600">$<span
                                                id="cart-total">{{ number_format($total, 2) }}</span></dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="mt-8">
                                <a href="{{ route('checkout.index') }}"
                                    class="w-full bg-primary-600 text-white px-6 py-4 rounded-xl font-bold flex items-center justify-center hover:bg-primary-700 transition-colors shadow-lg">
                                    Proceed to Checkout
                                </a>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('shop.index') }}"
                                    class="w-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 px-6 py-4 rounded-xl font-bold flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors uppercase tracking-widest text-xs">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div
                    class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-12 text-center">
                    <div
                        class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Your cart is empty</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-8">Ready to start shopping? Browse our collection and find
                        something you love!</p>
                    <a href="{{ route('shop.index') }}"
                        class="inline-flex items-center px-8 py-4 border border-transparent text-base font-medium rounded-xl text-white bg-primary-600 hover:bg-primary-700 shadow-lg transition-colors">
                        Explore Products
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateQuantity(id, change) {
            const input = document.getElementById('qty-' + id);
            let newQty = parseInt(input.value) + change;

            if (newQty < 1) return;

            fetch(`{{ url('/cart/update') }}/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: newQty })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        toastr.error(data.error);
                    } else {
                        input.value = newQty;
                        document.getElementById('item-total-' + id).innerText = data.itemTotal;
                        document.getElementById('cart-subtotal').innerText = data.cartTotal;
                        document.getElementById('cart-total').innerText = data.cartTotal;
                        // Update layout cart count
                        const cartCounter = document.querySelector('[x-text="cartCount"]');
                        if (cartCounter) cartCounter.innerText = data.count;
                        toastr.success(data.success);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('Something went wrong!');
                });
        }
    </script>
@endsection