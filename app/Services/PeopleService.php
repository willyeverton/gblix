<?php

namespace App\Services;

use App\Repositories\Interfaces\PeopleInterface;
use Illuminate\Http\Request;

class PeopleService extends ResponseService
{
    private $people;

    public function __construct(PeopleInterface $people)
    {
        $this->people = $people;
    }

    public function index(Request $request)
    {
        try {
            switch ($this->getAccept($request)) {
                case 'html':
                    return view('api',
                        ['data' => $this->all()]
                    );
                case 'json':
                    return $this->jsonResponse(
                        $this->all()
                    );
                case 'csv':
                    return $this->csvResponse();

                default :
                    return $this->jsonResponse(
                        'The fmt parameter or the header accept type is not one of the options: html, json, csv',
                        'ERROR'
                    );
            }

        } catch (\Throwable $th) {
            return $this->jsonResponse($th->getMessage(), 'ERROR');
        }
    }

    private function getAccept($request)
    {
        $type = $request->get('fmt') ?? $request->getAcceptableContentTypes()[0];

        $type = explode('/', $type);

        return isset($type[1]) ? $type[1] : $type[0];
    }

    public function all() {
        $peoples = $this->people->all();
        $result = array();

        if($peoples->count()) {
            $key = 0;

            foreach($peoples as $people) {
                $this->getData($people, $result, $key);
            }
        }
        return $result;
    }

    private function getData($people, &$result, &$key)
    {
        $peopleFilms = $people->peopleFilm()->get();

        if($peopleFilms->count()) {
            foreach ($peopleFilms as $peopleFilm) {

                $film = $peopleFilm->film()->first();

                $result[$key]['name'] = $people['name'];
                $result[$key]['age']  = $people['age'];

                $result[$key]['title']        = $film['title'];
                $result[$key]['release_date'] = $film['release_date'];
                $result[$key]['rt_score']     = $film['rt_score'];

                $key++;
            }
        }
        return $result;
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
