<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\Mail\OrderStatusMail;
use App\Mail\PaymentConfirmation;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class MailHelper {
    public static function sendMail($mail,$token,$branch,$name,$date,$user_id)
    {
        $feedback_url=Config::get('app.url') .route('feedback-page',['uid' => $user_id,'token' => $token],null, false);
        Mail::to($mail)->send(new FeedbackMail($token,$branch,$name,$date,$user_id, $feedback_url));
               
    }

    public static function sendOrderStatusMail($user,$order)
    {
        $order_track_url=Config::get('app.url') .route('ordertracking', [$order->order_number],null, false);
        
        $steps=json_decode(env('ORDER_STEPS'), true);
        $steps_desc=json_decode(env('ORDER_STEPS_DESC'), true);
        
        try {
            // Your existing code...
           
            
            Mail::to($user->email)->send(new OrderStatusMail(
                $user->name,
                $steps[$order->status],
                $steps_desc[$order->status],
                $order->order_number,
                $order->created_at,
                $order->total,
                $order_track_url,
               
    
            ));
        } catch (\Exception $e) {
        error_log ($e->getMessage());
        }

    }

    public static function sendPaymentConfirmation($mail,$name, $description)
    {
        Mail::to($mail)->send(new PaymentConfirmation($name, $description));
               
    }
    
}
