<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceReturn extends Model
{
	protected $fillable = ['invoice_id', 'return_amount', 'user_id', 'status', 'return_reason'];
    //

    public function invoice(): BelongsTo
    { 
    	return $this->belongsTo(Invoice::class);

    }

     public function user(): BelongsTo
    { 
    	return $this->belongsTo(User::class);

    }
}
