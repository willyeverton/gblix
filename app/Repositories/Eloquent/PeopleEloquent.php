<?php

namespace App\Repositories\Eloquent;

use App\Models\People;
use App\Repositories\Interfaces\PeopleInterface;

class PeopleEloquent implements PeopleInterface
{
    private $model;

    public function __construct(People $people)
    {
        $this->model = $people;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save($people)
    {
        return $this->model->updateOrCreate(
            ['_id' => $people['_id']],
            $people
        );
    }
}
