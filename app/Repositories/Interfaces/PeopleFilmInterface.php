<?php

namespace App\Repositories\Interfaces;

interface PeopleFilmInterface
{
    public function all();

    public function save(array $data);
}
