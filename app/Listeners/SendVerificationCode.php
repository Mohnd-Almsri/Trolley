<?php

namespace App\Listeners;

use App\Events\VerificationCode;
use HTTP_Request2;
use HTTP_Request2_Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Traits\SendCodeTrait;
class SendVerificationCode
{
    use SendCodeTrait;

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
//        $user =[];
//        $user["firstName"]=$event->user->firstName;
//        $user["lastName"]=$event->user->lastName;
//        $user["phone"]=$event->user->phoneNumber;
        $message = "Your verification code is $event->code";

       $this->sendCode($event->user,$message);
    }
}
