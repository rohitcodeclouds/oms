<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductImageController;

require __DIR__ . '/auth.php';


// Route::get('/auth-debug', function () {
//     return [
//         'session_id' => session()->getId(),
//         'auth_check' => auth()->check(),
//         'user' => auth()->user(),
//     ];
// });

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/orders/{order}/status', [OrderController::class, 'updateStatus']);
    Route::resource('products', ProductController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::delete('/admin/product-images/{product_image}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
});

Route::middleware('auth')->post('/orders', [OrderController::class, 'store']);
Route::middleware('auth')->post('/orders/{order}/pay', [PaymentController::class, 'store']);
Route::middleware('auth')->group(function () {
    Route::post('/orders/{order}/ship', [ShipmentController::class, 'store']);
    Route::post('/orders/{order}/deliver', [ShipmentController::class, 'deliver']);
});
