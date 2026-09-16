<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExaminationResult extends Model
{
     protected $fillable = ['test_report_id', 'macroscopic_result', 'microscopic_result','result'];

     public function test_report(): BelongsTo
     {
     	return $this->belongsTo(TestReport::class);
     }
}
