@include('clientui.components.client-navbar')
@include('clientui.components.client-footer')

@yield('navbar')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Shop</a>
                 {{ $product->name }}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider slick-initialized slick-slider">
                                    <div class="slick-list draggable">
                                        <div class="slick-track"
                                            style="opacity: 1; width: 5025px; transform: translate3d(-335px, 0px, 0px);">
                                            <figure class="border-radius-10 slick-slide slick-cloned"
                                                data-slick-index="-1" id="" aria-hidden="true" tabindex="-1"
                                                style="width: 335px;">
                                            </figure>
                                            <figure class="border-radius-10 slick-slide slick-current slick-active"
                                                data-slick-index="0" aria-hidden="false" tabindex="0"
                                                style="width: 335px;">
                                                <img width="335px" src="data:image/png;base64,{{$product->url}}" alt="product image">
                                            </figure>
                                            
                                     
                                        </div>
                                    </div>

                                </div>
                                <!-- THUMBNAILS -->
                           
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <h2 class="title-detail">{{$product->title}}</h2>
                                <div class="product-detail-rating">

                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">Kshs {{$product->price}}</span>

                                    </div>
                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg">{{$product->description}}</p>
                                </div>

                                <div class="detail-extralink mb-50">
                                    {{-- <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="quantity" class="qty-val" value="1"
                                            min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div> --}}
                                    <div class="product-extra-link2">
                                        <button onclick="addtocart({{$product->id}})" type="submit" class="button button-add-to-cart"><i
                                                class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>

                            </div>
                            <!-- Detail Info -->
                            
                        </div>
                    </div>
                    <div class="row mt-60">
                        <div class="col-12">
                            <h2 class="section-title style-1 mb-30">Related products</h2>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                                @foreach ($products as $product)
                                
                                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 " >
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{route('product-details',['id'=>$product->id])}}">
                                                    <img class="default-img" src="data:image/png;base64,{{$product->url}}" alt="">
                                                </a>
                                            </div>
                                            <div class="product-action-1">

                                            </div>
                                            <div
                                                class="product-badges product-badges-position product-badges-mrg">
                                                <span class="sale">Sale</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">

                                            <h2><a
                                                    href="#">{{ $product->title }}</a>
                                            </h2>
                                            <div class="product-rate-cover">

                                            </div>
                                            <div>
                                                <span class="font-small text-muted">By <a
                                                        href="#">Admin</a></span>
                                            </div>
                                            <div class="product-card-bottom">
                                                <div class="product-price">
                                                    <span>Kshs {{$product->price}}</span>

                                                </div>
                                                <div class="add-cart">
                                                    {{-- <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a> --}}
                                                    <button onclick="addtocart({{$product->id}})" id="add-cart" style="color: #3BB77E; border:none;"  class="add"><i class="fi-rs-shopping-cart mr-5"></i>Add </button>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                  

                </div>
            </div>
        </div>
    </div>
</main>
<input type="hidden" id="loginId" @if (Auth::check())
    value="true" @endif>

@yield('footer')

<script>
    function updateCart(){
    $.ajax({
            type: "GET",
            url: "{{route('cartcount')}}",
            success: function (response) {

                $('.pro-count').each(function(){
                    $(this).html(response.count);
                });
            }
        });
    }
    function addtocart(id) {
        // get value input id loginId
        var loginId = document.getElementById('loginId').value;
        // if not null redirect to login page
        if (loginId !== 'true') {
            window.location.href = "{{ route('login') }}";
        }

        $.ajax({
            url: "{{ route('addtocart') }}",
            type: "POST",
            data: {
                id: id,
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                updateCart()

                if (response.redirect) {
                    window.location.href = response.redirect;
                } else if (response.error) {

                    toastr["error"](response.error);

                } else {
                    toastr["success"](response.success);
                }
            },

            error: function(response) {
                console.log(response.error);

            },
        });
    }

</script>