<?php

namespace App\Traits;

trait Response{
    /**
     * Generate failed response
     */
    public function response($data = NULL, $message = NULL, $code = 200){
        $response = [];
        if($message) $response['message'] = $message;
        if($data) $response['data'] = $data;

        return response()->json($response, $code);
    }
}