<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
class MailHelper{
    public static function sendMail($mail,$token,$branch,$name,$date,$user_id)
    {
        Mail::to($mail)->send(new FeedbackMail($token,$branch,$name,$date,$user_id));
               
    }
}
