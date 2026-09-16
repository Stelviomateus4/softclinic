<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestReference extends Model
{
    protected $fillable = ['name', 'unit', 'range', 'parent_id'];

    /**
     * Get the parent that owns the category.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(TestReference::class, 'parent_id');
    }
     /**
     * Get the children category that related the category.
     */
    public function children(): HasMany
    {
        return $this->hasMany(TestReference::class, 'parent_id');
    }

    public function test(): BelongsToMany
    {
    	return $this->belongsToMany(Test::class);
    }

    public function test_reference_results(): HasMany
    {
        return $this->hasMany(TestReferenceResult::class);
    }
}
