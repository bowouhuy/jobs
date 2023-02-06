<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Talenttra</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- App Icons -->
        <!-- <link rel="shortcut icon" src="{{ asset('icon/fixlogo.ico') }}"> -->
        <link rel="icon" href="{{ asset('icon/fixlogo.ico')}}"

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{ asset('user_template/assets/plugins/morris/morris.css')}} ">

        <!-- Dropzone css -->
        <link href="{{ asset('user_template/assets/plugins/dropzone/dist/dropzone.css')}} " rel="stylesheet" type="text/css">

        <!-- App css -->
        <link href="{{ asset('user_template/assets/css/bootstrap.min.css')}} " rel="stylesheet" type="text/css" />
        <link href="{{ asset('user_template/assets/css/icons.css')}} " rel="stylesheet" type="text/css" />
        <link href="{{ asset('user_template/assets/css/style.css')}} " rel="stylesheet" type="text/css" />
        <link href="{{ asset('user_template/assets/plugins/sweet-alert2/sweetalert2.min.css')}} " rel="stylesheet" type="text/css">
        <link href="{{ asset('user_template/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('user_template/assets/plugins/summernote/summernote-bs4.css') }}">
        <link href="{{ asset('user_template/assets/plugins/sweet-alert2/sweetalert2.min.css')}} " rel="stylesheet" type="text/css">

        <!-- <script src="{{ asset('user_template/assets/js/jquery.min.js')}} "></script>
        <script src="{{ asset('user_template/assets/js/bootstrap.bundle.min.js')}} "></script> -->
    </head>

    <body>
        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <div class="header-bg">
            <!-- Navigation Bar-->
            <header id="topnav">
                <div class="topbar-main">
                    <div class="container-fluid">

                        <!-- Logo-->
                        <div class="d-block d-lg-none mr-5">
                            
                            <a href="index.html" class="logo">
                                <img src="{{ asset('icon/logo.png') }}" alt="" height="28" class="logo-small"> 
                            </a>

                        </div>
                        <!-- End Logo-->

                        <div class="menu-extras topbar-custom navbar p-0">

                            <!-- Search input -->
                            <div class="search-wrap" id="search-wrap">
                                <div class="search-bar">
                                    <input class="search-input" type="search" placeholder="Search" />
                                    <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                                        <i class="mdi mdi-close-circle"></i>
                                    </a>
                                </div>
                            </div>

                            <ul class="list-inline ml-auto mb-0">
                                <!-- User-->
                                <li class="list-inline-item dropdown notification-list">
                                    <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        
                                        @if (Auth::check() && Auth::user()->role == 1)
                                            <img src="{{ asset('user_template/assets/images/users/avatar-6.jpg') }}" alt="user" class="rounded-circle">
                                            <span class="d-none d-md-inline-block ml-1">
                                            {{Auth::user()->username}}
                                            <i class="mdi mdi-chevron-down"></i> </span>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                                <a class="dropdown-item" href="{{url('/profile')}}"><i class="dripicons-user text-muted"></i> Profile</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('logout') }}"><i class="dripicons-exit text-muted"></i> Logout</a>
                                            </div>
                                        @else
                                            <span class="d-none d-md-inline-block ml-1">
                                                Login
                                            <i class="mdi mdi-chevron-down"></i> </span>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                                <a class="dropdown-item" href="/login"><i class="dripicons-wallet text-muted"></i>Login</a>
                                                <a class="dropdown-item" href="/register"><i class="dripicons-lock text-muted"></i>Register</a>
                                            </div>
                                        @endif
                                    </a>
                                </li>
                                <li class="menu-item list-inline-item">
                                    <!-- Mobile menu toggle-->
                                    <a class="navbar-toggle nav-link">
                                        <div class="lines">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <!-- End mobile menu toggle-->
                                </li>

                            </ul>

                        </div>
                        <!-- end menu-extras -->

                        <div class="clearfix"></div>

                    </div> <!-- end container -->
                </div>
                <!-- end topbar-main -->

                <!-- MENU Start -->
                <div class="navbar-custom">
                    <div class="container-fluid">
                        <!-- Logo-->
                        <div class="d-none d-lg-block">
                            <!-- Text Logog
                            <a href="index.html" class="logo">
                                Foxia
                            </a>
                             -->
                            <!-- Image Logo -->
                             <a href="{{url('/')}}" class="logo">
                                <img src="{{asset('icon/logo.png')}}" alt="" height="26" class="logo-large">
                                <span class="text-warning h5 font-weight-bold ml-2">Talenttra</span>
                            </a>

                        </div>
                        <!-- End Logo-->    
                        <div id="navigation">
                            <ul class="navigation-menu">
                                <li class="has-submenu">
                                    <a href="{{url('/')}}"><i class="fa fa-home"></i>Home</a>
                                </li>
                                <li class="has-submenu">
                                    <a href="#"><i class="fa fa-list-ul"></i>Kategori<i class="mdi mdi-chevron-down mdi-drop"></i></a>
                                    <ul class="submenu">
                                        @foreach ($menu as $main)
                                        <li class="has-submenu pr-3">
                                            <a href="#">{{$main->nama}}</a>
                                            <ul class="submenu">
                                                @foreach ($main->subkategori as $sub)
                                                <li><a href="{{url('jasa',$sub->id)}}">{{$sub->nama}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
            </header>
        </div>
        
        @yield('body')

        <div class="my-5"></div>
        <!-- Footer -->
        @extends('user.layouts.footer')
        <!-- End Footer -->
        @extends('user.layouts.script')
    </body>
</html>