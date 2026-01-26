<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::post('/admin/orders/{order}/status', [OrderController::class, 'updateStatus']);

require __DIR__.'/auth.php';
