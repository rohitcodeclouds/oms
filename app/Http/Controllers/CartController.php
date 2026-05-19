<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('store.cart', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->product_name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->images->count() > 0 ? $product->images->first()->image_path : null
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, Product $product)
    {
        if ($request->quantity) {
            $cart = session()->get('cart');

            // Check stock
            if ($product->stock < $request->quantity) {
                return response()->json(['error' => 'Not enough stock available.'], 400);
            }

            $cart[$product->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            $itemTotal = number_format($cart[$product->id]['price'] * $cart[$product->id]['quantity'], 2);
            $cartTotal = 0;
            foreach ($cart as $item) {
                $cartTotal += $item['price'] * $item['quantity'];
            }

            return response()->json([
                'success' => 'Cart updated successfully',
                'itemTotal' => $itemTotal,
                'cartTotal' => number_format($cartTotal, 2),
                'count' => count($cart)
            ]);
        }
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart');

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
}
