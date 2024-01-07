@include('clientui.components.client-navbar')
@include('clientui.components.client-footer')

@yield('navbar')

<style>
    #tracking {
        background: #fff
    }

    .tracking-detail {
        padding: 3rem 0;
    }

    #tracking {
        margin-bottom: 1rem;
    }

    [class*="tracking-status-"] p {
        margin: 0;
        font-size: 1.1rem;
        color: #fff;
        text-transform: uppercase;
        text-align: center;
    }

    [class*="tracking-status-"] {
        padding: 1.6rem 0;
    }

    .tracking-list {
        /* border: 1px solid #e5e5e5; */
    }

    .tracking-item {
        border-left: 4px solid #78cd0e;
        position: relative;
        padding: 2rem 1.5rem 0.5rem 2.5rem;
        font-size: 0.9rem;
        margin-left: 3rem;
        min-height: 5rem;
    }

    .tracking-item:last-child {
        padding-bottom: 4rem;
    }

    .tracking-item .tracking-date {
        margin-bottom: 0.5rem;
    }

    .tracking-item .tracking-date span {
        color: #888;
        font-size: 85%;
        padding-left: 0.4rem;
    }

    .tracking-item .tracking-content {
        padding: 0.5rem 0.8rem;
        background-color: #f4f4f4;
        border-radius: 0.5rem;
    }

    .tracking-item .tracking-content span {
        display: block;
        color: #767676;
        font-size: 13px;
    }

    .tracking-item .tracking-icon {
        position: absolute;
        left: -0.7rem;
        width: 1.1rem;
        height: 1.1rem;
        text-align: center;
        border-radius: 50%;
        font-size: 1.1rem;
        background-color: #fff;
        color: #fff;
    }

    .tracking-item-pending {
        border-left: 4px solid #d6d6d6;
        position: relative;
        padding: 2rem 1.5rem 0.5rem 2.5rem;
        font-size: 0.9rem;
        margin-left: 3rem;
        min-height: 5rem;
    }

    .tracking-item-pending:last-child {
        padding-bottom: 4rem;
    }

    .tracking-item-pending .tracking-date {
        margin-bottom: 0.5rem;
    }

    .tracking-item-pending .tracking-date span {
        color: #888;
        font-size: 85%;
        padding-left: 0.4rem;
    }

    .tracking-item-pending .tracking-content {
        padding: 0.5rem 0.8rem;
        background-color: #f4f4f4;
        border-radius: 0.5rem;
    }

    .tracking-item-pending .tracking-content span {
        display: block;
        color: #767676;
        font-size: 13px;
    }

    .tracking-item-pending .tracking-icon {
        line-height: 2.6rem;
        position: absolute;
        left: -0.7rem;
        width: 1.1rem;
        height: 1.1rem;
        text-align: center;
        border-radius: 50%;
        font-size: 1.1rem;
        color: #d6d6d6;
    }

    .tracking-item-pending .tracking-content {
        font-weight: 600;
        font-size: 17px;
    }

    .tracking-item .tracking-icon.status-current {
        width: 1.9rem;
        height: 1.9rem;
        left: -1.1rem;
    }

    .tracking-item .tracking-icon.status-intransit {
        color: #78cd0e;
        font-size: 0.6rem;
    }

    .tracking-item .tracking-icon.status-current {
        color: #78cd0e;
        font-size: 0.6rem;
    }

    @media (min-width: 992px) {
        .tracking-item {
            margin-left: 10rem;
        }

        .tracking-item .tracking-date {
            position: absolute;
            left: -10rem;
            width: 7.5rem;
            text-align: right;
        }

        .tracking-item .tracking-date span {
            display: block;
        }

        .tracking-item .tracking-content {
            padding: 0;
            background-color: transparent;
        }

        .tracking-item-pending {
            margin-left: 10rem;
        }

        .tracking-item-pending .tracking-date {
            position: absolute;
            left: -10rem;
            width: 7.5rem;
            text-align: right;
        }

        .tracking-item-pending .tracking-date span {
            display: block;
        }

        .tracking-item-pending .tracking-content {
            padding: 0;
            background-color: transparent;
        }
    }

    .tracking-item .tracking-content {
        font-weight: 600;
        font-size: 17px;
    }

    .blinker {
        border: 7px solid #e9f8ea;
        animation: blink 1s;
        animation-iteration-count: infinite;
    }

    @keyframes blink {
        50% {
            border-color: #fff;
        }
    }

    #ordersearch {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        width: 60%;
        margin-bottom: 10px;

    }

    #ordersearch input {
        width: 300px;
        height: 40px;
        border-radius: 0px !important;

    }

    #ordersearch button {
        outline: none;
        border: none;
        background-color: #78cd0e;
        color: white;
        border-radius: 0px;
        font-size: .8rem;
        height: 40px;
        padding: 0 1rem;
    }

    #inputcontainer {
        display: flex;
        flex-direction: row;
    }
</style>
<main class="main ">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Order
                <span></span> Tracker
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">

        <div style="margin-left: 8rem">
            <div class="row" id="">
                <div id="ordersearch">
                    <span style="font-weight: bold; font-size:1.3rem">Track My Order </span>

                    <div id="inputcontainer">
                        <form action="{{ route('ordersearch') }}" method="POST">
                            @csrf
                            <input type="text" name="" placeholder="search order number" id="">

                            <button type="submit">Search</button>
                        </form>
                    </div>

                </div>

            </div>
            <h3 style="">Order Status</h3>
            <p style="text-decoration: underline; margin-left:10px; margin-top:10px">#{{ $order->order_number }}</p>
            <hr>
        </div>
        {{-- start html --}}
        <div class="container py-5 " style="padding-top:0px!important">

            <div class="row">

                <div class="col-lg-8">

                    <div id="tracking-pre"></div>
                    <div id="tracking">
                        <div class="tracking-list">
                            <div class="tracking-item">
                                <div
                                    class="tracking-icon 
                                @if ($order->status <= $step_numbers[0]) status-current blinker @else status-intransit @endif">
                                    <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                        data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="tracking-date"><img
                                        src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                        class="img-responsive" alt="order-placed" /></div>

                                <div class="tracking-content">{{ $steps[0] }}
                                    <span>
                                        @if ($order->status >= $step_numbers[0])
                                            {{ $dates[0] }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div
                                class="
                            @if ($order->status >= $step_numbers[1]) tracking-item  @else tracking-item-pending @endif
                            
                            ">
                                <div
                                    class="tracking-icon 
                                 @if ($order->status == $step_numbers[1]) status-current blinker @else status-intransit @endif">
                                    <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                        data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="tracking-date"><img
                                        src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                        class="img-responsive" alt="order-placed" /></div>
                                <div class="tracking-content">{{ $steps[1] }}
                                    <span>
                                        @if ($order->status >= $step_numbers[1])
                                            {{ $dates[1] }}
                                        @endif
                                    </span>

                                </div>
                            </div>
                            <div
                                class="
                            @if ($order->status >= $step_numbers[2]) tracking-item  @else tracking-item-pending @endif
                            
                            ">
                                <div
                                    class="tracking-icon
                                @if ($order->status == $step_numbers[2]) status-current blinker @else status-intransit @endif
                                ">
                                    <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                        data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="tracking-date"><img
                                        src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                        class="img-responsive" alt="order-placed" /></div>
                                <div class="tracking-content">{{ $steps[2] }}
                                    <span>
                                        @if ($order->status >= $step_numbers[2])
                                            {{ $dates[2] }}
                                        @endif
                                    </span>

                                </div>
                            </div>

                            <div
                                class="
                            @if ($order->status >= $step_numbers[3]) tracking-item  @else tracking-item-pending @endif

                            ">
                                <div
                                    class="tracking-icon
                                @if ($order->status == $step_numbers[3]) status-current blinker @else status-intransit @endif
                                ">
                                    <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                        data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="tracking-date"><img
                                        src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                        class="img-responsive" alt="order-placed" /></div>
                                <div class="tracking-content">{{ $steps[3] }}
                                    <span>
                                        @if ($order->status >= $step_numbers[3])
                                            {{ $dates[3] }}
                                        @endif
                                    </span>

                                </div>
                            </div>
                            <div class=" @if ($order->status >= $step_numbers[4]) tracking-item  @else tracking-item-pending @endif">
                                <div class="tracking-icon @if ($order->status == $step_numbers[4]) status-current blinker @else status-intransit @endif">
                                    <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                        data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="tracking-date"><img
                                        src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                        class="img-responsive" alt="order-placed" /></div>
                                <div class="tracking-content">{{ $steps[4] }}
                                    <span>
                                        @if ($order->status >= $step_numbers[4])
                                            {{ $dates[4] }}
                                        @endif
                                    </span>

                                </div>
                            </div>

                            <div class=" @if ($order->status >= $step_numbers[5]) tracking-item  @else tracking-item-pending @endif">
                                <div class="tracking-icon @if ($order->status == $step_numbers[5]) status-current blinker @else status-intransit @endif">
                                    <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas"
                                        data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="tracking-date"><img
                                        src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                        class="img-responsive" alt="order-placed" /></div>
                                <div class="tracking-content">{{ $steps[5] }}
                                    <span>
                                        @if ($order->status >= $step_numbers[5])
                                            {{ $dates[5] }}
                                        @endif
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 ">
                    <div class="card " style="margin-top:3rem">
                        <div class="card-header"
                            style="background-color: #78cd0e; color:white; padding-top:3rem; padding-bottom:3rem">
                            <p style="text-align:center;font-size:1.7rem; color:white">Stage {{ $order->status + 1 }}
                            </p>
                        </div>
                        <div class="card-body">
                            <p style="text-align: center; font-weight:bold; color:black;" class="name">
                                {{ $steps[$order->status] }}</p>
                            <hr>
                            <p style="text-align: center; padding-bottom:1rem">Order status is currently
                                {{ "'" . $steps[$order->status] . "'" }}. <br> The order was was updated on
                                {{ $dates[$order->status] }}</p>

                        </div>

                    </div>

                </div>
                <div class="col-1"></div>
            </div>
        </div>
        {{-- end html --}}
    </div>
</main>
@yield('footer')

@if (session('success'))
    <script>
        toastr["success"](" {{ session('success') }}");
    </script>
@endif
