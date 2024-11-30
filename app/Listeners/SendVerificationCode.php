<?php

namespace App\Listeners;

use App\Events\VerificationCode;
use HTTP_Request2;
use HTTP_Request2_Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Traits\SendMessageTrait;
class SendVerificationCode
{
    use SendMessageTrait;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VerificationCode $event)
    {

//       $this->sendMessage($event->user,$message);
    }
}
