<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Test extends Model
{
	protected $fillable = ['name', 'service_id', 'report_type', 'description'];
    //
    public function service(): BelongsTo
	{
		return $this->belongsTo(Service::class);
	}

	public function test_references(): BelongsToMany
	{
		return $this->belongsToMany(TestReference::class);
	}

	public function test_reports(): HasMany
	{
		return $this->hasMany(TestReport::class);
	}

	public function test_examination(): HasOne
	{
		return $this->hasOne(TestExamination::class);
	}

	public function test_antibiotics(): BelongsToMany
	{
		return $this->belongsToMany(TestAntibiotic::class);
	}

	public function test_stain(): HasOne
	{
		return $this->hasOne(TestStain::class);
	}

	public function test_results(): HasMany
	{
		return $this->hasMany(TestResult::class);
	}


	
}
