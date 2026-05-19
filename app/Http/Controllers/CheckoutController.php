<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\OrderCreationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class CheckoutController extends Controller
{
    protected $orderService;

    public function __construct(OrderCreationService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('store.checkout', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:20',
            'billing_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        // Format items for OrderCreationService
        $items = [];
        foreach ($cart as $id => $details) {
            $items[] = [
                'product_id' => $id,
                'quantity' => $details['quantity']
            ];
        }

        $shippingAddress = "{$request->shipping_name}\n{$request->shipping_address}\n{$request->shipping_city}, {$request->shipping_zip}";
        $billingAddress = $request->billing_address;

        try {
            $order = $this->orderService->createOrder(
                Auth::user(),
                $items,
                $shippingAddress,
                $billingAddress
            );

            // Clear Cart
            session()->forget('cart');

            return redirect()->route('thank-you', $order)->with('success', 'Order placed successfully!');

        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    public function thankYou(Order $order)
    {
        // Security check: ensure the user owns the order
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('store.thankyou', compact('order'));
    }
}
