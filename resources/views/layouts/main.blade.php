<!doctype html>
<html lang="zxx">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets-techex-demo/css/bootstrap.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/animate.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/fonts/flaticon.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/boxicons.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets-techex-demo/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/magnific-popup.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/nice-select.min.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/meanmenu.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/style.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/responsive.css">

    <link rel="stylesheet" href="/assets-techex-demo/css/theme-dark.css">

    <link rel="icon" type="image/png" href="/assets/img/logos/logo.png">
    <title>{{ $title }}</title>
    @yield('style')
</head>

<body>
    <div class="flash-data" data-success="{{ session()->get('success') }}"
        data-error="@if ($errors->any()) Terjadi kesalahan! @else{{ session()->get('error') }} @endif"
        data-warning="{{ session()->get('warning') }}"></div>

    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner"></div>
            </div>
        </div>
    </div>

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

    {{-- <div class="switch-box">
        <label id="switch" class="switch">
            <input type="checkbox" onchange="toggleTheme()" id="slider">
            <span class="slider round"></span>
        </label>
    </div> --}}


    <script src="/assets-techex-demo/js/jquery.min.js"></script>

    <script src="/assets-techex-demo/js/bootstrap.bundle.min.js"></script>

    <script src="/assets-techex-demo/js/owl.carousel.min.js"></script>

    <script src="/assets-techex-demo/js/jquery.magnific-popup.min.js"></script>

    <script src="/assets-techex-demo/js/jquery.nice-select.min.js"></script>

    <script src="/assets-techex-demo/js/wow.min.js"></script>

    <script src="/assets-techex-demo/js/meanmenu.js"></script>

    <script src="/assets-techex-demo/js/jquery.ajaxchimp.min.js"></script>

    <script src="/assets-techex-demo/js/form-validator.min.js"></script>

    <script src="/assets-techex-demo/js/contact-form-script.js"></script>

    <script src="/assets-techex-demo/js/custom.js"></script>

    @yield('script')
    @yield('modal')
</body>

</html>
