<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function (){
        return response()->json([
            'message'   => 'Welcome Admin',
        ]);
    });
});

// Route::middleware('auth:sanctum')->post('/orders', [OrderController::class, 'store']);
// Route::middleware('auth:sanctum')->post('/orders/{order}/pay', [PaymentController::class, 'store']);