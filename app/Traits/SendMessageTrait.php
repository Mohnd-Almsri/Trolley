<?php

namespace App\Traits;

use App\Events\VerificationCode;
use App\Jobs\DeleteExpiredVerificationCodes;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use HTTP_Request2;
use HTTP_Request2_Exception;

trait SendMessageTrait
{
public function verifyCodegenerate($user_id){
    $code= random_int(100000, 999999);
    User::where('id','=',$user_id)->update([
        'verification_code'=>$code,
        'verification_code_expires_at'=>Carbon::now()->addMinutes(10)]);
    DeleteExpiredVerificationCodes::dispatch()->delay(now()->addMinutes(10.018));
    return $code;
}
public function sendVerificationCode($user_phone,$code){
    $message="Your verification code is $code ";
    $this->sendMessage($user_phone,$message);
}
public function sendMessage($user_phone,$message)
{

    $params = [
        'token' => 'tp5y8x1r00h7ravq',
//        'to' => $user_phone,
        'to' => "+963".substr($user_phone,-9),
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

    function formatOrderToText($order) {

        $order->load(['orderItems.product', 'user']);
        $drivers = [
            ['name' => 'Farouk Dawoud', 'phone' => '0994531807'],
            ['name' => 'Amir Alhomsi', 'phone' => '0927642319'],
            ['name' => 'Raed Alkhiat', 'phone' => '0985213648'],
            ['name' => 'Ahmed Khazaa', 'phone' => '0960327190']
        ];
        $randomDriver = $drivers[array_rand($drivers)];

        $userName = $order->user->firstName . ' ' . $order->user->lastName;

        $message = "Hello {$userName},\n";
        $message .= "Thank you for your order! Here are the details:\n\n";
        $message .= "Order ID: {$order->id}\n";
        $message .= "Total Price: \${$order->total_price}\n\n";
        $message .= "Products:\n";
        $i=1;
        foreach ($order->orderItems as $orderItem) {
            $product = $orderItem->product;
            $message .= "$i . {$product->name}  ( Quantity: {$orderItem->quantity} , Price: \${$product->price} , Total Price: \${$orderItem->total_price})\n";
            $i++;
        }
        $orderTimePlusQuarter = Carbon::parse($order->created_at)->addMinutes(15)->format('Y-m-d H:i');

        $message .= "\nEstimated Delivery Time: {$orderTimePlusQuarter}\n\n";
        $message .= "Your delivery driver: {$randomDriver['name']}\n";
        $message .= "Driver's phone: {$randomDriver['phone']}\n\n";
        $message .= "\nWe appreciate your business! Please let us know if you have any questions.\n\n";
        $message .= "Best regards,\n    *TROLLEY* ";

        return $message;
    }



}
