<?php

namespace App\Traits;

use App\Events\VerificationCode;
use HTTP_Request2;
use HTTP_Request2_Exception;

trait SendMessageTrait
{
public function verifyCode($user){
    $code= random_int(100000, 999999);
    \App\Models\VerificationCode::create([
        'user_id' => $user->id,
        'code' => $code,
        'type' => 'verify'
    ]);
   return $code;
}
public function sendMessage($user,$message)
{

    $params = [
        'token' => 'tp5y8x1r00h7ravq',
        'to' => $user->phoneNumber,
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

public function VerificationMessage($code)
{
    return "Your verification code is $code .";

}

}
