<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>{{ config('app.name') }}</title>

      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{asset('landing/css/bootstrap.min.css')}}">
      <!-- style css -->
      <link rel="stylesheet" href="{{asset('landing/css/style.css')}}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{asset('landing/css/responsive.css')}}">

      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->

      <!-- end loader -->
      <div class="wrapper">
      <!-- end loader -->

      <div id="content">
         <!-- header -->
         <header>
            <!-- header inner -->
            <div class="header position-fixed">
               <div class="container-fluid ">
                  <div class="row ">
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section ">
                        <div class="full">
                           <div class="center-desk">
                              <div class="">
                                 <h1 class="text-white"><b>{{ config('app.name') }}</b></h1>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <ul class="btn">
                           <li class="down_btn"><a href="{{route('register')}}">Sign Up</a></li>
                           <li><a href="{{route('login')}}">Login</a></li>
                           {{-- <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li> --}}
                           <li>
                            <button type="button" id="">
                              </button>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <!-- end header inner -->
         <!-- end header -->
         <!-- banner -->
         <div id="" class=" banner_main " data-ride="carousel" style="">

            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container-fluid">
                     <div class="carousel-caption">
                        <div class="row">
                           <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                              <div class="text-bg">
                                 <h1>Get<br>Real time insights<br></h1>
                                 <p>
                                    identify new market opportunities, pinpoint loopholes in the customer journey, conduct competitor analysis, and determine your brand's position in the market.

                                </p>
                                 <a class="read_more" href="{{route('register')}}">Get Started</a>
                              </div>
                           </div>
                           <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                              <div class="images_box">
                                 <figure><img src="{{asset('landing/images/img2.png')}}"></figure>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>

         </div>
         <!-- end banner -->

      </div>
      <div class="overlay"></div>


   </body>
</html>

