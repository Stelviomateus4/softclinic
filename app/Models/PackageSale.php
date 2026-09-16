<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageSale extends Model
{
	protected $fillable = ['package_id', 'invoice_id', 'package_price', 'patient_id'];

	public function package(): BelongsTo
	{
		return $this->belongsTo(Package::class);
	}
    //
    public function invoice(): BelongsTo
	{
		return $this->belongsTo(Invoice::class);
	}

	public function patient(): BelongsTo
	{
		return $this->belongsTo(Patient::class);
	}
    //
}
