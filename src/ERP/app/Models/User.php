<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function registrationCodes()
    {
        return $this->hasMany(RegistrationCode::class, 'created_by');
    }

    /**
     * Helper, z którego korzysta nasza bramka Gate (“admin-only”).
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
