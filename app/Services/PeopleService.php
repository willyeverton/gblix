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

            $data = $this->setParams($request, $this->all());

            switch ($this->getAccept($request)) {
                case 'html':
                    return view('api',
                        ['data' => $data]
                    );
                case 'json':
                    return $this->jsonResponse(
                        $data
                    );
                case 'csv':
                    return $this->csvResponse($data);

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

    private function setParams($request, $data)
    {
        $filter = $request->get('filter');
        $sort   = $request->get('sort');
        $order  = $request->get('order');

        if (!empty($filter)) {
            $data = $this->filter($data, $filter);
        }
        if (!empty($order)) {
            $data = $this->orderBy($data, $order, $sort);
        }
        return $data;
    }

    private function filter($data, $filter)
    {
        $filter = str_replace('_', ' ', $filter);
        $filter = str_replace('+', ' ', $filter);

        $result = array();
        $filter = preg_quote($filter, '~');

        foreach ($data as $key => $row) {

            if(preg_grep("~$filter~", $row)){
                $result[] = $data[$key];
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

    private function prepareData($person)
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

    private $key;
    private function orderBy($array, $key, $sort)
    {
        $sort = empty($sort) ? 'asc' : $sort;
        $key = strtolower($key);
        $this->key = $key;

        $this->validateParams($sort);

        if($sort == 'asc') {
            usort($array, function ($a, $b) {
                return $a[$this->key] > $b[$this->key];
            });
        } else { // desc
            usort($array, function ($a, $b) {
                return $a[$this->key] < $b[$this->key];
            });
        }

        return $array;
    }

    private function validateParams($sort)
    {
        $columns = [
            'name',
            'age',
            'title',
            'release_date',
            'rt_score',
        ];

        if(!in_array($this->key, $columns)) {
            throw new \Exception("'$this->key' is not a valid column!  Valid columns: '" . implode("', '", $columns) . "'");
        }

        if($sort != 'asc' && $sort != 'desc') {
            throw new \Exception("'$sort' is not a valid sort!  Valid sorts: 'asc', 'desc'.");
        }
    }
}
