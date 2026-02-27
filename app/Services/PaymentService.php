<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Exception;

class PaymentService
{
    public function processPayment(Order $order, array $data)
    {
        if ($order->status !== Order::STATUS_PENDING) {
            throw new Exception('Payment not allowed for this order');
        }

        return DB::transaction(function () use ($order, $data) {

            $payment = Payment::create([
                'order_id' => $order->id,
                'method' => $data['method'],
                'amount' => $order->total_amount,
                'status' => 'paid',
                'transaction_id' => uniqid('txn_'),
                'paid_at' => now(),
            ]);

            $order->update([
                'status' => Order::STATUS_PROCESSING
            ]);

            return $payment;
        });
    }
}