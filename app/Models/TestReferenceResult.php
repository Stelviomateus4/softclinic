<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestReferenceResult extends Model
{
    protected $fillable = ['test_report_id', 'test_reference_id', 'result', 'flag'];

    public function test_report(): BelongsTo
    {
    	return $this->belongsTo(TestReport::class);
    }

    public function test_reference(): BelongsTo
    {
    	return $this->belongsTo(TestReference::class);
    }
}
