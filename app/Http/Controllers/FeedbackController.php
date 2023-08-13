<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
class FeedbackController extends Controller
{

    public function index()
    {
        $feedback=Feedback::where('user_id',Auth::user()->id)->with('customer')->with('branch')->get();

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
            $update->comments = $request->comments;
            $update->recommendation = $request->recommendation;
            $update->token = '';
            $update->status = 'received';
            $update->save();


            $user=User::find((Branch::find($feedback->branch_id))->user_id);


            Notification::send($user, new \App\Notifications\LeaveActions('New Feedback received '));
            return view('feedback-success');
        }

    }
}
abort(404);

    }
}
