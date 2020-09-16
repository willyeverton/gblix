<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static get()
 */
class Ghibli extends Facade
{
    protected static function getFacadeAccessor() {
        return 'ghibli';
    }
}
