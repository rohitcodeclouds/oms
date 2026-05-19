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
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $orders = $query->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'payment', 'shipment']);
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function store(Request $request, OrderCreationService $service)
    {
        $data = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string|max:500',
            'billing_address' => 'required|string|max:500',
        ]);

        $order = $service->createOrder(
            User::find(1),  //For Testing
            //auth()->user(),
            $data['items'],
            $data['shipping_address'],
            $data['billing_address']
        );

        return response()->json([
            'message' => 'Order placed successfully',
            'order_id' => $order->id
        ], 201);
    }

    public function updateStatus(Request $request, Order $order, OrderService $service)
    {
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
