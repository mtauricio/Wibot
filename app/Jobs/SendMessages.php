<?php

namespace App\Jobs;

use App\Services\SendMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // private SendMessage $sendMessage;
    protected $token;
    protected $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $token)
    {
        // $this->sendMessage = $sendMessage;
        $this->request = $request;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SendMessage $sendMessage)
    {
        $request = $this->request;
        $response = $sendMessage->sendMessage($request, $this->token);
        Log::info(json_encode($response));
        return $response;
    }
}
