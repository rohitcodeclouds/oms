<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\OrderCreationService;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    

    public function store(Request $request, OrderCreationService $service)
    {
        $data = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string|max:500',
            'billing_address'  => 'required|string|max:500',
        ]);

        $order = $service->createOrder(
            //User::find(1),  //For Testing
            auth()->user(),
            $data['items'],
            $data['shipping_address'],
            $data['billing_address']
        );

        return response()->json([
            'message' => 'Order placed successfully',
            'order_id' => $order->id
        ], 201);
    }

    public function updateStatus(Request $request, Order $order, OrderService $service) {
        $request->validate([
            'status' => 'required|string'
        ]);

        match ($request->status) {
            'processing' => $service->markAsProcessing($order),
            'shipped' => $service->markAsShipped($order),
            'delivered' => $service->markAsDelivered($order),
            'cancelled' => $service->cancel($order),
            default => abort(400, 'Invalid status')
        };
        return back()->with('success', 'Order status updated');
    }
}
