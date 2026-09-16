<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestAntibioticResult extends Model
{
    protected $fillable = ['test_report_id', 'test_antibiotic_id', 'result'];

    public function test_report(): BelongsTo
    {
    	return $this->belongsTo(TestReport::class);
    }

    public function test_antibiotic(): BelongsTo
    {
    	return $this->belongsTo(TestAntibiotic::class);
    }

}
