<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{

    
	protected $fillable = 
	[
        'first_name', 'middle_name', 'last_name','email', 'age', 'phone', 'gender', 'birth_date', 'country', 'state', 'district' , 'location' , 'occupation' ,
        'description' , 'relative_name' , 'relative_phone' , 'marital_status', 'blood_group',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

     public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
    
    public function packageSales(): HasMany
    {
        return $this->hasMany(PackageSale::class);
    }
    //
}
