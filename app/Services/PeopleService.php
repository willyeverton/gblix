<?php

namespace App\Services;

use App\Repositories\Interfaces\PeopleInterface;
use App\Services\Facades\People;

class PeopleService extends ResponseService
{
    private $people;

    public function __construct(PeopleInterface $people)
    {
        $this->people = $people;
    }

    public function index()
    {
        try {
            $peoples = $this->people->all();

            if($peoples->count()) {
                foreach($peoples as $key => $people) {
                    $sales[$key]['films'] = $this->getFilms($people);
                }
            }
            return $this->jsonResponse($peoples);
            /*
                - Nome do Personagem
                - Idade do Personagem
                - Título do Filme
                - Ano de Lançamento do Filme
                - Pontuação Rotten Tomato
            */

        } catch (\Throwable $th) {
            return $this->jsonResponse($th->getMessage(), 'ERROR');
        }
    }

    private function getFilms(People $people) : array
    {
        $peopleFilms = $people->peopleFilm()->get();
        $films = [];

        if($peopleFilms->count()) {
            foreach ($peopleFilms as $peopleFilm) {
                $films[] = $peopleFilm->film()->get();
            }
        }
        return $films;
    }

    public function save($person)
    {
        return $this->people->save(
            $this->prepareData($person)
        );
    }

    private function prepareData($person) : array
    {
        return [
            '_id'        => $person['id'],
            'name'       => $person['name'],
            'gender'     => $person['gender'],
            'age'        => $person['age'],
            'eye_color'  => $person['eye_color'],
            'hair_color' => $person['hair_color'],
        ];
    }
}
