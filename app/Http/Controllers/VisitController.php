<?php

namespace App\Http\Controllers;

use App\Helpers\MailHelper;
use App\Helpers\SentimentAnalysis;
use App\Models\Feedback;
use App\Models\Visit;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use MonkeyLearn\Client;

class VisitController extends Controller
{

    public function visits()
    {

        $visits = Visit::with('customer')->where('user_id',Auth::User()->id)->with('branch')->get();
        $branches=Branch::where('user_id',Auth::User()->id)->get();
        return view('visits', compact('visits','branches'));
    }


    public function store(Request $request)
    {
        // $request->validate([
        //     'branch' => 'required',
        //     'email' => 'required|email',
        // ]);
        
       

        $retrieved_order = Order::find($request->id);
        $retrieved_user=User::find($retrieved_order->user_id);
        $steps=json_decode(env('ORDER_STEPS'), true);


        if($request->status != count($steps)-1){
            // update
            $retrieved_order->status = $request->status;
            $retrieved_order->save();
            return response()->json(['success' => 'Status Updated']);

        }

        // get customer by email
        $customer= Customer::where('email', '=',$retrieved_user->email)->first();
        if($customer){
            $token=Str::random(30);
            $visit=Visit::create([
                'customer_id' => $customer->id,
                'user_id' =>$retrieved_user->id,
                'branch_id' => $retrieved_order->branch_id,

            ]);

            Feedback::create([
                'status' => 'pending',
                'token' => $token,
                'customer_id' => $customer->id,
                'branch_id' =>  $retrieved_order->branch_id,
                'user_id' => $retrieved_user->id,

            ]);
            // send mail
            $date=Visit::find($visit->id);

                $branch=Branch::find($visit->branch_id);
                $customer=Customer::find($visit->customer_id);
                try {
                    MailHelper::sendMail($retrieved_user->email,$token,$branch->branch_name,$customer->name,$date->created_at,$customer->id);
                    $retrieved_order->status = $request->status;
                    $retrieved_order->save();
                } catch (\Throwable $th) {
                    error_log($th->getMessage());
                }
            // return redirect()->back()->with('success', 'Visit initiated');
            
            return response()->json(['success' => 'Survey form sent']);

        }
        // return redirect()->back()->with('error', 'Customer doesn\'t exist');
        
        return response()->json(['error' => 'Customer does\'nt exist']);

    }

 public function test(){
  SentimentAnalysis::get_analysis('data');

 }

}
