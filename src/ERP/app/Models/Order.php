<?php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * Pola, które można masowo wypełniać:
     * - jeżeli używasz order_number, dodaj je do $fillable
     */
    protected $fillable = [
        'order_number',
        'client_id',
        'order_date',
        'status',
    ];

    /**
     * Rzutowanie kolumny order_date na Carbon (typ date).
     * Dzięki temu $order->order_date jest instancją Carbon.
     */
    protected $casts = [
        'order_date' => 'date',
    ];

    /**
     * Relacja: zamówienie (Order) należy do klienta (Client).
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relacja pivotowa: zamówienie (Order) ma wiele produktów (Product).
     * Używamy tabeli order_product jako pivot. W pivot pobieramy dodatkowe pola:
     * - quantity, price_buy, price_sell.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->using(OrderProduct::class)
            ->withPivot(['quantity', 'price_buy', 'price_sell'])
            ->withTimestamps();
    }

    /**
     * Relacja: zamówienie może mieć jedną fakturę (Invoice).
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
