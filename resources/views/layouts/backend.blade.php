<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Driver</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
	<script src="https://kit.fontawesome.com/841e81be37.js" crossorigin="anonymous"></script>
    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	 <link href="{{ asset('assets/css/admin-style.css') }}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    @yield('extra_header')
</head>
<!--*******************
        Preloader start
    ********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="/">
              <span class="brand-title"><img src="https://s3.amazonaws.com/truetimber/wp-content/uploads/2020/04/30141318/tt_logo_main.png" alt="" class="img-fluid"></span>
            </a>
        </div>

    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <div class="header-left">
                <ul>
                    <li class="icons position-relative"><a href="javascript:void(0)"><i
                                class="icon-magnifier f-s-16"></i></a>
                        <div class="drop-down animated bounceInDown">
                            <div class="dropdown-content-body">
                                <div class="header-search" id="header-search">
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <div class="input-group-append"><span class="input-group-text"><i
                                                        class="icon-magnifier"></i></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="header-right">
                <ul>
                    <li class="icons">
                        <a href="javascript:void(0)" class="log-user">
                          <span>{{Auth::user()->first_name}}
                                <span>{{Auth::user()->last_name}}</span></span> <i class="fa fa-caret-down f-s-14"
                                                                                   aria-hidden="true"></i>
                        </a>
                        <div class="drop-down dropdown-profile animated bounceInDown">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li><a href="{{route('profile')}}"><i class="icon-user"></i>
                                            <span>My Profile</span></a></li>
                                    {{--<li><a href="javascript:void()"><i class="fa fa-cog"></i> <span>Setting</span></a></li>--}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--**********************************
        Header end
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label">Menu</li>
                <li class="{{ Route::is('/admin')?'active':'' }}">
                    <a href="/admin" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i><span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="{{Route::is('add-user')?'active':''}}">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                       <i class="fas fa-user-edit"></i>
                        <span class="nav-text">Manage Users/Employees</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('add-user')}}">Add New User/Employee</a>
                        </li>
                        <li><a href="{{route('employee')}}">View/Edit Users/Employees</a>
                        </li>
                    </ul>
                </li>
                <li class="{{Route::is('product-create')?'active':''}}">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                       <i class="fas fa-shopping-bag"></i><span class="nav-text">Products</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('product-create')}}">Create Product</a>
                        </li>
                        <li><a href="{{route('product-manage')}}">Edit/Delete Product</a>
                        </li>
                        <li>
                            <a href="{{route('category')}}">Product Categories</a>
                        </li>
                    </ul>
                </li>
                <li class="{{Route::is('customer-info')?'active':''}}">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                       <i class="fas fa-user-circle"></i><span class="nav-text">Customers</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('customer-info')}}">All Customers</a>
                        </li>

                    </ul>
                </li>
                <li class="{{Route::is('orders')?'active':''}}">
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-cart-plus"></i><span class="nav-text">Orders</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('orders')}}">All Orders</a>
                        </li>

                    </ul>
                </li>

                @if (Auth::user()->role == 'Admin')
                    <li class="{{Route::is('admin-reset')?'active':''}}">
                        <a href="{{route('adminPassword')}}" aria-expanded="false">
                            <i class="mdi mdi-widgets"></i><span class="nav-text">Reset Admin Password</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->
    @yield('content')
    <div class="footer">
        <div class="copyright">

        </div>
    </div>
</div>
<!--**********************************
    Main wrapper end
***********************************-->
<!--**********************************
        Scripts
    ***********************************-->
<script src="{{asset('assets/plugins/common/common.min.js')}}"></script>
<script src="{{asset('assets/js/custom.min.js')}}"></script>
<script src="{{asset('assets/js/settings.js')}}"></script>
<script src="{{asset('assets/js/gleek.js')}}"></script>
<script src="{{asset('assets/js/styleSwitcher.js')}}"></script>

<!-- Chartjs chart -->
{{--<script src="{{asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>--}}
<script src="{{asset('assets/plugins/d3v3/index.js')}}"></script>
<script src="{{asset('assets/plugins/topojson/topojson.min.js')}}"></script>
{{--<script src="{{asset('assets/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/js/plugins-init/datatables.init.js')}}"></script>--}}
@yield('extra_script')
</body>
</html>
