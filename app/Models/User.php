<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
