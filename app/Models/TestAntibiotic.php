<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestAntibiotic extends Model
{
   protected $fillable = ['name'];

    /**
     * Get the parent that owns the category.
     */

    public function tests(): BelongsToMany
    {
    	return $this->belongsToMany(Test::class);
    }

    public function test_antibiotic_results(): HasMany 
    {
    	return $this->hasMany(TestAntibioticResult::class);
    }
}
