<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    

	protected $fillable = ['name'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
    
     public function labs(): HasMany
    {
        return $this->hasMany(Lab::class);
    }
    //
}
