<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ==== Document Title ==== -->
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- ==== Favicons ==== -->
    <link rel="apple-touch-icon" sizes="57x57" href="/img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- ==== Stylesheets ==== -->
    <!-- Default stylesheets-->
    <!-- Template specific stylesheets-->
    @yield('css')
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    @vite('resources/sass/landing-page/style.scss')
    {{--
    <link id="color-scheme" href="assets/css/colors/default.css" rel="stylesheet"> --}}
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
        <div class="page-loader">
            <div class="loader">Loading...</div>
        </div>

        @include('partials.landing-page.nav')

        <div class="main">
            <section class="module bg-dark-60" data-background="@yield('banner')">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h1 class="module-title font-alt">@yield('h1')</h1>
                            <div class="module-subtitle font-serif">@yield('sub-h1')</div>
                        </div>
                    </div>
                </div>
            </section>

            @yield('content')

            @include('partials.landing-page.footer')

        </div>
        <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>
    <!-- ==== JavaScripts ==== -->
    <script src="/lib/jquery/dist/jquery.js"></script>
    <script src="/lib/wow/dist/wow.js"></script>
    <script src="/lib/smoothscroll.js"></script>
    @yield('js')

    <script src="/build/assets/plugins.js"></script>
    <script src="/build/assets/main.js"></script>
    {{-- @vite(['resources/js/landing-page/plugins.js', 'resources/js/landing-page/main.js']) --}}
</body>

</html>
