<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Token 
{

    public function getToken()
    {
        $response = Http::post(env('URL_API').'login', [
            'appId' => env('WB_APP_ID'),
            'appSecret' => env('WB_SECRET_PASSWORD'),
        ]);
        return $response['token'];
    }

  
}
