<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PeopleService;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    private $service;

    public function __construct(PeopleService $peopleService)
    {
        $this->service = $peopleService;
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

}
