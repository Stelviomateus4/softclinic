<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestExamination extends Model
{
	protected $fillable = ['test_id', 'macroscopics', 'microscopics'];

	public function test(): BelongsTo
	{
		return $this->belongsTo(Test::class);

	}
	public function macroscopic()
	{
		return unserialize($this->macroscopics);
	}
	public function microscopic()
	{
		return unserialize($this->microscopics);
	}
    //
}
