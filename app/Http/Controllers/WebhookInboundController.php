<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebhookInboundController extends Controller
{
public function WpInbound(Request $request)
{
    // Log::info($request->all());

    $requestData =  $request->all();
    Log::info($requestData['conversations'][0]);
    $response = Http::asForm()->post('http://suitewsp.test/SuiteCRMWSP/index.php?entryPoint=DT_Whatsapp_Inbound', [
        'data' => $requestData['conversations'][0],
        // 'role' => 'Network Administrator',
    ]);
//    dd($response->json());
}
}
