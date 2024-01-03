@include('clientui.components.client-navbar')
@include('clientui.components.client-footer')

@yield('navbar')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class=" container mb-80 mt-50 ">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Checkout</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">{{$cart->count()}}</span> products in your cart</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                        <h6 class="text-muted">Subtotal</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                            @foreach ($cart as $item)
                                    
                                <tr>
                                    <td class="image product-thumbnail"><img src="data:image/png;base64,{{$item->getProductRelation->url}}" alt="#"></td>
                                    <td>
                                        <h6 class="w-160 mb-5"><a href="shop-product-full.html" class="text-heading">{{$item->getProductRelation->title}} </a></h6>
                                        
                                    </td>
                                    <td>
                                        <h6 class="text-muted pl-20 pr-20">Kshs {{$item->getProductRelation->price}} x {{$item->quantity}}</h6>
                                    </td>
                                    <td>
                                        <h4  class="text-brand">Kshs <span class="itemtotal">{{$item->getProductRelation->price * $item->quantity}}</span> </h4>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
       
                </div>
            <div class="col-lg-5 border p-4">

                <div class="row">
                    <h4 class="mb-30">Billing Details</h4>
                    <form method="POST" action="{{route('createOrder')}}">

                        <div class="row">
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" required="" name="name" placeholder="Name *">
                            </div>
                            <div class="form-group ">
                                <label for="">Email Address</label>
                                <input type="text" required="" name="email" placeholder="Email *">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" required="" placeholder="Phone *">
                            </div>
                            <div class="form-group" >
                                <label for="">Payment Method</label>
                                <input type="text" name="" required="" value="Cash" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="">Collection Branch</label>
                                <select name="branch" class="select-cust" name="" id="">
                                    @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
            
                        <div class="payment ml-30">
                            <h4 class="mb-30">Redeem Loyalty Points</h4>
                            <div class="payment_option">
        
                                
                                <div class="custome-">
                                    My LP Balance: <span id="lp-amount" style="font-weight:bold; color: #292b2c">{{$lp?$lp:'0'}}</span> (Kshs {{$lp ? $lp*100 :'0'}} )
                                    <hr>
        
                
                                </div>
                                <div class="">
                                    <div class="" >
                                       
                                        <label class="sr-only" for="filter-filter-v-price-gte">Points to Redeem</label>
                                        <br>
                                        <input onchange="checklp()" id="lp" name="lp" style="width: 100px;"  type="number" placeholder="0" min="0" >
                                        <br>
                                        <span style="font-size: .8rem; color:red" id="info"></span>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="mt-30 mb-30">Grand Total: Kshs <span id="total"> </span> </h4> 
                                <hr>
                                
                            </div>
                           
                            @csrf
                                <button id="submit" type="submit" class="btn btn-sm btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                        </form>

                </div>
                
               
            </div>
         
        </div>
        </div>
    </div>
</main>
<style>
    /* Define the class with the specified style */
    .redBorder {
        border: 1px solid red;
    }
    .select-cust{
        background: #fff;
        border: 1px solid #ececec;
        height: 64px;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding-left: 20px;
        font-size: 16px;
        width: 100%;

    }
</style>
@yield('footer')

<script>
    let lpAmount = parseInt(document.getElementById('lp-amount').textContent)
    let submit= document.getElementById('submit')
    let info = document.getElementById('info')
    
    function checklp(){
        let lp = document.getElementById('lp')
       
        if(parseInt(lp.value) > lpAmount){
            info.textContent='Not enough points to redeem'
            lp.classList.add("redBorder")

            submit.disabled=true

        }else{
            lp.classList.remove("redBorder")
            submit.disabled=false
            info.textContent=''
            calculateTotals(lp.value * 100)
        }

    }
    document.addEventListener("DOMContentLoaded", function() {
        calculateTotals(0)
    });

    function calculateTotals(discount){
        let subtotals= document.getElementsByClassName('itemtotal')
        let total =  document.getElementById('total')
        let sum = 0;
        Array.from(subtotals).forEach(element => {
            sum = sum + parseInt(element.innerText)
        });
        total.innerText = sum - parseInt(discount)
    }

</script>