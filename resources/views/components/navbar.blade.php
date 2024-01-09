@section('navbar')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        {{-- bootstrap css --}}

        <title>Macho Poa Dashboard</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="#" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
        <!-- font awesome 6.1.1/js/all.min.js cdn-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script data-search-pseudo-elements="" defer=""
            src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">

        </script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    </head>
    <style>
        .icon-badge-group {}

        .icon-badge-group .icon-badge-container {
            display: inline-block;
            margin-left: 15px;
        }

        .icon-badge-group .icon-badge-container:first-child {
            margin-left: 0
        }

        .icon-badge-container {
            margin-top: 20px;
            margin-right: 20px;
            position: relative;
        }

        .icon-badge-icon {
            font-size: 20px;
            position: relative;
        }

        .icon-badge {
            background-color: red;

            font-size: 10px;
            color: white;
            text-align: center;
            width: 15px;
            height: 15px;
            border-radius: 100%;
            position: absolute;
            /* changed */
            top: -5px;
            /* changed */
            left: 10px;
            /* changed */
        }
        #site{
            background-color: #e7e3e3;
            text-decoration: none;
            color: black;
            padding: 0.5rem;
            padding-left: 1.1rem;
            margin-bottom: 2rem;
            margin-top: 1rem;
            width: 100%;
            font-weight:bold;
            cursor: pointer;

        }
        #site:hover{
            color: blueviolet;
        }
    </style>

    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
            id="sidenavAccordion">
            <!-- Sidenav Toggle Button-->
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i
                    data-feather="menu"></i></button>

            
                    
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="{{ route('dashboard') }}">E Survey</a>

            <form class="form-inline me-auto d-none d-lg-block me-3">
                <div class="input-group input-group-joined input-group-solid">
                    {{-- <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" /> --}}
                    {{-- <div class="input-group-text"><i data-feather="search"></i></div> --}}
                </div>
            </form>
            <!-- Navbar Items-->
            <ul class="navbar-nav align-items-center ms-auto">

                <li class="nav-item dropdown no-caret me-3 d-lg-none">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            data-feather="search"></i></a>
                    <!-- Dropdown - Search-->
                    <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline me-auto w-100">
                            <div class="input-group input-group-joined input-group-solid">
                                <input class="form-control pe-0" type="text" placeholder="Search for..."
                                    aria-label="Search" aria-describedby="basic-addon2" />
                                <div class="input-group-text"><i data-feather="search"></i></div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item  no-caret d-sm-block me-3"><a target="__blank" href="{{route('home')}}">Macho Poa Site</a></li>
                <!-- Alerts Dropdown-->
                <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">


                    <div class="icon-badge-container" data-bs-toggle="dropdown">

                        <i class=" far fa-bell icon-badge-icon" role="button" onclick="markAsRead()"></i>
                        <div class="icon-badge">{{ count(Auth::User()->notifications) }}</div>
                    </div>

                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                        aria-labelledby="navbarDropdownAlerts">
                        <h6 class="dropdown-header dropdown-notifications-header">
                            <i class="me-2" data-feather="bell"></i>
                            Notifications
                        </h6>
                        <!-- Example Alert 1-->
                        @foreach (Auth::User()->notifications as $notification)
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="{{$notification->data['data']}}" class="dropdown-item dropdown-notifications-item" href="#!">
                                <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i>
                                </div>
                                <div class="dropdown-notifications-item-content">
                                    <div class="dropdown-notifications-item-content-details">{{ $notification->created_at }}
                                    </div>
                                    <div class="dropdown-notifications-item-content-text">{{ $notification->data['data'] }}
                                    </div>
                                </div>
                            </a>
                        @endforeach


                    </div>
                </li>

                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                        href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><img class="img-fluid"
                            src="{{asset('assets/img/illustrations/profiles/profile-1.png')}}" /></a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                        aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="{{asset('assets/img/illustrations/profiles/profile-1.png')}}" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name">{{ Auth::User()->name }}</div>
                                <div class="dropdown-user-details-email"><a href="#">{{ Auth::User()->email }}</a>
                                </div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('profile.edit', Auth::User()->id) }}">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Account
                        </a>
                        {{-- logout form --}}
                        <form action="{{ route('logout') }}" id="logout-form" method="POST">
                            @csrf

                            <a class="dropdown-item " role="button"
                                onclick="document.getElementById('logout-form').submit()">
                                <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                Logout
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">


                            <!-- Sidenav Heading (Custom)-->
                            <div class="sidenav-menu-heading"></div>
                            {{-- <a id="site" href="{{route('home')}}" target="__blank">Macho Poa Site</a> --}}

                            <!-- Sidenav Accordion (Pages)-->
                            {{-- <a class="nav-link  @if (url()->current()==route('dashboard'))active @endif " href="{{ route('dashboard') }}"> --}}
                                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                                data-bs-target="#collapsedashboard" aria-expanded="false" aria-controls="collapseApps">
                                <div class="nav-link-icon"><i data-feather="grid"></i></div>
                                Dashboards
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                
                                <div class="@if (url()->current()==route('dashboard')||url()->current()==route('branchDashboard'))@else collapse @endif"

                                    id="collapsedashboard" data-bs-parent="#accordionSidenav">
                                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenus">
                        
                                            <a class="nav-link @if (url()->current()==route('dashboard')) active @endif " href="{{ route('dashboard') }}">
                                                General
                                            </a>
                                            <a class="nav-link @if (url()->current()==route('branchDashboard')) active @endif " href="{{ route('branchDashboard') }}">
                                                Branch
                                            </a>
                                        </nav>
                                    </div>

                                <!-- Sidenav Accordion (Applications)-->
                                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                                    data-bs-target="#collapseApps" aria-expanded="false" aria-controls="collapseApps">
                                    <div class="nav-link-icon"><i data-feather="globe"></i></div>
                                    Customers
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="@if (url()->current()==route('customers')||url()->current()==route('addCustomer')||url()->current()==route('csv-preview'))@else collapse @endif"

                                id="collapseApps" data-bs-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                                        <a class="nav-link @if (url()->current()==route('customers')) active @endif " href="{{ route('customers') }}">
                                            Customer List
                                        </a>

                                        <a class="nav-link @if (url()->current()==route('addCustomer')) active @endif " href="{{ route('addCustomer') }}">
                                            Add Customer
                                        </a>
                                        <a class="nav-link @if (url()->current()==route('csv-preview')) active @endif " href="{{ route('csv-preview') }}">
                                            Upload CSV
                                        </a>
                                    </nav>
                                </div>

                            <!-- Sidenav Accordion (Flows)-->
                            <a class="nav-link  @if (url()->current()==route('feedback'))active @endif" href="{{route('feedback')}}">
                                <div class="nav-link-icon"><i data-feather="repeat"></i></div>
                                Feedback
                            </a>

                                {{-- <a class="nav-link  @if (url()->current()==route('visits'))active @endif" href="{{ route('visits') }}">
                                    <div class="nav-link-icon"><i data-feather="layout"></i></div>
                                    Visits
                                </a> --}}

                                <!-- Sidenav Accordion (Components)-->
                                <a class="nav-link
                                @if (url()->current()==route('branches'))active @endif
                                " href="{{ route('branches') }}">
                                    <div class="nav-link-icon"><i data-feather="package"></i></div>
                                     Branches
                                </a>

                                <a class="nav-link
                                @if (url()->current()==route('adminorders'))active @endif
                                " href="{{ route('adminorders') }}">
                                    <div class="nav-link-icon"><i data-feather="package"></i></div>
                                     Orders
                                </a>



                        </div>
                    </div>
                    <!-- Sidenav Footer-->
                    <div class="sidenav-footer">
                        <div class="sidenav-footer-content">
                            <div class="sidenav-footer-subtitle">Logged in as:</div>
                            <div class="sidenav-footer-title">{{ Auth::User()->name }}</div>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                {{-- toast --}}
                <div style="position: absolute; bottom: 1rem; right: 1rem;">
                    <!-- Toast -->
                    <div class="toast" id="toastBasic" role="alert" aria-live="assertive" aria-atomic="true"
                        data-bs-delay="3000">
                        <div class="toast-header">
                            <i data-feather="bell"></i>
                            <strong class="mr-auto">Toast with Autohide</strong>
                            <small class="text-muted ml-2">just now</small>
                            <button class="ml-2 mb-1 btn-close" type="button" data-bs-dismiss="toast"
                                aria-label="Close"> </button>
                        </div>
                        <div class="toast-body">This is an example toast alert, it will dismiss automatically, or you can
                            dismiss it manually.</div>
                    </div>
                </div>
            @stop
