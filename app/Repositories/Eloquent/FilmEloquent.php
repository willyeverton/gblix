<?php

namespace App\Repositories\Eloquent;

use App\Models\Film;
use App\Repositories\Interfaces\FilmInterface;

class FilmEloquent implements FilmInterface
{
    private $model;

    public function __construct(Film $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save($films)
    {
        return $this->model->updateOrCreate(
            ['_id' => $films['_id']],
            $films
        );
    }
}
