<?php
namespace App\Services;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;
use Exception;

class ShipmentService {

    public function createShipment(Order $order, array $data) {
        if($order->status !== Order::STATUS_PROCESSING) {
            throw new Exception("Shipment not allowed for this order");
        }

        if ($order->shipment) {
            throw new Exception("Shipment already exists for this order");
        }

        return DB::transaction(function () use ($order, $data){
            $shipment = Shipment::create([
                'order_id' => $order->id,
                'address' => $data['address'],
                'status' => Shipment::STATUS_SHIPPED,
                'carrier' => $data['carrier'] ?? 'Default Carrier',
                'tracking_number' => uniqid('trk_'),
                'shipped_at' => now(),
                'delivered_at' => null,
            ]);

            $order->update(['status'=> Order::STATUS_SHIPPED]);

            return $shipment;
        });
    }

    public function markDelivered(Order $order){
        if($order->status !== Order::STATUS_SHIPPED) {
            throw new Exception("Delivery not allowed for this order");
        }

        DB::transaction(function () use ($order) {
            $order->shipment()->update([
                'status' => Shipment::STATUS_DELIVERED,
                'delivered_at' => now()
            ]);

            $order->update([
                'status' => Order::STATUS_DELIVERED,
            ]);

            return $order->refresh();
        });
        

    }
}