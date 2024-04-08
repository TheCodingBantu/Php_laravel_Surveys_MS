<?php
namespace App\Helpers;

use MonkeyLearn\Client;
class SentimentAnalysis{
    // public static function get_analysis($text){
    //     $ml = new Client(env("MONKEY_LEARN_API_KEY"));
    //     $data = [$text];
    //     $model_id = env('MONKEY_LEARN_MODEL');
    //     $res = $ml->classifiers->classify($model_id, $data);
    //     $sentiment=($res->result[0]['classifications'][0]['tag_name']);
    //     $score= ($res->result[0]['classifications'][0]['confidence']);
    //     return [$sentiment,$score];
    // }

    public static function get_analysis($text){
        $api_key = (env("APILAYER_API_KEY"));
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.apilayer.com/sentiment/analysis",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: ".$api_key
          ),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>$text
        ));
        
        
        curl_close($curl);
        
        $response = json_decode(curl_exec($curl));
        $sentiment= $response->sentiment;
        $score= $response->score;
        return [$sentiment,$score];
    }
}