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

<!-- Web Application Manifest -->
<link rel="manifest" href="/manifest.json">
<!-- Chrome for Android theme color -->
<meta name="theme-color" content="#000000">

<!-- Add to homescreen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="PWA">
<link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">

<!-- Add to homescreen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="PWA">
<link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">

<link href="/images/icons/splash-640x1136.png"
    media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="/images/icons/splash-750x1334.png"
    media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1242x2208.png"
    media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)"
    rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1125x2436.png"
    media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)"
    rel="apple-touch-startup-image" />
<link href="/images/icons/splash-828x1792.png"
    media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1242x2688.png"
    media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)"
    rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1536x2048.png"
    media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1668x2224.png"
    media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1668x2388.png"
    media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />
<link href="/images/icons/splash-2048x2732.png"
    media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)"
    rel="apple-touch-startup-image" />

<!-- Tile for Win8 -->
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">

@laravelPWA


@stack('styles')
