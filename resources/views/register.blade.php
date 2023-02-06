<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Register | Talenttra</title>
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
        <div class="wrapper-page">
            <div class="card">
                <div class="card-body">
                    <div class="p-3 mb-5">
                        <div class="float-right text-right">
                            <h4 class="font-18 mt-3 m-b-5">Free Register</h4>
                            <p class="text-muted">Get your free Talenttra account now.</p>
                        </div>
                        <!-- <a href="{{url('/')}}" class="logo-admin"><img src="{{asset('icon/logo.png')}}" height="26" alt="logo"></a> -->
                    </div>

                    <div class="p-3">
                        
                        <form class="form-horizontal m-t-10" method="POST" action="createUser" enctype="multipart/form-data">
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
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" id="firstname" value="{{old('first_name')}}" name="first_name" placeholder="Enter first name">
                            </div>
                        
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" id="lastname" value="{{old('last_name')}}" name="last_name" placeholder="Enter last name">
                            </div>
                            
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" value="{{old('username')}}" name="username" placeholder="Enter username">
                            </div>
                            
                            <div class="form-group">
                                <label for="useremail">Email</label>
                                <input type="email" class="form-control" id="useremail" value="{{old('email')}}" name="email" placeholder="Enter email">
                            </div>

                            <div class="form-group">
                                <label for="usernohp">No Handphone</label>
                                <input type="text" class="form-control" id="nohp" value="{{old('no_hp')}}" name="no_hp" placeholder="Enter No Whatsapp ( Cth : 6289666451555 )">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" id="password" class="form-control" value="{{old('password')}}" id="userpassword" name="password" placeholder="Enter password">
                                    <div class="input-group-text" style="cursor: pointer;">
                                        <span toggle="#pass" class="fa fa-fw fa-eye field-icon toggle-pass mx-auto"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group upload_foto">
                                <label for="file">Upload Foto KTM</label>
                                <input type="file" class="form-control" id="file" name="file" placeholder="Upload Foto KTP">
                            </div>

                            <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkbox_mitra" name="mitra" value="2">
                                        <label class="custom-control-label" for="checkbox_mitra">Daftar sebagai creator</label>
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                </div>
                            </div>

                            <!-- <div class="form-group m-t-30 mb-0 row">
                                <div class="col-12">
                                    <p class="font-14 text-center text-muted mb-0">By registering you agree to the Talenttra <a href="#" class="text-primary">Terms of Use</a></p>
                                </div>
                            </div> -->

                            <!-- <div class="form-group m-t-30 mb-0 row">
                                <div class="col-12">
                                    <p class="font-14 text-center text-muted mb-0">Hubungi Kami</p>
                                    <p class="font-14 text-center text-muted mb-0">
                                        talenttra@gmail.com <br>
                                        0831-8495-0642
                                    </p>
                                </div>
                            </div> -->
                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center text-white-50">
                <p>Already have an account ? <a href="/login" class="font-600 text-white"> Login </a> </p>
                <p>© 2021 Talenttra <span class="d-none d-md-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Delion.</span></p>
            </div>
        </div>

        
        <!-- jQuery  -->
        <script src="{{ asset('user_template/assets/js/jquery.min.js')}} "></script>
        <script src="{{ asset('user_template/assets/js/bootstrap.bundle.min.js')}} "></script>
        <script src="{{ asset('user_template/assets/js/modernizr.min.js')}} "></script>
        <script src="{{ asset('user_template/assets/js/waves.js')}} "></script>
        <script src="{{ asset('user_template/assets/js/jquery.slimscroll.js')}} "></script>

        <!-- App js -->
        <script src="{{ asset('user_template/assets/js/app.js')}} "></script>

        <script type="text/javascript">
        $(document).ready(function () { 
            $('.upload_foto').hide();
            $('#checkbox_mitra').change(function(){
                if ($(this).is(':checked')) {
                    $('.upload_foto').slideDown();
                } else {
                    $('.upload_foto').slideUp();
                }
            })

            var togglepass = document.querySelector(".toggle-pass");
            togglepass.addEventListener('click', function() {
                if(togglepass.classList.contains('fa-eye-slash')){
                    togglepass.classList.remove("fa-eye-slash");
                } else {
                    togglepass.classList.add("fa-eye-slash");
                }
                    
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            });
            
        });
        </script>
    </body>
</html>