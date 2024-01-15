<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index()
    {
    //   get all orders with same user id
        $steps=json_decode(env('ORDER_STEPS'), true);
        $orders = Order::where('user_id', '=', auth()->user()->id)->get();
        return view('clientui.orders', compact('orders','steps'));
    }
    public function adminOrdersList()
    {
    //   get all orders with same user id
        $branches = Branch::all();
        $orders = Order::all();
        $steps=json_decode(env('ORDER_STEPS'), true);
        return view('orders-list', compact('orders','branches','steps'));
    }


    public function orderDetailAdmin($id)
    {
        //get invoice with same id
        $invoice = Order::where('id', '=', $id)->first();
        return view('admin.order-detail', compact('invoice'));
    }
    
    // UPDATE ORDER BY ID
    public function updateOrder(Request $request, $id)
    {
        //get invoice with same id
        $invoice = Order::where('id', '=', $id)->first();
        $invoice->status = $request->input('status');
        $invoice->save();
        return redirect()->back()->with('success', 'Order Updated');
    }

    public function tracking($id){
        $steps=json_decode(env('ORDER_STEPS'), true);
        $step_numbers=$indexesArray = array_keys($steps);
        $order = Order::where('order_number', '=', $id)->first();
        $dates = json_decode($order->tracking_dates);
        return view('clientui.tracking',compact('order','steps','step_numbers','dates'));
    }

    public function feedbacklist(){
        $responses = Feedback::where('user_id', '=', auth()->user()->id)->get();
        return view ('client_feedback_list', compact('responses'));
    }

    public function ordersearch(Request $request){
        $steps=json_decode(env('ORDER_STEPS'), true);
        $step_numbers=$indexesArray = array_keys($steps);
        $order = Order::where('order_number', '=', $request->input('order_number'))->first();
        $dates = json_decode($order->tracking_dates);
        return view('clientui.tracking',compact('order','steps','step_numbers','dates'));
    }
    public function getLP(){
        try {
            $lp = Customer::where('user_id',Auth::user()->id)->first()->lp;
            return response()->json(['success' => $lp]);

        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th]);

        }
        

    }
}
