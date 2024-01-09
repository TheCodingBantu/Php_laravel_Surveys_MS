@include('clientui.components.client-navbar')
@include('clientui.components.client-footer')

@yield('navbar')
<div class="container">
    <section class="content-main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> responses
                </div>
            </div>
        </div>
        <div class="content-header">
            <div>
                <h4  class="mt-20 mb-20 content-title card-title">My Responses</h4>
            </div>
            
        </div>
        <div class="card mb-4">
            <header class="card-header">
                {{-- <div class="row gx-3">
                    <div class="col-lg-4 col-md-6 me-auto">
                        <input type="text" placeholder="Search..." class="form-control">
                    </div>
                    <div class="col-lg-2 col-6 col-md-3">
                        <select class="form-select">
                            <option>Status</option>
                            <option>Active</option>
                            <option>Disabled</option>
                            <option>Show all</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-6 col-md-3">
                        <select class="form-select">
                            <option>Show 20</option>
                            <option>Show 30</option>
                            <option>Show 40</option>
                        </select>
                    </div>
                </div> --}}
            </header>
            <!-- card-header end// -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Comments</th>
                                <th scope="col">Overall Experience</th>
                                <th scope="col">Reason</th>
                                {{-- <th scope="col" class="text-end">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($responses as $response)
                            <tr>
                                <td>{{$response->id}}</td>
                                <td>{{$response->rating}}</td>
                                <td @if ($response->rating_sentiment == 'negative')
                                style='color:red' @else style='color:green'
                                @endif >  {{ucfirst($response->rating_comments)}}</td>
                                <td>{{$response->overall_rating}}</td>
                                
                                <td @if ($response->rating_sentiment == 'positive')
                                    style='color:red' @else style='color:green'
                                    @endif >  {{ucfirst($response->overall_comments)}}</td>
                                <td class="text-end">
                                    {{-- <a href="{{route('invoice' ,$order->id)}} " class="btn btn-sm rounded font-sm">Details</a> --}}
                                    {{-- <a href="{{route('ordertracking')}} " class="btn btn-sm rounded font-sm">Details</a> --}}
                                    
                                    <!-- dropdown //end -->
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive //end -->
            </div>
            <!-- card-body end// -->
        </div>
        <!-- card end// -->

    </section>
</div>
@yield('footer')
