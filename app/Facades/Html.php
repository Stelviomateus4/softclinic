<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Html extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel.html';
    }
}
