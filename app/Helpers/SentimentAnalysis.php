<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class SentimentAnalysis{
    public static function get_analysis($text){
        $url = 'https://api.monkeylearn.com/v3/classifiers/cl_NDBChtr7/classify';
        $apiKey = '306e806a34cec89e891fc3e1a2482ccbdfdf23f4';

        $data = [
            'data' => ['This is a great tool!'],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        // Output the response
        dd($response->body());
    }
}