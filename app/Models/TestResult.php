<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestResult extends Model
{
	protected $fillable = ['test_report_id', 'result', 'status'];
	

	public function test_report(): BelongsTo
	{
		return $this->belongsTo(TestReport::class);
	}
	
    //
}
