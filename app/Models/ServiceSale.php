<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceSale extends Model
{
	protected $fillable = ['service_id', 'service_name','amount', 'invoice_id' ];
    //


public function invoice(): BelongsTo
{
    return $this->belongsTo(Invoice::class);
}

public function service(): BelongsTo
{
	return $this->belongsTo(Service::class);
}

}
