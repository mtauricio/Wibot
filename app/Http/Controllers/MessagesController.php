<?php

namespace App\Http\Controllers;

use App\Jobs\SendBulkMessages;
use App\Services\SendMessage;
use App\Services\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessagesController extends Controller
{

    private Token $token;
    private SendMessage $sendMessage;
    
    /**
     * MessagesController constructor.
     * @param Token $token
     */
    public function __construct(Token $token, SendMessage $sendMessage)
    {
        $this->token = $token;
        $this->sendMessage = $sendMessage;
    }
    public function sendMessages(Request $request)
    {
        Log::info($request->all());
        Log::info("controllador");
        // return json_encode($request->all());
        $request = $request->all(); 
        $request['recipients'] = json_decode($request['recipients']);
        $token = $this->token->getToken();
       if ($request['allow_massive'] == false) {
        $request['recipients'] = [$request['recipients']];
        $result = $this->sendMessage->sendMessages($request, $token);
            // $result = SendMessages::dispatch($request, $token);
       }else {
        $array = array_chunk($request['recipients'], 2);
        foreach ($array as $key) {
            $request['recipients'] = $key;
            // $result = $this->sendMessage->sendMessages($request, $token);
            $result = SendBulkMessages::dispatch($request, $token );
        }
       }
    
    return $result;
    }
}
