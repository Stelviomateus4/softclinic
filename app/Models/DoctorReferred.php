<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorReferred extends Model
{
    protected $fillable = ['doctor_id', 'invoice_id'];

    public function doctor(): BelongsTo
    {
    	return $this->belongsTo(Doctor::class);
    }

     public function invoice(): BelongsTo
    {
    	return $this->belongsTo(Invoice::class);
    }
}
