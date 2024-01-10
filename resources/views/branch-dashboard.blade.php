@include('components.navbar')
@include('components.footer')

@yield('navbar')
<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="me-4 mb-3 mb-sm-0">
                <h1 class="mb-0">{{ucfirst($branch->branch_name)}} Dashboard</h1>
                <div class="small">
                    <span class="fw-500 text-primary">{{
                        \Carbon\Carbon::now()->timezone('Africa/Nairobi')->englishDayOfWeek }}</span>
                    ·
                    {{ \Carbon\Carbon::now()->format('F d') }},{{ ' ' }}{{
                    \Carbon\Carbon::now()->timezone('Africa/Nairobi')->format('Y') }}
                    · {{ \Carbon\Carbon::now()->timezone('Africa/Nairobi')->format('g:i A') }}
                </div>
            </div>
            <!-- Date range picker example-->


            <div class="input-group input-group-joined border-0 shadow" style="width: 16.5rem">
                <select onchange="getBranch()" class="form-control" name="" id="branch-select">
                    <option value="">Select Branch</option>
                    @foreach ($branches as $item)
                    <option value="{{$item->id}}">{{$item->branch_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">Total Orders ({{$branch->branch_name}})
                                </div>
                                <div class="h5">{{$total_orders}}</div>
                                <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-trending-up me-1">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg> --}}

                                </div>
                            </div>
                            <div class="ms-2"><svg class="svg-inline--fa fa-dollar-sign fa-2x text-gray-200"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="dollar-sign"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M146 0c17.7 0 32 14.3 32 32V67.7c1.6 .2 3.1 .4 4.7 .7c.4 .1 .7 .1 1.1 .2l48 8.8c17.4 3.2 28.9 19.9 25.7 37.2s-19.9 28.9-37.2 25.7l-47.5-8.7c-31.3-4.6-58.9-1.5-78.3 6.2s-27.2 18.3-29 28.1c-2 10.7-.5 16.7 1.2 20.4c1.8 3.9 5.5 8.3 12.8 13.2c16.3 10.7 41.3 17.7 73.7 26.3l2.9 .8c28.6 7.6 63.6 16.8 89.6 33.8c14.2 9.3 27.6 21.9 35.9 39.5c8.5 17.9 10.3 37.9 6.4 59.2c-6.9 38-33.1 63.4-65.6 76.7c-13.7 5.6-28.6 9.2-44.4 11V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V445.1c-.4-.1-.9-.1-1.3-.2l-.2 0 0 0c-24.4-3.8-64.5-14.3-91.5-26.3C4.9 411.4-2.4 392.5 4.8 376.3s26.1-23.4 42.2-16.2c20.9 9.3 55.3 18.5 75.2 21.6c31.9 4.7 58.2 2 76-5.3c16.9-6.9 24.6-16.9 26.8-28.9c1.9-10.6 .4-16.7-1.3-20.4c-1.9-4-5.6-8.4-13-13.3c-16.4-10.7-41.5-17.7-74-26.3l-2.8-.7 0 0C105.4 279.3 70.4 270 44.4 253c-14.2-9.3-27.5-22-35.8-39.6C.3 195.4-1.4 175.4 2.5 154.1C9.7 116 38.3 91.2 70.8 78.3c13.3-5.3 27.9-8.9 43.2-11V32c0-17.7 14.3-32 32-32z">
                                    </path>
                                </svg>
                                <!-- <i class="fas fa-dollar-sign fa-2x text-gray-200"></i> Font Awesome fontawesome.com -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 2-->
                <div class="card border-start-lg border-start-secondary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-secondary mb-1">Surveys Sent</div>
                                <div class="h5">{{$total_surveys_sent}}</div>
                                <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-trending-down me-1">
                                        <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
                                        <polyline points="17 18 23 18 23 12"></polyline>
                                    </svg>

                                </div>
                            </div>
                            <div class="ms-2"><svg class="svg-inline--fa fa-tag fa-2x text-gray-200" aria-hidden="true"
                                    focusable="false" data-prefix="fas" data-icon="tag" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M0 80V229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7H48C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z">
                                    </path>
                                </svg>
                                <!-- <i class="fas fa-tag fa-2x text-gray-200"></i> Font Awesome fontawesome.com -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 3-->
                <div class="card border-start-lg border-start-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-success mb-1">Surveys Completed</div>
                                <div class="h5">{{$total_surveys_received}}</div>
                                <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-trending-up me-1">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                        <polyline points="17 6 23 6 23 12"></polyline>
                                    </svg>

                                </div>
                            </div>
                            <div class="ms-2"><svg class="svg-inline--fa fa-arrow-pointer fa-2x text-gray-200"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-pointer"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M0 55.2V426c0 12.2 9.9 22 22 22c6.3 0 12.4-2.7 16.6-7.5L121.2 346l58.1 116.3c7.9 15.8 27.1 22.2 42.9 14.3s22.2-27.1 14.3-42.9L179.8 320H297.9c12.2 0 22.1-9.9 22.1-22.1c0-6.3-2.7-12.3-7.4-16.5L38.6 37.9C34.3 34.1 28.9 32 23.2 32C10.4 32 0 42.4 0 55.2z">
                                    </path>
                                </svg>
                                <!-- <i class="fas fa-mouse-pointer fa-2x text-gray-200"></i> Font Awesome fontawesome.com -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 4-->
                <div class="card border-start-lg border-start-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-info mb-1">Average Rating</div>
                                <div class="h5">{{$total_average_rating ?? 0}}</div>
                                <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-trending-down me-1">
                                        <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline>
                                        <polyline points="17 18 23 18 23 12"></polyline>
                                    </svg> --}}

                                </div>
                            </div>
                            <div class="ms-2"><svg class="svg-inline--fa fa-percent fa-2x text-gray-200"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="percent"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M374.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-320 320c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l320-320zM128 128A64 64 0 1 0 0 128a64 64 0 1 0 128 0zM384 384a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z">
                                    </path>
                                </svg>
                                <!-- <i class="fas fa-percentage fa-2x text-gray-200"></i> Font Awesome fontawesome.com -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-8">
                <!-- Bar chart example-->
                <div class="card h-100 ">
                    <div class="card-header">Average Rating distribution ({{$branch->branch_name}})</div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="chart-bar">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div><canvas id="branchRatingChart" width="566" height="480" class="chartjs-render-monitor"
                                style="display: block; width: 283px; height: 240px;"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <!-- Pie chart example-->
                <div class="card">
                    <div class="card-header">Feedback Sentiment</div>
                    <div class="card-body">
                       
                        <div class="chart-pie mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div><canvas id="chDonut1" width="414" height="264"
                                style="display: block; height: 240px; width: 377px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-8 mb-4">
                <!-- Area chart example-->
                <div class="card mb-4">
                    <div class="card-header">Sentiment Distribution ({{$branch->branch_name}})</div>
                    <div class="card-body">
                        <div class="chart-area">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div><canvas id="sentimentLineChart" width="454" height="120"
                                style="display: block; height: 300px; width: 413px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">
                <!-- Pie chart example-->
                <div class="card ">
                    <div class="card-header">Response By Gender</div>
                    <div class="card-body">
                        
                        <div class="chart-pie mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div><canvas id="genderPie" width="414" height="264"
                                style="display: block; height: 300px; width: 377px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</main>


@yield('footer')

<script>
    function getBranch(){
        // get value by id branch-id
       let id = document.getElementById('branch-select').value ;
        if(id){
            let url = '{{route("branchDashboard")}}'+'?bid='+id
            window.location.href=url;
        }
    }
    
    branchRatingBarChart(@json($avg_rating_pm))
    SentimentLineChart(@json($positive_sentiments),@json($negative_sentiments))
    responsePie(@json($sentiment_pie))
    feedbackPie(@json($feedback_pie))
</script>