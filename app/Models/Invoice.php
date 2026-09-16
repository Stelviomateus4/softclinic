<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id', 'invoice_no', 'comment', 'payment_type', 'sub_total',
        'tax_amount', 'total_amount', 'discount', 'user_id', 'status', 'cash',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function serviceSales(): HasMany
    {
        return $this->hasMany(ServiceSale::class);
    }

    public function opd_sales(): HasMany
    {
        return $this->hasMany(OpdSales::class);
    }

    public function doctor_referred(): HasMany
    {
        return $this->hasMany(DoctorReferred::class);
    }

    public function packageSales(): HasOne
    {
        return $this->hasOne(PackageSale::class);
    }

    public function invoiceReturns(): HasMany
    {
        return $this->hasMany(InvoiceReturn::class);
    }
}
