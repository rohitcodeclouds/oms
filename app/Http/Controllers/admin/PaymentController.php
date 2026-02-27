<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function store(Request $request, Order $order, PaymentService $service)
    {
        $data = $request->validate([
            'method' => 'required|string'
        ]);

        $payment = $service->processPayment($order, $data);

        return response()->json([
            'message' => 'Payment successful',
            'payment_id' => $payment->id
        ]);
    }
}
