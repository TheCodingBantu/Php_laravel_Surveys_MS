<?php

namespace App\Http\Controllers;

use App\Helpers\MailHelper;
use App\Models\Feedback;
use App\Models\Visit;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $request->validate([
            'branch' => 'required',
            'email' => 'required|email',
        ]);

        // get customer by email
        $customer= Customer::where('email', '=',$request->email)->where('user_id',Auth::User()->id)->first();

        if($customer){
            $token=Str::random(30);
            $visit=Visit::create([
                'customer_id' => $customer->id,
                'user_id' =>Auth::user()->id,
                'branch_id' => $request->branch,

            ]);

            Feedback::create([
                'status' => 'pending',
                'token' => $token,
                'customer_id' => $customer->id,
                'branch_id' => $request->branch,
                'user_id' => Auth::User()->id,

            ]);
            // send mail
            $date=Visit::find($visit->id);

                $branch=Branch::find($visit->branch_id);
                $customer=Customer::find($visit->customer_id);
            MailHelper::sendMail($request->email,$token,$branch->branch_name,$customer->name,$date->created_at,$customer->id);
            return redirect()->back()->with('success', 'Visit initiated');
        }
        return redirect()->back()->with('error', 'Customer doesn\'t exist');

    }


}
