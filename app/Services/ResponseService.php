<?php

namespace App\Services;

use App\Exports\PopleFilmExport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class ResponseService
{
    protected function jsonResponse($data, $status = 'SUCCESS') : JsonResponse
    {
        $code = $status == 'ERROR' ? Response::HTTP_BAD_REQUEST : Response::HTTP_OK;

        return response()->json([
            'status' => $status,
            'data'   => $data
        ], $code);
    }

    protected function csvResponse($data)
    {
        return Excel::download(new PopleFilmExport($data), 'films.csv');
    }
}
