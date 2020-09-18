<?php

namespace App\Services;


use App\Repositories\Interfaces\FilmInterface;

class FilmService
{
    private $repository;

    public function __construct(FilmInterface $repository)
    {
        $this->repository = $repository;
    }

    public function save($film)
    {
        return $this->repository->save(
            $this->prepareData($film)
        );
    }

    private function prepareData($film)
    {
        return [
            '_id'          => $film['id'],
            'rt_score'     => $film['rt_score'],
            'producer'     => $film['producer'],
            'description'  => $film['description'],
            'title'        => $film['title'],
            'director'     => $film['director'],
            'release_date' => $film['release_date'],
        ];
    }
}
