<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
	protected $fillable = ['name', 'description', 'price'];

	public function packageSales(): HasMany
	{
		return $this->hasMany(PackageSale::class);
	}

	public function packageTests(): HasMany
	{
		return $this->hasMany(PackageTest::class);
	}
    //
}
