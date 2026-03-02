<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

use App\Services\ShipmentService;

class ShipmentController extends Controller
{
    public function store(Request $request, Order $order, ShipmentService $service)
    {
        $data = $request->validate([
            'address' => 'required|string',
            'carrier' => 'nullable|string'
        ]);

        $shipment = $service->createShipment($order, $data);

        return response()->json([
            'message' => 'Shipment created',
            'shipment_id' => $shipment->id
        ]);
    }

    public function deliver(Order $order, ShipmentService $service)
    {
        $service->markDelivered($order);

        return response()->json([
            'message' => 'Order delivered successfully'
        ]);
    }

}
