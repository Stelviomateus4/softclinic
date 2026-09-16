<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    
    
	protected $fillable = ['name', 'amount', 'department_id'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function tests(): HasMany
    {
    	return $this->hasMany(Test::class);
    }

    public function service_sales(): HasMany
    {
        return $this->hasMany(ServiceSale::class);
    }

    
    //
}
