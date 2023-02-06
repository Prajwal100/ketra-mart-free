<html>
<head>
    @include('frontend.layouts.head')
    <style>
        main {
            display: block;
            position: relative;
        }

        .page-content {
            align-items: center;
            display: flex;
            justify-content: center;
            background: #f7f7f7;
            height: 100%;
            width: 100%;
        }

        .error-section {
            background: #f7f7f7;
        }

        .btn-home {
            color: #fff;
            border-color: #55a2a6;
            background-color: #55a2a6;
        }

        .error-section .btn {
            padding: 16px 50px;
        }

        .btn-home {
            margin-top: 30px;
            display: inline-block;
            outline: 0;
            color: #fff;
            border-radius: 0;
            padding: 1em 2em;
            font-weight: 700;
            font-size: 1.4rem;
            font-family: 'Open Sans', sans-serif;
            letter-spacing: -0.025em;
            line-height: 1.2;
            text-transform: uppercase;
            text-align: center;
            transition: color .3s, border-color .3s, background-color .3s, box-shadow .3s;
            white-space: nowrap;
            cursor: pointer;
        }

        .mt-7 {
            margin-top: 3.5rem !important;
        }

        .ls-m {
            letter-spacing: -.025em !important;
        }

        .font-primary {
            font-family: Poppins, sans-serif !important;
        }

        .text-grey {
            color: #999 !important;
        }

        .ls-m {
            letter-spacing: -.025em !important;
        }

        a:hover {
            color: white !important;
        }
    </style>
</head>
<body>
<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>500</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">500</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Not Found Area -->
<section class="error_page text-center section_padding_100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="not-found-text">
                    <h2>500</h2>
                    <h5 class="mb-3">Internal Server Error</h5>
                    <p>Sorry! the page you looking for is not found. Make sure that you have typed the currect URL</p>
                    <a href="{{route('home')}}" class="btn btn-primary mt-3"><i class="fa fa-home"
                                                                                aria-hidden="true"></i> GO HOME</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Not Found Area End -->
</body>
</html>
