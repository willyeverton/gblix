<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseService
{
    protected function jsonResponse($data = null, string $status = 'SUCCESS') : JsonResponse
    {
        if(empty($data) || is_string($data)) {
            $data = $this->setMessage($data);
        }
        $code = $status == 'ERROR' ? Response::HTTP_BAD_REQUEST : Response::HTTP_OK;

        return response()->json([
            'status' => $status,
            'data'   => $data
        ], $code);
    }

    private function setMessage(string $message = null): object
    {
        $data = new \stdClass();
        $data->message = [$message ?? 'Nenhum registro encontrado'];
        return $data;
    }

    protected function csvResponse($data)
    {

    }

    protected function htmlResponse($data)
    {

    }
}
