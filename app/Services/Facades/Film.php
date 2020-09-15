<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Film extends Facade
{
    protected static function getFacadeAccessor() {
        return 'film';
    }
}
