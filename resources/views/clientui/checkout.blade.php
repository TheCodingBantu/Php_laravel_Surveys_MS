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
                    <h6 class="text-body">There are <span class="text-brand">{{$cart->count()}}</span> products in your
                        cart</h6>
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
                                    <td class="image product-thumbnail"><img
                                            src="data:image/png;base64,{{$item->getProductRelation->url}}" alt="#"></td>
                                    <td>
                                        <h6 class="w-160 mb-5"><a href="shop-product-full.html"
                                                class="text-heading">{{$item->getProductRelation->title}} </a></h6>

                                    </td>
                                    <td>
                                        <h6 class="text-muted pl-20 pr-20">Kshs {{$item->getProductRelation->price}} x
                                            {{$item->quantity}}</h6>
                                    </td>
                                    <td>
                                        <h4 class="text-brand">Kshs <span
                                                class="itemtotal">{{$item->getProductRelation->price *
                                                $item->quantity}}</span> </h4>
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
                    <h4 class="mb-30">Order Details</h4>
                    <form id="checkout_form" method="POST" action="{{route('createOrder')}}">

                        <div class="row">
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" name="name" readonly placeholder="{{$customer->name}}">
                            </div>
                            <div class="form-group ">
                                <label for="">Email Address</label>
                                <input type="text" required="" name="email" readonly placeholder="{{$customer->email}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" required="" readonly placeholder="{{$customer->phone}}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select onchange="simulatePayment(event)" id="payment_method" name="payment"
                                    class="select-cust">
                                    <option>Cash</option>
                                    <option>Cheque</option>
                                    <option>Card</option>
                                </select>
                            </div>
                        </div>
                        <div style="display: none" id="ref_parent" class="row">
                            <div class="form-group">
                                <label for="">Cheque Ref Number</label>
                                <input type="text" id="ref_number">
                                <br>
                                <span style="font-size: .8rem; color:red" id="ref_info"></span>
                            </div>

                        </div>
                        {{-- card payment --}}
                        <div style="display: none" id="card_payment" class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="cc_name">Card Holder's Name</label>
                                    <input type="text" class="form-control" id="cc_name" pattern="\w+ \w+.*"
                                        title="First and last name" >
                                <span style="font-size: .8rem; color:red" id="card_name_info"></span>

                                </div>
                                <div class="form-group">
                                    <label>Card Number</label>
                                    <input id="card_number" type="text" class="form-control" autocomplete="off" maxlength="20"
                                        pattern="\d{16}" title="Credit card number">
                                <span style="font-size: .8rem; color:red" id="card_num_info"></span>


                                </div>
                                <div class="form-group row">
                                    <label class="col-md-12">Card Exp. Date</label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="cc_exp_mo" size="0">
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="cc_exp_yr" size="0">
                                            <option>2024</option>
                                            <option>2025</option>
                                            <option>2026</option>
                                            <option>2027</option>
                                            <option>2028</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="card_cvc" type="text" class="form-control" autocomplete="off" maxlength="3"
                                            pattern="\d{3}" title="Three digits at back of your card" 
                                            placeholder="CVC">
                                <span style="font-size: .8rem; color:red" id="cvc_info"></span>

                                        
                                    </div>
                                    {{-- <button class="btn btn-fill-out btn-block mb-30">Verify Card</button> --}}
                                </div>

                            </div>
                        </div>

                            {{-- end card payment --}}

                            <div id="" class="row">
                                <div class="form-group">
                                    <label for="">Amount</label>
                                    <input onchange="calculateBalances()" type="number" min="0" name="order_amount"  id="order_amount">
                                <span style="font-size: .8rem; color:red" id="amount_info"></span>

                                </div>
                            </div>

                            <div id="" class="row">
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
                                        My LP Balance: <span id="lp-amount"
                                            style="font-weight:bold; color: #292b2c">{{$lp?$lp:'0'}}</span> (Kshs {{$lp
                                        ? $lp*100 :'0'}} )
                                        <hr>


                                    </div>
                                    <div class="">
                                        <div class="">

                                            <label class="sr-only" for="filter-filter-v-price-gte">Points to
                                                Redeem</label>
                                            <br>
                                            <input onchange="checklp()" id="lp" name="lp" style="width: 100px;"
                                                type="number" placeholder="0" min="0">
                                            <br>
                                            <span style="font-size: .8rem; color:red" id="info"></span>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4 class="mt-30 mb-30">Grand Total: Kshs <span id="total"> </span> </h4>
                                    <div class="ml-20">
                                        <h6 class="mt-30 mb-30">Prepaid: Kshs  <span id="prepaid">{{$prepaid_amount}} </span> </h6>
                                        <h6 class="mt-30 mb-30">To Pay: Kshs <span id="order_to_pay"> </span> </h6>
                                        <h6 class="mt-30 mb-30">Balance: Kshs <span id="order_bal"> </span> </h6>
                                    </div>
                                   
                                    <hr>
                                    <input type="hidden" name="amt_balance" id="amt_balance">
                                </div>

                                <br>
                                <input type="text" id="otp" placeholder='Payment OTP confirmation'>
                                <br>
    

                                @csrf
                                <a  onclick="beforeSubmit()" class="btn btn-sm btn-fill-out btn-block mt-30">Update Order <i class="fi-rs-sign-out ml-15"></i></a>
                                <button hidden id="submit" type="submit" ></button>
                            </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
    </div>
    <input type="hidden" value="0" id="is_otp">
 
</main>

@yield('footer')

<script>
        
    $(document).ready(function(){

        
$('#otp').hide()
calculateBalances()
})

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
            console.log(sum);
        });
        total.innerText = sum - parseInt(discount)
        calculateBalances()
    }


    function is_empty(value) {
    return (
        value === null ||            // Check for null
        value === undefined ||       // Check for undefined
        value === "" ||              // Check for an empty string
        (Array.isArray(value) && value.length === 0) || // Check for an empty array
        (typeof value === "object" && Object.keys(value).length === 0) // Check for an empty object
    );
}
    // simulate payments
    //cheque
function simulatePayment(event){
    let method = event.target.value
    let ref_number = $('#ref_number')
    let ref_parent = $('#ref_parent')
    let card_parent = $('#card_payment')


    if (method == 'Cheque'){
        ref_parent.show()
        ref_number.focus()
    }

    else if(method == 'Card')
    {
        ref_parent.hide()
        card_parent.show()
    }

    else{
        ref_parent.hide()
        card_parent.hide()

    }

}


function beforeSubmit(){
     let prepaid = $('#prepaid').text()
    let amount = $('#order_amount').val()
    let total = $('#total').text()
    let balance = total - prepaid;
    let payment_method = $('#payment_method').val()
    if (payment_method == 'Cheque'){
        let ref_number = document.getElementById('ref_number')
        let ref_info = document.getElementById('ref_info')

       
        if (is_empty(ref_number.value)){

        ref_number.classList.add("redBorder")
        ref_info.textContent='Please fill cheque ref number'
        }
        else{
            ref_number.classList.remove("redBorder")
            ref_info.textContent=''
        if(amount_exists()){
                if(amount<=balance){
                    sendEmailOTP()
                }
                else{
                    toastr.error("Amount is greater than balance...");

                }
        }

    }

    }

    if (payment_method == 'Card'){
        let card_name = document.getElementById('cc_name')
        let card_number = document.getElementById('card_number')

        let card_cvc = document.getElementById('card_cvc')

        let cvc_info = document.getElementById('cvc_info')
        let card_name_info = document.getElementById('card_name_info')
        let card_num_info = document.getElementById('card_num_info')

        if (is_empty(card_name.value)){
            card_name.classList.add("redBorder")
            card_name_info.textContent='Please fill card holder\'s name'
        }
        else{
            card_name.classList.remove("redBorder")
            card_name_info.textContent=''
        }
        if (is_empty(card_number.value)){
            card_number.classList.add("redBorder")
            card_num_info.textContent='Please fill card Number'
        }
        else{
            card_number.classList.remove("redBorder")
            card_num_info.textContent=''
        }
         if (is_empty(card_cvc.value)){
            card_cvc.classList.add("redBorder")
            cvc_info.textContent='Please fill cvc'
        }
        else{
            card_cvc.classList.remove("redBorder")
            cvc_info.textContent=''
        }

        if(amount_exists()){
                if(amount<=balance){
                    sendEmailOTP()
                }
                else{
                    toastr.error("Amount is greater than balance...");

                }
        }
        
    }
    //amount must be there
    

    if (payment_method == 'Cash'){
       if(amount_exists()){
                if(amount<=balance){
                    sendEmailOTP()
                }
                else{
                    toastr.error("Amount is greater than balance...");

                }
        }
        else{
            toastr.error("Please enter amount ...");
        }
    }

    function amount_exists(){
        let order_amount = document.getElementById('order_amount')
         let amount_info = document.getElementById('amount_info')  
        if (is_empty(order_amount.value)){

            order_amount.classList.add("redBorder")
            amount_info.textContent='Please enter amount'
            return false
        }
        else{
            order_amount.classList.remove("redBorder")
            amount_info.textContent=''
            let total = $('#total')
            let amount = $('#order_amount')
            let order_bal = $('#order_bal')
            let order_to_pay = $('#order_to_pay')
            let prepaid = $('#prepaid')

            order_to_pay.text(amount.val())
            order_bal.text(total.text() - prepaid.text() - amount.val())

            return true
        }
    }



}


function calculateBalances(){
    let total = $('#total')
    let amount = $('#order_amount')
    let order_bal = $('#order_bal')
    let order_to_pay = $('#order_to_pay')
    let prepaid = $('#prepaid')
    let amt_balance = $('#amt_balance')


    order_to_pay.text(amount.val())
    amt_balance.val(total.text() - prepaid.text() - amount.val())
    order_bal.text(total.text() - prepaid.text() - amount.val())

}

function sendEmailOTP(){
     let otpinput = document.getElementById('otp')
     let otp = document.getElementById('is_otp')

      $('#otp').show()
       
     if(otp.value == 0){
        $.ajax({
            type: "GET",
            url: "/emailOTP"+ {{$cart_manager_id}},
            success: function (response) {
                otp.value=response.otp
               
            }
        });

     }
    if (otp.value != otpinput.value){

        otpinput.classList.add("redBorder")
        
    }
    else{
        otpinput.classList.remove("redBorder")
        $('#submit').click()
    }

}

</script>