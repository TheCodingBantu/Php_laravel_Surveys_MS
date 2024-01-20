<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\Mail\OrderStatusMail;
use Illuminate\Support\Facades\Config;

class MailHelper {
    public static function sendMail($mail,$token,$branch,$name,$date,$user_id)
    {
        $feedback_url=Config::get('app.url') .route('feedback-page',['uid' => $user_id,'token' => $token],null, false);
        Mail::to($mail)->send(new FeedbackMail($token,$branch,$name,$date,$user_id, $feedback_url));
               
    }

    public static function sendOrderStatusMail($mail,$name)
    {
        // $order_track_url=Config::get('app.url') .route('feedback-page',['uid' => $user_id,'token' => $token],null, false);
        Mail::to($mail)->send(new OrderStatusMail($name));
               
    }
}
