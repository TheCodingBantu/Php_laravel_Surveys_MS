<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = Customer::where('user_id',Auth::User()->id)->paginate(100);
        return view('customers', ['customers' => $customers]);
    }

   public function show(){
    return view('add-customer');
   }
    public function storeCustomer(Request $request)
    {
        // create a user relation
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make('password')
        ]);
        
        Customer::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "dob" => Carbon::parse($request->date),
            "gender" => $request->gender,
            "user_id" => $user->id
        ]);
        return redirect()->back()->withInput()->with('success', 'Customer added successfully');

    }

    public function deleteCustomer(Request $request){
        if(Customer::find($request->id)->delete()){
            return redirect()->back()->withInput()->with('success', 'Customer Deleted');

        };
        return redirect()->back()->withInput()->with('error', 'An Error Occured');

    }

    public function getCustomer($id){
        $customer=Customer::find($id);

        return response()->json($customer);
    }
    public function updateCustomer(Request $request){
        $preview=Customer::find($request->id);

        if($preview){
            $preview->name = $request->name;
            $preview->email = $request->email;
            $preview->phone = $request->phone;
            $preview->dob =Carbon::parse($request->dob);
            $preview->gender = $request->gender;

            $preview->save();
        return redirect()->back()->withInput()->with('success', 'Record Updated');

        }
        return redirect()->back()->withInput()->with('error', 'An Error Occured');
    }

}
