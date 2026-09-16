<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpdSales extends Model
{
	protected $fillable = ['doctor_id', 'opd_name','invoice_id', 'doctor_fee', 'opd_charge' ,'status'] ;
    
    public function doctor(): BelongsTo
    {
    	return $this->belongsTo(Doctor::class);

    }

    public function invoice(): BelongsTo
    {
    	return $this->belongsTo(Invoice::class);
    	
    }
}
