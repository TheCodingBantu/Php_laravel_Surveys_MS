@include('components.navbar')
@include('components.footer')

@yield('navbar')

<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="me-4 mb-3 mb-sm-0">
                <h1 class="mb-1">{{ $greeting }}</h1>
                <div class="small">
                    <span
                        class="fw-500 text-primary">{{ \Carbon\Carbon::now()->timezone('Africa/Nairobi')->englishDayOfWeek }}</span>
                    ·
                    {{ \Carbon\Carbon::now()->format('F d') }},{{ ' ' }}{{ \Carbon\Carbon::now()->timezone('Africa/Nairobi')->format('Y') }}
                    · {{ \Carbon\Carbon::now()->timezone('Africa/Nairobi')->format('g:i A') }}
                </div>
            </div>
            <!-- Date range picker example-->

        </div>




        <div class="row">
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Total Customers</div>
                                <div class="text-lg fw-bold">{{ $customers }}</div>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-calendar feather-xl text-white-50">
                                <rect x="3" y="4" width="18" height="18" rx="2"
                                    ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Total Sent</div>
                                <div class="text-lg fw-bold">{{ $sent }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-calendar feather-xl text-white-50">
                                <rect x="3" y="4" width="18" height="18" rx="2"
                                    ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Total Responses</div>
                                <div class="text-lg fw-bold">{{ $responses }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-check-square feather-xl text-white-50">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-xl-3 mb-4">
                <div class="card bg-danger text-white h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-3">
                                <div class="text-white-75 small">Total Branches</div>
                                <div class="text-lg fw-bold">{{ $branches }}</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-message-circle feather-xl text-white-50">
                                <path
                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                </path>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">
                                    Sent Today
                                </div>
                                <div class="h1">
                                    {{ $sent_today }}
                                </div>

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
                                <div class="small fw-bold text-secondary mb-1">Responded Today</div>
                                <div class="h1">
                                    {{ $responses_today }}
                                </div>
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
                                <div class="small fw-bold text-success mb-1">Current Average Rating</div>
                                <div class="h1">
                                    {{ $current_average_rating }}
                                </div>
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
                                <div class="small fw-bold text-info mb-1">
                                    Overrall Average Rating
                                </div>
                                <div class="h1">
                                    {{ $total_average_rating }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="">
                <!-- Area chart example-->
                <div class="card mb-4">
                    <div class="card-header">Feedback distribution</div>
                    <div class="card-body">
                        <div class="chart-area">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div><canvas id="myAreaChart" width="1749" height="479"
                                style="display: block; height: 240px; width: 875px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <!-- Bar chart example-->
                <div class="card h-100 ">
                    <div class="card-header text-success">Client Responses</div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="chart-bar">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div><canvas id="myBarChart" width="566" height="480"
                                class="chartjs-render-monitor"
                                style="display: block; width: 283px; height: 240px;"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <!-- Pie chart example-->
                <div class="card h-100">
                    <div class="card-header">NPS Score</div>
                    <div class="card-body">
                        NPS: SCORE: {{ $nps_temp }}
                        <div class="chart-pie mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div><canvas id="myPieChart" width="978" height="480"
                                style="display: block; height: 240px; width: 489px;"
                                class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-6">
                <!-- Team members / people dashboard card example-->
                <div class="card mb-4">
                    <div class="card-header">Response Engagement by Location</div>
                    <div class="card-body">
                        <!-- Item 1-->
                        @isset($feeback_by_location)

                            @foreach ($feeback_by_location as $key => $value)
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center flex-shrink-0 me-3">
                                        <div class="d-flex flex-column fw-bold">
                                            <a class="text-dark line-height-normal mb-1"
                                                href="#!">{{ $key }}</a>
                                        </div>
                                    </div>
                                    <div>{{ $value }}</div>
                                </div>
                            @endforeach
                        @endisset

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <!-- Pie chart example-->
                <div class="card h-100">
                    <div class="card-header">Demographic</div>

                    <div class="card-body">

                        <div class="list-group list-group-flush">
                            @isset($gender_distribution)
                                @foreach ($gender_distribution as $key => $value)
                                    <div
                                        class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            {{ $key }}
                                        </div>
                                        <div class="fw-500 text-dark">{{ $value }}</div>
                                    </div>
                                @endforeach

                            @endisset
                        </div>
                    </div>
                    <div class="card-header">Age</div>

                    <div class="card-body">

                        <div class="list-group list-group-flush">
                            @isset($age_distribution)
                                @foreach ($age_distribution as $key => $value)
                                    <div
                                        class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            {{ $key }}
                                        </div>
                                        <div class="fw-500 text-dark">{{ $value }}</div>
                                    </div>
                                @endforeach

                            @endisset

                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    </div>

</main>

@yield('footer')
<script>
    showChart(@json($feedbackPerMonthArray));

    showBarChart(@json($rating_types))
    showPie(@json($nps))
</script>
