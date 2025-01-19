<?php

namespace App\Traits;

use App\Events\VerificationCode;
use App\Jobs\DeleteExpiredVerificationCodes;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use HTTP_Request2;
use HTTP_Request2_Exception;
use Illuminate\Support\Facades\Auth;

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
    $message = "🔒 *Your Verification Code:* \n\n";
    $message .= "--------------------------------\n";
    $message .= "📩 *$code*\n\n";
    $message .= "*Please use this code to verify your account. The code will expire in 10 minutes.*\n";
    $message .= "If you didn't request this, please ignore this message.\n";
    $message .= "--------------------------------\n";
    $message .= "Thank you for choosing us! 😊";
    $this->sendMessage($user_phone,$message);
}

    public function sendPasswordCode($user_phone,$code){
        $message = "🔐 *Password Reset Request* \n\n";
        $message .= "📩 *Your Reset Password Code:* \n\n";
        $message .= "--------------------------------\n";
        $message .= "*$code*\n\n";
        $message .= "*Please use this code to reset your password. The code will expire in 10 minutes.*\n\n";
        $message .= "*If you didn't request this, please ignore this message.*\n";
        $message .= "--------------------------------\n";
        $message .= "Thank you for trusting us! 😊";

        $this->sendMessage($user_phone,$message);
    }
    public function sendLoginWelcome($user_phone,$f){

       $name = $f;
       $message = "*🌟 Welcome, {$name}! 🌟*\n\n "
           . "*🎉 Welcome to Trolley, the best delivery app in the world! 🎉*\n"
           . "*🚚 Fast, reliable, and secure deliveries at your fingertips. 🚚*\n\n"
           . "We're thrilled to have you join the Trolley family. Now you can:\n\n"
           . "📦 *Track your orders easily.*\n"
           . "⏱️ *Get your deliveries on time.*\n"
           . "💳 *Enjoy safe and easy payments.*\n\n"
           . "If you have any questions, feel free to reach out to us. 😊\n\n "
           . "*Thank you for choosing Trolley! ❤️*";

        $this->sendMessage($user_phone,$message);
    }
    public function orderStatus($status){
        $userPhone = auth()->user()->phoneNumber;
        $statusMessage = "";

        switch ($status) {
            case 'pending':
                $statusMessage = "⏳ Your order is currently **pending**. We're processing it and will update you soon!";
                break;
            case 'processing':
                $statusMessage = "🚀 Your order is **being processed**. Hang tight, it's on its way!";
                break;
            case 'shipping':
                $statusMessage = "🚚 Your order has been **shipping**! It's now on its way to you.";
                break;
            case 'delivered':
                $statusMessage = "🎉 Your order has been **delivered**! We hope you enjoy it. Thank you for choosing us! ❤️";
                break;
            case 'cancelled':
                $statusMessage = "❌ Your order has been **cancelled**. If you have any questions, feel free to contact us.";
                break;
            default:
                $statusMessage = "ℹ️ Your order status is: **{$status}**. We'll keep you updated!";
                break;
        }

        $message = "📦 Order Update:\n\n"
            . "Dear " . auth()->user()->firstName . ",\n\n"
            . $statusMessage . "\n\n"
            . "Thank you for choosing Trolley! 🚀";

        $this->sendMessage($userPhone, $message);
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

        $message = "🌟 *Hello {$userName},* 🌟\n\n ";

        $message .= "*Thank you for choosing us! Here's your order summary:* \n\n";

        $message .= "-------------------------\n";
        $message .= "📦 *Order ID:* {$order->id} \n";
        $message .= "💰 *Total Price:* \${$order->total_price} \n";
        $message .= "-------------------------\n\n";

        $message .= "🔹 *Your Products:*\n";
        $i = 1;
        foreach ($order->orderItems as $orderItem) {
            $product = $orderItem->product;
            $message .= "{$i}. *{$product->name}*  (Qty: *{$orderItem->quantity}*, Price: *\${$product->price}*, Total: *\${$orderItem->total_price}*)\n";
            $i++;
        }

        $orderTimePlusQuarter = Carbon::parse($order->created_at)->addMinutes(15)->format('Y-m-d H:i');
        $message .= "\n⏰ *Estimated Delivery Time:* {$orderTimePlusQuarter}\n\n";

        $message .= "-------------------------\n";
        $message .= "🚚 *Your delivery driver:* *{$randomDriver['name']}*\n";
        $message .= "📞 *Driver's contact:* *{$randomDriver['phone']}*\n";
        $message .= "-------------------------\n\n";

        $message .= "*We truly appreciate your business and are excited to deliver your order!* \n";
        $message .= "*If you have any questions or need assistance, feel free to reach out.*\n\n";

        $message .= "Best regards,\n";
        $message .= "*TROLLEY TEAM*\n";
        $message .= "--------------------------------\n";
        $message .= "*Thank you for trusting us!* 🌟\n ";




        return $message;
    }



}
