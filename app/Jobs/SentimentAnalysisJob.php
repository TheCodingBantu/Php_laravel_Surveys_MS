<?php

namespace App\Jobs;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\SentimentAnalysis;

class SentimentAnalysisJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $text=[];
    public $feedback_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($text,$feedback)
    {
      $this->text = $text;
      $this->feedback_id =$feedback;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try{
           
            $rating_sentiment=SentimentAnalysis::get_analysis($this->text[0]);
            $overall_sentiment=SentimentAnalysis::get_analysis($this->text[1]);
            $update=Feedback::find($this->feedback_id);
            $update->rating_sentiment = $rating_sentiment[0];
            $update->rating_score = $rating_sentiment[1];
            $update->overall_sentiment = $overall_sentiment[0];
            $update->overall_score = $overall_sentiment[1];
            $update->save();
        
        }
        catch (\Throwable $th) {
            error_log($th->getMessage());
            }
        
    }
}
