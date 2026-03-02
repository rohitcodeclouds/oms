<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Shipment extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';
    
    protected $fillable = [
        'order_id',
        'address',
        'status',
        'carrier',
        'tracking_number',
        'shipped_at',
        'delivered_at'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
