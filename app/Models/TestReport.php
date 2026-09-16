<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TestReport extends Model
{
	protected $fillable = ['report_id', 'test_id', 'sample', 'status', 'report_type'];

	public function report(): BelongsTo
	{
		return $this->belongsTo(Report::class);
	}

	public function test(): BelongsTo
	{
		return $this->belongsTo(Test::class);
	}

	public function test_result(): HasOne
	{
		return $this->hasOne(TestResult::class);
	}

	public function test_reference_results(): HasMany
	{
		return $this->hasMany(TestReferenceResult::class);
	}

	public function test_antibiotic_results(): HasMany
	{
		return $this->hasMany(TestAntibioticResult::class);
	}

	public function examination_result(): HasOne
	{
		return $this->hasOne(ExaminationResult::class);
	}
    //
}
