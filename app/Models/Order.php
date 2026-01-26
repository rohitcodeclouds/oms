<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Shipment;

class Order extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';
    
    protected $fillable = [
        'user_id',
        'total_amount',
        'shipping_address',
        'billing_address',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public function shipment() {
        return $this->hasOne(Shipment::class);
    }
}
