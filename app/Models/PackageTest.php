<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageTest extends Model
{
	protected $fillable = ['package_id', 'test_id', 'status'];

	public function package(): BelongsTo
	{
		return $this->belongsTo(Package::class);
	}
    //
    public function test(): BelongsTo
	{
		return $this->belongsTo(Test::class);
	}
    //
}
