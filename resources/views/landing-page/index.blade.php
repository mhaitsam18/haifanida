@extends('layouts.landing-page')

@section('title', 'Beranda')

@section('banner', '/img/image.png')

@section('h1', 'Header H1')
@section('sub-h1', 'Sub Header H1')

@section('content')
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>Perspiciatis laudantium explicabo,</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link href="/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/lib/animate.css/animate.css" rel="stylesheet">
    <link href="/lib/et-line-font/et-line-font.css" rel="stylesheet">
    <link href="/lib/flexslider/flexslider.css" rel="stylesheet">
    <link href="/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
@endsection

@section('js')
    <script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="/lib/flexslider/jquery.flexslider.js"></script>
    <script src="/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
@endsection