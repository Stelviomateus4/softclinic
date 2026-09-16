<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
	protected $fillable = 
	[
        'name', 'description', 'time', 'patient_id', 'doctor_id', 'status', 'appointment_date'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
    //
}
