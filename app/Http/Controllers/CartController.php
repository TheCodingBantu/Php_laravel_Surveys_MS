<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        //get items from cart with same user id
        $cart = Cart::where('user_id', '=', auth()->user()->id)->get();
        return view('clientui.cart', compact('cart'));
    }


    public function clearCart()
    {
        //clear cart where user id is same
        Cart::where('user_id', '=', auth()->user()->id)->delete();
        return redirect()->back()->with('success', 'Cart Cleared');
    }

    public function store(Request $request)
    {

        try {
            //code...
        // if user not logged in redirect to login page
        
            $cart = new Cart();
            // check if user is logged in
            if (auth()->user()) {
                $cart->user_id = auth()->user()->id;
            } else {
                // get database with same user and product id

                return response()->json(['redirect' => route('login')]);
            }
            $exists = Cart::where('user_id', '=', auth()->user()->id)->where('product_id', '=', $request->input('id'))->exists();
                if ($exists) {
                    return response()->json(['error' => 'Product Already in Cart']);
                }
                else{
                    $cart->product_id = $request->input('id');
                    $cart->quantity = '1';
        
                    $cart->save();
        
                    return response()->json(['success' => 'Product Added to Cart']);
                }
            

        } catch (\Throwable $th) {

            return response()->json(['error' => $th->getMessage()]);

            // return redirect()->back()->with('error', $th->getMessage());


        }
    }

    public function updateCart(Request $request)
    {
        //update cart
        try{
            $cart = Cart::find($request->input('id'));
            $cart->quantity = $request->input('quantity');
            $cart->save();
            return response()->json(['success' => 'Cart Updated', 'index' => $request->input('index'),'length' => $request->input('length')]);
        }
        
        catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()]);
        }

    }

    public function checkout()
    {
        //
        $cart = Cart::where('user_id', '=', auth()->user()->id)->get();
        $customer = Customer::where('user_id', '=', auth()->user()->id)->first();
        $lp = $customer->lp;
        $branches =  Branch::all();
        
        return view('clientui.checkout', compact('cart','lp','branches'));
      
    }


    public function createOrder(Request $request)
    {
        $lp= request('lp');
        //get items in cart
        $cart_item = Cart::where('user_id', '=', auth()->user()->id)->get();
        // loop through cart items
        $item_names=[];
        $item_prices=[];
        $item_quantities=[];
        $item_totals=[];


        foreach ($cart_item as $item) {
         array_push($item_names, $item->getProductRelation->title);
         array_push($item_prices, $item->getProductRelation->price);
         array_push($item_quantities, $item->quantity);
         array_push($item_totals, $item->quantity * $item->getProductRelation->price);
        }
        
        // calculate total

        //create order
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->payment_method = 'Cash';
        $order->delivery_address = auth()->user()->id;
        $order->item_names =json_encode($item_names);
        $order->item_prices =json_encode($item_prices);
        $order->item_quantities =json_encode($item_quantities);
        $order->item_totals =json_encode($item_totals);
        $order->total = array_sum($item_totals) -( $lp>0?$lp:0);
        $order->status = 'Pending';	
        $order->branch_id= $request->input('branch');
        $order->redeemed_lp = $lp;
        $order->save();
        // delete items in cart
        Cart::where('user_id', '=', auth()->user()->id)->delete();
        if ($lp>0){
            $customer = Customer::where('user_id', Auth::user()->id)->first();
            
            $customer->lp = $customer->lp - $lp;
            $customer->save();
        }

        // redirect to orders page
        return redirect()->route('orders')->with('success', 'Order Placed Successfully');


    }


    public function getCount()
    {
        //get cart count for user
        $count = Cart::where('user_id', '=', auth()->user()->id)->count();
        return response()->json(['count' => $count]);
        
    }
}
