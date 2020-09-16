<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static save($get)
 */
class PeopleFilm extends Facade
{
    protected static function getFacadeAccessor() {
        return 'peoplefilm';
    }
}
