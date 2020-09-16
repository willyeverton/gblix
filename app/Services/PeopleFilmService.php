<?php

namespace App\Services;

use App\Repositories\Interfaces\PeopleFilmInterface;
use App\Services\Facades\Film;
use App\Services\Facades\People;

class PeopleFilmService extends ResponseService
{
    private $peopleFilm;

    public function __construct(PeopleFilmInterface $peopleFilm)
    {
        $this->peopleFilm  = $peopleFilm;
    }

    public function save($data)
    {
        try {
            $this->savePeople($data);
            $this->saveFilms($data);

            return 'Films Saved Successfully.';

        } catch (\Throwable $throwable) {
            return $throwable->getMessage();
        }
    }

    private function savePeople($data)
    {
        foreach ($data['people'] as $person) {
            foreach ($data['films'] as $film) {
                foreach ($film['people'] as $subject) {

                    $id = explode('people/', $subject)[1];
                    if($id == $person['id']) {
                        $this->create($person, $film);
                    }
                }
            }
        }
    }

    private function create($person, $film)
    {
        $person = People::save($person);
        $film   = Film::save($film);

        $this->peopleFilm->save(
            $this->prepareData($person, $film)
        );
    }

    private function saveFilms($data)
    {
        foreach ($data['films'] as $film) {
            foreach ($data['people'] as $person) {
                foreach ($person['films'] as $subject) {

                    $id = explode('films/', $subject)[1];
                    if($id == $film['id']) {
                        $this->create($person, $film);
                    }
                }
            }
        }
    }

    private function prepareData($person, $film) : array
    {
        return [
            'people_id' => $person['id'],
            'film_id'   => $film['id'],
        ];
    }
}
