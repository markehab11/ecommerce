<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{
    public function apiResponse($date= null, $message= null, $status=null)
    {
        $array = [
            'message'=>$message,
            'status'=>$status,
            'date'=>$date
        ];
        return response($array,$status);
    }
}
