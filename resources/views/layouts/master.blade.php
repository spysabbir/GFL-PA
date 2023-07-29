<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta name="author" content="{{ env('APP_NAME') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" href="favicon.ico" type="image/x-icon"/>

    <title>:: {{ env('APP_NAME') }} :: @yield('title')</title>

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/bootstrap/css/bootstrap.min.css" />

    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/charts-c3/c3.min.css"/>
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/jvectormap/jvectormap-2.0.3.css" />

    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/toastr/toastr.css">

    <!-- Core css -->
    <link rel="stylesheet" href="{{ asset('asset') }}/css/main.css"/>
    <link rel="stylesheet" href="{{ asset('asset') }}/css/theme1.css" id="stylesheet"/>
</head>

<body class="font-opensans iconcolor sidebar_dark">

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>

    <!-- Start main html -->
    <div id="main_content">

        <!-- Small icon top menu -->
        <div id="header_top" class="header_top">
            <div class="container">
                <div class="hleft">
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="nav-link user_btn"><img class="avatar" src="{{ asset('asset') }}/images/user.png" alt=""/></a>
                        @php
                            if (Auth::user()->role == 'Admin') {
                                $url = url('admin/dashboard');
                            } elseif (Auth::user()->role == 'Employee') {
                                $url = url('employee/dashboard');
                            }else {
                                $url = url('user/dashboard');
                            }
                        @endphp
                        <a href="{{ $url }}" class="nav-link icon"><i class="fa fa-home"></i></a>
                        <a href="javascript:void(0)"  class="nav-link icon app_inbox"><i class="fa fa-envelope"></i></a>
                        <a href="javascript:void(0)"  class="nav-link icon xs-hide"><i class="fa fa-comments"></i></a>
                        <a href="javascript:void(0)"  class="nav-link icon xs-hide"><i class="icon-calendar"></i></a>
                        <a href="javascript:void(0)"  class="nav-link icon xs-hide"><i class="icon-notebook"></i></a>
                        <a href="javascript:void(0)"  class="nav-link icon app_file xs-hide"><i class="fa fa-folder"></i></a>
                    </div>
                </div>
                <div class="hright">
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="nav-link icon settingbar"><i class="fa fa-bell"></i></a>
                        <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa fa-navicon"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification and  Activity-->
        <div id="rightsidebar" class="right_sidebar">
            <a href="javascript:void(0)" class="p-3 settingbar float-right"><i class="fa fa-close"></i></a>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#notification" aria-expanded="true">Notification</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#activity" aria-expanded="false">Activity</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane   active" id="notification" aria-expanded="true">
                    <ul class="list-unstyled feeds_widget">
                        <li>
                            <div class="feeds-left"><i class="fa fa-check"></i></div>
                            <div class="feeds-body">
                                <h4 class="title text-danger">Issue Fixed</h4>
                                <small>WE have fix all Design bug with Responsive</small>
                                <small class="text-muted">11:05</small>
                            </div>
                        </li>
                        <li>
                            <div class="feeds-left"><i class="fa fa-user"></i></div>
                            <div class="feeds-body">
                                <h4 class="title">New User</h4>
                                <small>I feel great! Thanks team</small>
                                <small class="text-muted">10:45</small>
                            </div>
                        </li>
                        <li>
                            <div class="feeds-left"><i class="fa fa-thumbs-o-up"></i></div>
                            <div class="feeds-body">
                                <h4 class="title">7 New Feedback</h4>
                                <small>It will give a smart finishing to your site</small>
                                <small class="text-muted">Today</small>
                            </div>
                        </li>
                        <li>
                            <div class="feeds-left"><i class="fa fa-question-circle"></i></div>
                            <div class="feeds-body">
                                <h4 class="title text-warning">Server Warning</h4>
                                <small>Your connection is not private</small>
                                <small class="text-muted">10:50</small>
                            </div>
                        </li>
                        <li>
                            <div class="feeds-left"><i class="fa fa-shopping-cart"></i></div>
                            <div class="feeds-body">
                                <h4 class="title">7 New Orders</h4>
                                <small>You received a new oder from Tina.</small>
                                <small class="text-muted">11:35</small>
                            </div>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane  " id="activity" aria-expanded="false">
                    <ul class="new_timeline mt-3">
                        <li>
                            <div class="bullet pink"></div>
                            <div class="time">11:00am</div>
                            <div class="desc">
                                <h3>Attendance</h3>
                                <h4>Computer Class</h4>
                            </div>
                        </li>
                        <li>
                            <div class="bullet pink"></div>
                            <div class="time">11:30am</div>
                            <div class="desc">
                                <h3>Added an interest</h3>
                                <h4>“Volunteer Activities”</h4>
                            </div>
                        </li>
                        <li>
                            <div class="bullet green"></div>
                            <div class="time">12:00pm</div>
                            <div class="desc">
                                <h3>Developer Team</h3>
                                <h4>Hangouts</h4>
                                <ul class="list-unstyled team-info margin-0 p-t-5">
                                    <li><img src="{{ asset('asset') }}/images/xs/avatar1.jpg" alt="Avatar"></li>
                                    <li><img src="{{ asset('asset') }}/images/xs/avatar2.jpg" alt="Avatar"></li>
                                    <li><img src="{{ asset('asset') }}/images/xs/avatar3.jpg" alt="Avatar"></li>
                                    <li><img src="{{ asset('asset') }}/images/xs/avatar4.jpg" alt="Avatar"></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="bullet green"></div>
                            <div class="time">2:00pm</div>
                            <div class="desc">
                                <h3>Responded to need</h3>
                                <a href="javascript:void(0)">“In-Kind Opportunity”</a>
                            </div>
                        </li>
                        <li>
                            <div class="bullet orange"></div>
                            <div class="time">1:30pm</div>
                            <div class="desc">
                                <h3>Lunch Break</h3>
                            </div>
                        </li>
                        <li>
                            <div class="bullet green"></div>
                            <div class="time">2:38pm</div>
                            <div class="desc">
                                <h3>Finish</h3>
                                <h4>Go to Home</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- start User detail -->
        <div class="user_div">
            <h5 class="brand-name mb-4">User Profile<a href="javascript:void(0)" class="user_btn"><i class="icon-close"></i></a></h5>
            <div class="card">
                <img class="card-img-top" src="{{ asset('asset') }}/images/gallery/6.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    <p class="card-text">{{ Auth::user()->role }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ Auth::user()->email }}</li>
                    <li class="list-group-item">+ 202-555-2828</li>
                    <li class="list-group-item">October 22th, 1990</li>
                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="d-block">Total Income<span class="float-right">77%</span></label>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Total Expenses <span class="float-right">50%</span></label>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="d-block">Gross Profit <span class="float-right">23%</span></label>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Storage <span class="float-right">77%</span></label>
                <div class="progress progress-sm">
                    <div class="progress-bar" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                </div>
                <a href="{{ route('admin.profile') }}" class="btn btn-primary btn-block mt-3">View Profile</a>
            </div>
        </div>

        <!-- start Main menu -->
        <div id="left-sidebar" class="sidebar">
            <div class="d-flex justify-content-between brand_name">
                <h5 class="brand-name">{{ env('APP_NAME') }}</h5>
                <div class="theme_btn">
                    <a class="theme1" data-toggle="tooltip" title="Theme Radical" href="javascript:void(0)" onclick="setStyleSheet('{{ asset('asset') }}/css/theme1.css', 0);"></a>
                    <a class="theme2" data-toggle="tooltip" title="Theme Turmeric" href="javascript:void(0)" onclick="setStyleSheet('{{ asset('asset') }}/css/theme2.css', 0);"></a>
                    <a class="theme3" data-toggle="tooltip" title="Theme Caribbean" href="javascript:void(0)" onclick="setStyleSheet('{{ asset('asset') }}/css/theme3.css', 0);"></a>
                    <a class="theme4" data-toggle="tooltip" title="Theme Cascade" href="javascript:void(0)" onclick="setStyleSheet('{{ asset('asset') }}/css/theme4.css', 0);"></a>
                </div>
            </div>
            <div class="input-icon">
                <span class="input-icon-addon">
                    <i class="fe fe-search"></i>
                </span>
                <input type="text" class="form-control" placeholder="Search...">
            </div>
            @include('layouts.navigation')
        </div>

        <!-- start main body part-->
        <div class="page">

            <!-- start body header -->
            <div id="page_top" class="section-body ">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="left">
                            <h1 class="page-title">@yield('title')</h1>
                        </div>
                        <div class="right">
                            <div class="notification d-flex">
                                <button type="button" class="btn btn-facebook"><i class="fa fa-info-circle mr-2"></i>Need Help</button>
                                <button type="button" class="btn btn-facebook"><i class="fa fa-file-text mr-2"></i>Data export</button>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="route('logout')" class="btn btn-facebook" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="fa fa-power-off mr-2"></i>Sign Out
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <!-- Start page footer -->
            <div class="section-body">
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                Copyright © {{ date('Y') }} <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>.
                            </div>
                            <div class="col-md-6 col-sm-12 text-md-right">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item"><a href="javascript:void(0)">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>


    <!-- jQuery and bootstrtap js -->
    <script src="{{ asset('asset') }}/bundles/lib.vendor.bundle.js"></script>

    <!-- start plugin js file  -->
    <script src="{{ asset('asset') }}/bundles/counterup.bundle.js"></script>
    <script src="{{ asset('asset') }}/bundles/apexcharts.bundle.js"></script>
    <script src="{{ asset('asset') }}/bundles/c3.bundle.js"></script>

    <!-- Plugins Js -->
    <script src="{{ asset('asset') }}/plugins/toastr/toastr.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <script src="{{ asset('asset') }}/bundles/dataTables.bundle.js"></script>

    <!-- Start core js and page js -->
    <script src="{{ asset('asset') }}/js/core.js"></script>
    <script src="{{ asset('asset') }}/js/page/index2.js"></script>

    <script>
        $(document).ready(function() {
            @if(Session::has('message'))
                var type = "{{ Session::get('alert-type', 'info') }}";
                switch(type){
                    case 'info':
                        toastr.info("{{ Session::get('message') }}");
                        break;

                    case 'warning':
                        toastr.warning("{{ Session::get('message') }}");
                        break;

                    case 'success':
                        toastr.success("{{ Session::get('message') }}");
                        break;

                    case 'error':
                        toastr.error("{{ Session::get('message') }}");
                        break;
                }
            @endif
        });
    </script>

    @yield('script')
</body>
</html>
