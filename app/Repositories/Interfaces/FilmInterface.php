<?php

namespace App\Repositories\Interfaces;

interface FilmInterface
{
    public function all();

    public function save(array $data);
}
