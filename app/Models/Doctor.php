<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
	protected $fillable = 
    [
        'fee' , 'employee_id', 'opd_charge' ,
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function opd_sales(): HasMany
    {
        return $this->hasMany(OpdSales::class);
    }

     public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function doctor_referred(): HasMany
    {
         return $this->hasMany(DoctorReferred::class);
    }
    //
}
