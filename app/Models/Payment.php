<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'method',
        'amount',
        'status',
        'transaction_id',
        'paid_at',
    ]; 

    
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
