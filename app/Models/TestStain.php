<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestStain extends Model
{
    protected $fillable = ['test_id', 'test_names'];

    public function test(): BelongsTo
    {
    	return $this->belongsTo(Test::class);
    }

    public function test_name()
    {
    	return unserialize($this->test_names);
    }


}
