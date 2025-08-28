<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Sentry extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sentry';
    }
}
