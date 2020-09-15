<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PeopleService;

class PeopleController extends Controller
{
    private $service;

    public function __construct(PeopleService $peopleService)
    {
        $this->service = $peopleService;
    }

    public function index()
    {
        return $this->service->index();
    }

}
