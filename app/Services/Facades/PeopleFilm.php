<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class PeopleFilm extends Facade
{
    protected static function getFacadeAccessor() {
        return 'peoplefilm';
    }
}
