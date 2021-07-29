<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendMessage 
{


    public function sendMessage($request, $token)
    {
        $recipients = $request['recipients'];
        $responses = [];
        foreach ($recipients as $recipient) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->post(env('URL_API').'messages', [
                "channelId" => $request['channelId'],
                "recipient" => $recipient,
                "content" => $request['content']
            ]);

            $responses[] = $response->json();
        }
        return $responses;
    }

  
}
