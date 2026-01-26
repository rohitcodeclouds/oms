<php

namespace App\Services;

use App\Models\Order;
use Exception;

class OrderService {

    public function markAsProcessing(){
        if($order->status !== Order::STATUS_PENDING){
            throw new Exception('Order cannot be process');
        }

        $order->update([
            'status' => Order::STATUS_PROCESSING
        ]);
    }

    public function markAsShipped(){
        if($order->status !== Order::STATUS_PROCESSING) {
            throw new Exception('Order cannot be shipped');
        }

        $order->update([
            'status' => Order::STATUS_SHIPPED
        ]);

    }

    public function markAsDelivered() {
        if($order->status !== Order::STATUS_SHIPPED) {
            throw new Exception('Order cannot be delivered');
        }

        $order->update([
            'status' => Order::STATUS_DELIVERED
        ])
    }

    public function cancel(){
        if(in_array($order->status, [
            Order::STATUS_PENDING,
            Order::STATUS_PROCESSING
        ])) {
            throw new Exception('Order cannot be cancelled')
        }

        $order->update([
            'status' => Order::STATUS_CANCELLED
        ]);

    }

}