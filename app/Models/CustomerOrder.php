<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_address',
        'total',
        'status',
        'payment_method',
        'payment_proof',
    ];

    public function items()
    {
        return $this->hasMany(CustomerOrderItem::class);
    }
}