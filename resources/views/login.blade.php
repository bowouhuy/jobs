<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Login | Talenttra</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="icon" href="{{ asset('icon/fixlogo.ico')}}"

        <!-- App css -->
        <link href="{{ asset('user_template/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('user_template/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('user_template/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    </head>


    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <!-- <div class="home-btn d-none d-sm-block">
            <a href="index.html" class="text-white"><i class="mdi mdi-home h1"></i></a>
        </div> -->
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <div class="p-3 mb-5">
                        <div class="float-right text-right">
                            <h4 class="font-18 mt-3 m-b-5">Welcome Back !</h4>
                            <p class="text-muted">Sign in to continue to Talenttra.</p>
                        </div>
                        <!-- <a href="{{url('/')}}" class="logo-admin"><img src="{{asset('icon/logo.png')}}" height="26" alt="logo"></a> -->
                    </div>

                    <div class="p-3">
                        
                        <form class="form-horizontal m-t-10" method="post" action="loginUser">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                            </div>

                            <div class="form-group row m-t-30">
                                <!-- <div class="col-sm-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember me</label>
                                    </div>
                                </div> -->
                                <div class="col-sm-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                            <!-- <div class="form-group m-t-30 mb-0 row">
                                <div class="col-12 text-center">
                                    <a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                </div>
                            </div> -->
                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center text-white-50">
                <p>Don't have an account ? <a href="/register" class="font-600 text-white"> Signup Now </a> </p>
                <p>© 2021 Talenttra <span class="d-none d-md-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Delion.</span></p>
            </div>

        </div>

        <!-- jQuery  -->
        <script src="{{ asset('user_template/assets/js/jquery.min.js')}}"></script>
        <script src="{{ asset('user_template/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('user_template/assets/js/modernizr.min.js')}}"></script>
        <script src="{{ asset('user_template/assets/js/waves.js')}}"></script>
        <script src="{{ asset('user_template/assets/js/jquery.slimscroll.js')}}"></script>

        <!-- App js -->
        <script src="{{ asset('user_template/assets/js/app.js')}}"></script>

    </body>
</html>