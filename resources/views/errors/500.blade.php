<html>
<head>
    @include('frontend.layouts.head')
    <style>
        main {
            display: block;
            position: relative;
        }
        .page-content{
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
            border-color:#55a2a6;
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
        a:hover{
            color:white !important;
        }
    </style></head>
<body>
    <main class="main">
        <div class="page-content">
            <section
                class="error-section d-flex flex-column justify-content-center align-items-center text-center pl-3 pr-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mx-auto">
                            <img src="{{asset('frontend/assets/images/500.svg')}}" alt="error 404" class="mt-5 mb-2">

                            <h4 class="mt-7 mb-0 ls-m text-uppercase">Ooopps.! Something went wrong!</h4>
                            <p class="text-grey font-primary ls-m">Sorry for the inconvenience, but we're working on it.</p>
                            <a href="{{route('home')}}" class="btn btn-home mb-4">Go home</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
