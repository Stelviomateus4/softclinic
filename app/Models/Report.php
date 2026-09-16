<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
	protected $fillable = ['patient_id','report','result','status', 'doctor_id'];
    //
    public function patient(): BelongsTo
    {
    	return $this->belongsTo(Patient::class);
    }

    public function test_reports(): HasMany
    {
        return $this->hasMany(TestReport::class);
    }
}
