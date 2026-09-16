<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    

	protected $fillable = 
	[
        'first_name', 'middle_name', 'last_name','email', 'education', 'phone', 'description', 'certificate', 'speciality', 'address', 'working_day' , 'in_time' , 'out_time' ,
        'type' , 'department_id'
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function doctor(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
   
    //
}
