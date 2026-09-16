<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Form extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel.form';
    }
}
