<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Ghibli extends Facade
{
    protected static function getFacadeAccessor() {
        return 'ghibli';
    }
}
