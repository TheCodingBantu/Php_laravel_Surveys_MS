<?php

namespace App\Http\Controllers;

use App\Helpers\MailHelper;
use App\Models\Feedback;
use App\Models\Visit;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
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
        $order_update_dates = json_decode($retrieved_order->tracking_dates);

        if($request->status != count($steps)-1){
            array_push($order_update_dates,Carbon::now()->format('Y-m-d H:i:s'));
            // update
            $retrieved_order->status = $request->status;
            $retrieved_order->tracking_dates = json_encode($order_update_dates);
            $retrieved_order->save();
            return response()->json(['success' => 'Order Status Updated']);

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
                    array_push($order_update_dates,Carbon::now()->format('Y-m-d H:i:s'));
                    $retrieved_order->tracking_dates =($order_update_dates);

                    $retrieved_order->status = $request->status;
                    $retrieved_order->save();
                } catch (\Throwable $th) {
                    error_log($th->getMessage());
                }
         
            return response()->json(['success' => 'Survey form sent']);

        }
        // return redirect()->back()->with('error', 'Customer doesn\'t exist');
        
        return response()->json(['error' => 'Customer does\'nt exist']);

    }


}
