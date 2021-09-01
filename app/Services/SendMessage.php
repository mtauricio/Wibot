<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendMessage 
{


    public function sendMessages($request, $token)
    {
        $recipients = $request['recipients'];
        $responses = [];
        Log::info($recipients);
        foreach ($recipients as $recipient) {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->post(env('URL_API').'messages', [
                "channelId" => $request['channelId'],
                "recipient" => $recipient->mobile_number,
                "content" => $recipient->message
            ]);

            $responses['resWhatsapp'] = $response->json();
            $responses['request'] = $request;
            $delay = rand(3, 10);
            sleep($delay);
        }
        return $responses;
    }

  
}
