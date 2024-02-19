<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Cart;
use App\Models\CartManager;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        //get items from cart with same user id
        if(CartManager::where('user_id','=',Auth::user()->id)->exists()){
            return ($this->checkout());
        }
        $cart = Cart::where('user_id', '=', auth()->user()->id)->get();
        return view('clientui.cart', compact('cart'));
    }


    public function clearCart()
    {
        //clear cart where user id is same
        Cart::where('user_id', '=', auth()->user()->id)->delete();
        return redirect()->back()->with('success', 'Cart Cleared');
    }

    public function deletecartitem($id){
        Cart::find($id)->delete();
        return redirect()->back()->with('success', 'Item removed from cart');
    }

    public function store(Request $request)
    {

        try {
            //code...
            // if user not logged in redirect to login page
            $cart_man=CartManager::where('user_id','=',Auth::user()->id)->first();

            if($cart_man && $cart_man->order_id !== null){
                return response()->json(['error' => 'Please complete pending orders']);
            }

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
                    $cart_man=CartManager::where('user_id', '=', Auth::user()->id)->first();
                   
                    if($cart_man){

                        $cart->cart_manager = $cart_man->id;

                    }else{
                        $cart_manager = new CartManager();
                        $cart_manager->prepaid_amount=0;
                        $cart_manager->user_id=Auth::user()->id;
                        $cart_manager->save();

                        $cart->cart_manager = $cart_manager->id;
                    }
    
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
        $prepaid_amount = CartManager::where('user_id', '=', auth()->user()->id)->first()->prepaid_amount;
        $branches =  Branch::all();
        
        return view('clientui.checkout', compact('cart','lp','branches','customer','prepaid_amount'));
      
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
        $product_ids=[];


        foreach ($cart_item as $item) {
            //update cart item to order id

         array_push($item_names, $item->getProductRelation->title);
         array_push($item_prices, $item->getProductRelation->price);
         array_push($item_quantities, $item->quantity);
         array_push($item_totals, $item->quantity * $item->getProductRelation->price);
         array_push($product_ids,$item->getProductRelation->id );
        }
        
        // calculate total
        $now [] = Carbon::now()->format('Y-m-d H:i:s');

        $cart_manager = CartManager::where('user_id','=',Auth::user()->id)->first();

        
        $check_order=Order::find($cart_manager->order_id);

        if($check_order){
            //update the cart manager
            if ($request->amt_balance <=0){
                $check_order -> is_payment_complete = true;
                $check_order->save();
                Cart::where('user_id', '=', auth()->user()->id)->delete();
                CartManager::where('user_id', '=', auth()->user()->id)->delete();
                return redirect()->route('orders')->with('success', 'Full payment received');

            }
            else{
                $cart_manager->prepaid_amount=$request->input('order_amount');
                $cart_manager->save();
                return redirect()->route('orders')->with('success', 'Partial payment received');

            }
        }
        else{
            //create order
            $order = new Order();
            $order->order_number = 'ORD_'.rand(1000, 9999);
            $order->user_id = auth()->user()->id;
            $order->payment_method = $request->input('payment');
            $order->delivery_address = auth()->user()->id;
            $order->item_names =json_encode($item_names);
            $order->product_ids =json_encode($product_ids);
            $order->item_prices =json_encode($item_prices);
            $order->item_quantities =json_encode($item_quantities);
            $order->item_totals =json_encode($item_totals);
            $order->total = array_sum($item_totals) -( $lp>0?$lp:0);
            $order->status = 0;	
            $order->branch_id= $request->input('branch');
            $order->redeemed_lp = $lp;
            $order->tracking_dates = json_encode($now);

            $order->save();
            $cart_manager = CartManager::where('user_id','=',Auth::user()->id)->first();
            $cart_manager->order_id=$order->id;

            if ($request->amt_balance <=0){
                 $check_order=Order::find($cart_manager->order_id);
                    $check_order -> is_payment_complete = true;
                    $check_order->save();

                Cart::where('user_id', '=', auth()->user()->id)->delete();
                CartManager::where('user_id', '=', auth()->user()->id)->delete();
                return redirect()->route('orders')->with('success', 'Full payment received');

            }
            else{
                
                $cart_manager->prepaid_amount=$request->input('order_amount');
                $cart_manager->save();
              
                return redirect()->route('orders')->with('success', 'Partial payment received');
            }

        }
        

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
