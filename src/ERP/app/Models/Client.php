<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'nip', 'email', 'phone', 'address',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
