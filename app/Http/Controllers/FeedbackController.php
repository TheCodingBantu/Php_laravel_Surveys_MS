<?php

namespace App\Http\Controllers;

use App\Jobs\SentimentAnalysisJob;
use App\Models\Branch;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
class FeedbackController extends Controller
{

    public function index()
    {
        $feedback=Feedback::with('customer')->with('branch')->get();

        return view('feedback-page',compact('feedback'));
    }

    public function getFeedback($id){
        $feedback=Feedback::where('id',$id)->with('customer')->with('branch')->get();

        return response()->json($feedback);
    }

    public function form(Request $request)
    {
        // if user exists and has token
        if($request->uid && $request->token){
            $feedback=Feedback::where('token',$request->token)->first();
            if($feedback){
                // get user
                if($feedback->customer_id == $request->uid){
                    $branch=(Branch::where('id',$feedback->branch_id)->first())->branch_name;

                    return view('feedback-form',compact('branch'));
                }

            }
        }
        abort(404);

    }

    public function save(Request $request){

    //    update the feedback table
   // if user exists and has token
   if($request->uid && $request->token){
    $feedback=Feedback::where('token',$request->token)->first();
    if($feedback){
        // get user
        if($feedback->customer_id == $request->uid){
            // feedback id
            $update=Feedback::find($feedback->id);
            $update->rating = $request->rating;
            $update->rating_comments= $request->rating_comments;
            $update->overall_rating = $request->overall_rating;
            $update->overall_comments = $request->overall_comments;
            $update->token = '';
            $update->status = 'received';
            $update->save();

            $sentiment_comments=[$request->rating_comments,$request->overall_comments];
            dispatch(new SentimentAnalysisJob($sentiment_comments,$feedback->id));


            $user=User::find((Branch::find($feedback->branch_id))->user_id);
            Notification::send($user, new \App\Notifications\Notifier('New Feedback received '));
            return redirect()->route('');
            return redirect()->route('feedback-list')->withInput()->with('success', 'Thankyou for your feedback !');

        }

    }
}
abort(404);

    }
}
