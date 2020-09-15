<?php

namespace App\Repositories\Interfaces;

interface PeopleInterface
{
    public function all();

    public function save(array $data);
}
