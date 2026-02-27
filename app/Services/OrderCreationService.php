<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderCreationService
{
    public function createOrder($user, array $items, $shippingAddress, $billingAddress)
    {
        return DB::transaction(function () use ($user, $items, $shippingAddress, $billingAddress) {

            $total = 0;

            // First loop: Validate stock & calculate total
            foreach ($items as $item) {

                $product = Product::findOrFail($item['product_id']);

                if ($product->stock < $item['quantity']) {
                    throw new Exception("Insufficient stock for {$product->name}");
                }

                $total += $product->price * $item['quantity'];
            }

            // Create Order
            $order = Order::create([
                'user_id'          => $user->id,
                'total_amount'     => $total,
                'shipping_address' => $shippingAddress,
                'billing_address'  => $billingAddress,
                'status'           => Order::STATUS_PENDING,
            ]);

            // Second loop: Create Order Items & Deduct Stock
            foreach ($items as $item) {

                $product = Product::findOrFail($item['product_id']);

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $product->price,
                ]);

                // Deduct stock
                $product->decrement('stock', $item['quantity']);
            }

            return $order;
        });
    }
}