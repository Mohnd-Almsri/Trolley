<?php

namespace App\Listeners;

use App\Events\VerificationCode;
use HTTP_Request2;
use HTTP_Request2_Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationCode
{
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

        $randomNumber = random_int(100000, 999999);
        $message = "Your verification code is $randomNumber";
        \App\Models\VerificationCode::create([
            'user_id' => $event->user->id,
            'code' => $randomNumber,
        ]);
        $params = [
            'token' => 'tp5y8x1r00h7ravq',
            'to' => $event->user->phoneNumber,
            'body' => $message
        ];

        $request = new HTTP_Request2();

        $request->setUrl('https://api.ultramsg.com/instance100514/messages/chat');
        $request->setMethod(HTTP_Request2::METHOD_POST);
        $request->setConfig([
            'follow_redirects' => true
        ]);
        $request->setHeader([
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);
        $request->addPostParameter($params);

        try {
            $response = $request->send();
            if ($response->getStatus() == 200) {
                return response()->json([
                    'success' => true,
                    'data' => $response->getBody()
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Unexpected HTTP status: ' . $response->getStatus() . ' ' . $response->getReasonPhrase()
                ]);
            }
        } catch (HTTP_Request2_Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
