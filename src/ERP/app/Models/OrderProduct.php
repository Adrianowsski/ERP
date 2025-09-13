<?php
// app/Models/OrderProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    // Nazwa tabeli pivotowej
    protected $table = 'order_product';

    // Pola pivot, które możemy masowo nadpisać, jeśli trzeba
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_buy',
        'price_sell',
    ];
}
