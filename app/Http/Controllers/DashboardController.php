<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        // get time carbon in +3gmt
        $time = Carbon::now()->timezone('Africa/Nairobi');

        // if evening show good evening
        if ($time->hour >= 18) {
            $greeting = 'Good Evening';
        } elseif ($time->hour >= 12) {
            $greeting = 'Good Afternoon';
        } else {
            $greeting = 'Good Morning';
        }
        // count all customers
        $customers = Customer::where('user_id', Auth::User()->id)->count();
        // get numbe rof feedbacks per month in the current year
        $feedbackPerMonth = Feedback::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->whereYear('created_at', $time->year)
            ->where('user_id', Auth::User()->id)
            ->where('token', '')
            ->groupBy('month')
            ->get();
        // empty array
        $feedbackPerMonthArray = [];
        // loop 12 times
        for ($i = 1; $i <= 12; $i++) {
            // check if month exists in the array
            if ($feedbackPerMonth->where('month', $i)->first()) {
                // push to array
                array_push($feedbackPerMonthArray, $feedbackPerMonth->where('month', $i)->first()->count);
            } else {
                // push 0 to array
                array_push($feedbackPerMonthArray, 0);
            }
        }

        // count total sent feedbacks
        $responses = Feedback::where('user_id', Auth::User()->id)->where('token', '')->count();
        $responses_today = Feedback::where('user_id', Auth::User()->id)->where('token', '')->whereDate('created_at', Carbon::today())->count();
        $sent = Visit::where('user_id', Auth::User()->id)->count();
        $sent_today = Visit::where('user_id', Auth::User()->id)->whereDate('created_at', Carbon::today())->count();
        $branches = Branch::where('user_id', Auth::User()->id)->count();

        $total_average_rating = 0;
        $current_average_rating = 0;

        foreach (Feedback::where('user_id', Auth::User()->id)->where('token', '')->whereDate('created_at', Carbon::today())->get() as $response) {
            # code...
            if ($response->rating) {
                $current_average_rating += $response->rating;
            }
        }
        foreach (Feedback::where('user_id', Auth::User()->id)->where('token', '')->get() as $response) {
            # code...
            if ($response->rating) {
                $total_average_rating += $response->rating;
            }
        }
        if($total_average_rating>0){
            $total_average_rating /= $responses;
        }
        if($current_average_rating>0){
            $current_average_rating /= $responses_today;
        }

        $promoters=0;
        $detractors=0;
        $passive=0;
  
        foreach (Feedback::where('user_id', Auth::User()->id)->where('token', '')->get() as $response) {
            # code...
            if ($response->rating >= 9) {
                $promoters+=1;
            }
            if ($response->rating <= 6) {
                $detractors+=1;
            }
            if ($response->rating >= 7 && $response->rating <= 8 ) {
                $passive+=1;
            }
        }
        $rating_types=[];
        array_push($rating_types,$promoters,$detractors,$passive);

        $total_rating_types=$promoters+$detractors+$passive;
        $nps=[];
        $nps_temp=0;
        if($total_rating_types){
            $nps_temp=(($promoters/$total_rating_types)*100)-(($detractors/$total_rating_types)*100);
            array_push($nps,round($nps_temp,2),(100 - abs(round($nps_temp,2)) ));
        }
        // response by location
            $feedbackLocation= Feedback::groupBy('branch_id')
            ->where('user_id',Auth::User()->id)
            ->where('token','')
            ->selectRaw('branch_id, count(*) as count')
            ->orderBy('count', 'desc')
            ->get();

            $branch_name=[];
            $branch_feedback_count=[];

            foreach ($feedbackLocation as $key => $value) {
                $name=((Branch::find($feedbackLocation[$key]->branch_id)->branch_name));
                array_push($branch_name,$name);
                array_push($branch_feedback_count,$feedbackLocation[$key]->count);
           }
           $feeback_by_location=array_combine($branch_name,$branch_feedback_count);

        //    by gender

        $gender= Customer::groupBy('gender')
        ->where('user_id',Auth::User()->id)
        ->selectRaw('gender, count(*) as count')
        ->orderBy('count', 'desc')
        ->get();

        $gender_name=[];
        $gender_count=[];
        foreach ($gender as $key => $value) {
            // dd();
            if($gender[$key]->gender=='Male'||$gender[$key]->gender=='Female'){

                array_push($gender_name,$gender[$key]->gender);
                array_push($gender_count,$gender[$key]->count);
            }

       }
       $gender_distribution=array_combine($gender_name,$gender_count);

    //    age
       $age_distribution=array(
        '0-20' => 0,
        '21-40' => 0,
        '41-60' => 0,
        '61-100' => 0,
      );
       $cust=Customer::where('user_id',Auth::User()->id)->get();

       foreach($cust as $customer){
        $current_age=Carbon::parse($customer->dob)->age;
         if($current_age <=20){
            $age_distribution['0-20']+=1;
         }
         if($current_age >=21 && $current_age <=40){
            $age_distribution['21-40']+=1;

         }
         if($current_age >=41 && $current_age <=60){
            $age_distribution['41-60']+=1;
         }
         if($current_age >=61){
            $age_distribution['61-100']+=1;
         }

       }
       $total_average_rating=round($total_average_rating,2);
       $current_average_rating=round($current_average_rating,2);
       $nps_temp=(int)(abs($nps_temp));
      

            return view('dashboard', compact(
            'customers',
            'greeting',
            'feedbackPerMonthArray',
            'responses',
            'sent',
            'branches',
            'sent_today',
            'responses_today',
            'total_average_rating',
            'current_average_rating',
            'rating_types',
            'nps',
            'gender_distribution',
            'feeback_by_location',
            'age_distribution',
            'nps_temp'
        ));
    }

    public function branchDashboard(Request $request){
        $time = Carbon::now()->timezone('Africa/Nairobi');

        // if evening show good evening
        if ($time->hour >= 18) {
            $greeting = 'Good Evening';
        } elseif ($time->hour >= 12) {
            $greeting = 'Good Afternoon';
        } else {
            $greeting = 'Good Morning';
        }
        $branch_id = $request->bid;
        $branches =  Branch::all();

        if($branch_id){
            try {
                $branch = Branch::find($branch_id);
            } catch (\Throwable $th) {
                $branch = $branches->first();
            }
            
        }
        else{
           
            $branch = $branches->first();
        }

        //Total orders made on the branch
        $total_orders = Order::where('branch_id', $branch->id)->count();
        $total_surveys_sent = Feedback::where('branch_id', $branch->id)->count();
        $total_surveys_received = Feedback::where('branch_id', $branch->id)->where('token','')->count();

        $feedbacks = Feedback::where('branch_id', $branch->id)->get();
        
        $total_average_rating =  DB::table('feedback')->where('branch_id',$branch->id)
        ->select(DB::raw('ROUND((AVG(rating) + AVG(overall_rating)) / 2, 2) as average'))
        ->first()->average;

        $avg_rating_pm = [];
        $averagesByMonth = DB::table('feedback')
        ->where('branch_id', $branch->id)
        ->whereYear('created_at', $time->year)
        ->select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('ROUND((AVG(rating) + AVG(overall_rating)) / 2, 2) as average')
        )
        ->groupBy('month')
        ->get();

        for ($i = 1; $i < 13; $i++) {
            $avg_rating_pm[$i] = 0;
        }
        foreach ($averagesByMonth as $item) {
            $month = (int)$item->month; 
            $average = (float)$item->average;
            $avg_rating_pm[$month] = $average;
        }
        $avg_rating_pm = array_values($avg_rating_pm);
        return view('branch-dashboard', compact(
            'branches',
            'branch',
            'total_orders',
            'total_surveys_sent',
            'total_surveys_received',
            'total_average_rating',
            'greeting',
            'avg_rating_pm'

        ));
    }
  
    
}
