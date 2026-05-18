<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'category',
        'barcode',
        'stock',
        'price',
        'cost_price',
        'expired_date',
        'image',
    ];
}