<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Models\Order;

class OrderController extends Controller
{
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
