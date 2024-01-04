<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="{{asset('form/assets/css/bootstrap/bootstrap.min.css')}}">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="{{asset('form/assets/fontawesome/all.min.css')}}">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{asset('form/assets/css/style.css')}}">

    <!-- responsive -->
    <link rel="stylesheet" href="{{asset('form/assets/css/responsive.css')}}">

    <!-- animation -->
    <link rel="stylesheet" href="{{asset('form/assets/css/animation.css')}}">

</head>

<body>
    <main class="overflow-hidden">
        <div class="logo">
        </div>

        <div class="container">
            <div class="wrapper">
                <h3 style="text-align:center; font-weight:bold; margin-bottom:1.5rem " >Feedback Survey</h3>
                <div class="row">
                    
                    <div class="col-md-6 rating-reveal tab-100 mx-auto">
                        

                        <div class="productRating">
                            <form method="post" novalidate action="{{route('feedback-post')}}">
                                @csrf
                                <h2 class="ratingHead">How would you rate the branch experience from 1-10</h2>

                                <div class="ratingBar">
                                    <div class="rangeNumber">
                                        <span class="number active">0</span>
                                        <span class="number">1</span>
                                        <span class="number">2</span>
                                        <span class="number">3</span>
                                        <span class="number">4</span>
                                        <span class="number">5</span>
                                        <span class="number">6</span>
                                        <span class="number">7</span>
                                        <span class="number">8</span>
                                        <span class="number">9</span>
                                        <span class="number">10</span>
                                    </div>
                                    <input type="range" name="rating" id="bar" min="0" max="10" value="0" step="0.01">
                                    <div class="likeThumb">
                                        <div class="thumbsingle">
                                            <img src="{{asset('form/assets/images/thumbDown.png')}}" alt="thumb">
                                            <p>Not At all Likely</p>
                                        </div>
                                        <div class="thumbsingle">
                                            <p>Extremely Likely</p>
                                            <img src="{{asset('form/assets/images/thumbUp.png')}}" alt="thumb">
                                        </div>
                                    </div>
                                </div>
                                <h2 class="ratingHead">Please explain the above rating</h2>

                                <textarea name="rating_comments" id="maesage"></textarea>


                                <h2 class="ratingHead">How would you rate your overall shopping experience from 1-10</h2>

                                <div class="ratingBar">
                                    <div class="rangeNumber" id="rangeNumber">
                                        <span class="number active">0</span>
                                        <span class="number">1</span>
                                        <span class="number">2</span>
                                        <span class="number">3</span>
                                        <span class="number">4</span>
                                        <span class="number">5</span>
                                        <span class="number">6</span>
                                        <span class="number">7</span>
                                        <span class="number">8</span>
                                        <span class="number">9</span>
                                        <span class="number">10</span>
                                    </div>
                                    <input type="range" name="overall_rating" id="rating" min="0" max="10" value="0" step="0.01" placeholder="Please comment here ...">
                                    <input type="hidden" name="uid" value="{{ app('request')->input('uid') }}">
                                    <input type="hidden" name="token" value="{{ app('request')->input('token') }}">
                                    <div class="likeThumb">
                                        <div id="thumbsingle">
                                            <img src="{{asset('form/assets/images/thumbDown.png')}}" alt="thumb">
                                            <p>Aweful</p>
                                        </div>
                                        <div id="thumbsingle">
                                            <img src="{{asset('form/assets/images/thumbUp.png')}}" alt="thumb">
                                            <p>Awesome</p>

                                        </div>
                                    </div>
                                </div>

                                <h2 class="ratingHead">Please explain the above rating</h2>

                                <textarea name="overall_comments" id="maesage"></textarea>

                                <button class="btn btn-success" id="sub" type="submit">Send Feedback</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Bootstrap 5 -->
    <script src="{{asset('form/assets/js/bootstrap/bootstrap.min.js')}}"></script>

    <!-- jQuery -->
    <script src="{{asset('form/assets/js/jQuery/jquery-3.6.4.min.js')}}"></script>

    <!-- My JS -->
    <script src="{{asset('form/assets/js/custom.js')}}"></script>
</body>
<script>
    function values(){
       console.log( $('#rating').val());
       console.log( $('#bar').val());
    }
</script>
</html>
