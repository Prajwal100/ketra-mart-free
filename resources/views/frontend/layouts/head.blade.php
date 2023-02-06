<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>@yield('meta_title', get_settings('site_title'))</title>

<meta name="description" content="@yield('meta_description', get_settings('meta_description'))" />
<meta name="keywords" content="@yield('meta_keywords', get_settings('meta_keywords'))">
<!-- CDN Links -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

<!-- CSS Links -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/boxicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/nice-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/meanmenu.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/rangeSlider.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

{{-- select2 --}}
<link rel="stylesheet" href="{{ asset('frontend/assets/select2/css/select2.min.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/12.0.0/nouislider.css"
    integrity="sha512-de3hHhaaVjGo+KGk523A/Z0k6cgWD3mLLgucg6vSnrdUcDHVhUC2R6PSsgZR6LJ5NjcGPv3IoC1psoY+QILIgA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="{{ asset('frontend/assets/sass/styles.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/sass/additional.css') }}">


<link rel="icon" type="image/png" href="">


@stack('styles')
