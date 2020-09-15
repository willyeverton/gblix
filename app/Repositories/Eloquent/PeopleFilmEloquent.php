<?php

namespace App\Repositories\Eloquent;

use App\Models\PeopleFilm;
use App\Repositories\Interfaces\PeopleFilmInterface;

class PeopleFilmEloquent implements PeopleFilmInterface
{
    private $model;

    public function __construct(PeopleFilm $model)
    {
        $this->model = $model;
    }

    public function all() {
        return $this->model->all();
    }

    public function save(array $people) {

        return $this->model->updateOrCreate($people);
    }
}
