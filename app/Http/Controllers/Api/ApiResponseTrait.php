<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{

    public function apiResponse($data = null, $massege = null, $status = null)
    {

        $array = [
            'data' => $data,
            'massege' => $massege,
            'status' => $status,
        ];
        return response($array, $status);
    }
}
