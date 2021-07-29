<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessages;
use App\Services\SendMessage;
use App\Services\Token;
use Illuminate\Http\Request;

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
        $request = $request->all(); 
        $token = $this->token->getToken();
       if ($request['allow_massive'] == false) {
            $result = SendMessages::dispatch($request, $token);
       }else {
        $array = array_chunk($request['recipients'], 2);
        foreach ($array as $key) {
            $request['recipients'] = $key;
            $result = SendMessages::dispatch($request, $token);
        }
       }
    return $result;
    }
}
