<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Login | {{get_settings('site_title')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('backend/assets')}}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{asset('backend/assets')}}/css/style.css" rel="stylesheet" />
    <link href="{{asset('backend/assets')}}/css/dark-style.css" rel="stylesheet" />
    <link href="{{asset('backend/assets')}}/css/transparent-style.css" rel="stylesheet">
    <link href="{{asset('backend/assets')}}/css/skin-modes.css" rel="stylesheet" />

    <!-- SINGLE-PAGE CSS -->
    <link href="{{asset('backend/assets')}}/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

    <!-- P-scroll bar css-->
    <link href="{{asset('backend/assets')}}/plugins/p-scroll/perfect-scrollbar.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('backend/assets')}}/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('backend/assets')}}/colors/color1.css" />

    {{--Toastr css--}}
    <link href="{{ asset('css/iziToast.min.css') }}" rel="stylesheet">
</head>

<body>

<!-- BACKGROUND-IMAGE -->
<div class="login-img">

    <!-- GLOABAL LOADER -->
    <div id="global-loader">
        <img src="{{asset('backend')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOABAL LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="">
            <!-- Theme-Layout -->

            <!-- CONTAINER OPEN -->


            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form action="{{route('admin.login.submit')}}" method="post" class="login100-form validate-form ">
                        @csrf
                        <div class="col col-login mx-auto mt-4 pb-5">
                            <div class="text-center">
                                <a href="{{url('/')}}">
                                    <img src="{{asset(get_settings('logo'))}}" class="header-brand-img" alt="{{get_settings('site_title')}}">
                                </a>
                            </div>
                        </div>
                        <div class="text-center">
                            <h4>Sign in to account</h4>
                            <p>Enter your email & password to login</p>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-body tabs-menu-body p-0 pt-5">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <div class="wrap-input100 validate-input input-group">
                                            <a href="javascript:;" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 form-control" name="email" type="email" placeholder="Test@gmail.com"  value="{{!demoCheck() ? 'admin@gmail.com' : ''}}">
                                            @error('email')
                                                <p class="invalid-feedback d-block">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:;" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 form-control" type="password" name="password"  placeholder="*********" value="{{!demoCheck() ? 'admin123' : ''}}">
                                            @error('password')
                                            <p class="invalid-feedback d-block">
                                                <strong>{{ $message }}</strong>
                                            </p>
                                            @enderror
                                        </div>
                                        <div class="wrap-input100 validate-input input-group">
                                            <div class="checkbox p-0">
                                                <input id="checkbox1" type="checkbox" {{ old('remember') ? 'checked' : '' }} name="remember">
                                                <label class="text-muted" for="checkbox1" >Remember password</label>
                                            </div>
                                        </div>

                                        <div class="container-login100-form-btn">
                                            <button type="submit" class="login100-form-btn btn-primary">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End PAGE -->

</div>
<!-- BACKGROUND-IMAGE CLOSED -->

<!-- login js-->

<!-- JQUERY JS -->
<script src="{{asset('backend/assets')}}/js/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('backend/assets')}}/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{asset('backend/assets')}}/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- SHOW PASSWORD JS -->
<script src="{{asset('backend/assets')}}/js/show-password.min.js"></script>

<!-- GENERATE OTP JS -->
<script src="{{asset('backend/assets')}}/js/generate-otp.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{asset('backend/assets')}}/plugins/p-scroll/perfect-scrollbar.js"></script>

<!-- Color Theme js -->
<script src="{{asset('backend/assets')}}/js/themeColors.js"></script>

<script src="{{asset('js/iziToast.min.js')}}"></script>

<!-- CUSTOM JS -->
<script src="{{asset('backend/assets')}}/js/custom.js"></script>
<!-- Plugin used-->
@include('layouts.notify')

</body>

</html>
