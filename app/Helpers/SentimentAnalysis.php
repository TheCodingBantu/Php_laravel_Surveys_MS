<?php
namespace App\Helpers;

use MonkeyLearn\Client;
class SentimentAnalysis{
    public static function get_analysis($text){
        $ml = new Client(env("MONKEY_LEARN_API_KEY"));
        $data = [$text];
        $model_id = env('MONKEY_LEARN_MODEL');
        $res = $ml->classifiers->classify($model_id, $data);
        $sentiment=($res->result[0]['classifications'][0]['tag_name']);
        $score= ($res->result[0]['classifications'][0]['confidence']);
        return [$sentiment,$score];
    }
}