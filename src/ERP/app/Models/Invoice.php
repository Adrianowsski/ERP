<?php
// app/Models/Invoice.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    /**
     * Pola do masowego przypisania:
     */
    protected $fillable = [
        'order_id',
        'invoice_number',
        'issue_date',
        'due_date',
        'total',
    ];

    /**
     * Rzutowanie kolumn issue_date oraz due_date na Carbon.
     */
    protected $casts = [
        'issue_date' => 'date',
        'due_date'   => 'date',
    ];

    /**
     * Relacja: faktura (Invoice) należy do zamówienia (Order).
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
