<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;

class GhibliService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://ghibliapi.herokuapp.com']);
    }

    public function get() : array
    {
        try {
            $promises = [
                'people' => $this->client->getAsync('/people'),
                'films' => $this->client->getAsync('/films'),
            ];
            $responses = Promise\unwrap($promises);

            if ($responses['people']->getStatusCode() == 200 && $responses['films']->getStatusCode() == 200) {

                $responses['people'] = json_decode($responses['people']->getBody(), true);
                $responses['films'] = json_decode($responses['films']->getBody(), true);
                return $responses;
            }
            return array();

        } catch (\Throwable $throwable) {
            return [$throwable->getMessage()];
        }
    }
}
